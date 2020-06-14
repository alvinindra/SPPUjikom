<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\SiswaExport;
use App\Models\Kelas;
use App\Models\Spp;
use App\Models\Siswa;
use App\Models\Pembayaran;
use App\User;

class SiswaController extends Controller
{
    public function manage_siswa(Request $request)
    {
        if (Auth::user()->level == "administrator" || Auth::user()->level == "petugas") {
            $q = $request->get('q');
            if ($q == null) {
                $siswa = Siswa::orderBy('nis', 'asc')->paginate(15);
            } else {
                $siswa = Siswa::where('nama', 'like', '%' . $q . '%')->orderBy('created_at', 'desc')->paginate(15);
            }
            return view('/admin/manage_siswa', [
                'siswa' => $siswa
            ]);
        } else {
            return redirect()->route('users.dashboard');
        }
    }

    public function create()
    {
        if (Auth::user()->level == "administrator") {
            $kelas = Kelas::all();
            $spp = Spp::all();
            return view('/admin/form_siswa', ['spp' => $spp, 'kelas' => $kelas]);
        } else {
            return redirect()->route('users.dashboard');
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->level == "administrator") {

            $request->validate([
                'id_kelas'      => 'required|numeric',
                'nisn'          => 'required|numeric',
                'nis'           => 'required|numeric',
                'nama'          => 'required|max:255',
                'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
                'alamat'        => 'nullable',
                'no_telp'       => 'nullable|numeric',
                'id_spp'        => 'required|numeric',
            ]);

            $strRandom = Str::random(100);

            $akunSiswa = User::create([
                'nama_users'    => $request->nama,
                'username'      => $request->nis,
                'password'      => $request->password,
                'email'         => $request->email,
                'level'         => 'siswa',
                'api_token'     => $strRandom,
                'created_at'    => now(),
                'updated_at'    => now()
            ]);

            $siswa = Siswa::create([
                'nisn'          => $request->nisn,
                'nis'           => $request->nis,
                'nama'          => $request->nama,
                'id_kelas'      => $request->id_kelas,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat'        => $request->alamat,
                'no_telp'       => $request->no_telp,
                'id_spp'        => $request->id_spp,
                'created_at'    => now(),
                'updated_at'    => now()
            ]);

            $bulan[] = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

            $pembayaran = false;
            $spp = Spp::where('id_spp', $request->id_spp)->first();
            for ($i = 0; $i < 12; $i++) {
                $pembayaran = Pembayaran::create([
                    'nisn'          => $request->nisn,
                    'bulan_dibayar' => $bulan[0][$i],
                    'tahun_dibayar' => $spp->tahun + '/' + ($spp->tahun + 1),
                    'id_spp'        => $request->id_spp,
                    'jumlah_bayar'  => $spp->total_perbulan,
                    'keterangan'    => 'Belum Lunas'
                ]);
            }

            if ($akunSiswa && $siswa && $pembayaran) {
                return redirect()->route('siswa.manage')->with([
                    'type' => 'success',
                    'msg' => 'Siswa ditambahkan'
                ]);
            } else {
                return redirect()->route('siswa.manage')->with([
                    'type' => 'danger',
                    'msg' => 'Oopss.., Terjadi Kesalahan'
                ]);
            }
        } else {
            return redirect()->route('users.dashboard');
        }
    }

    public function show($id)
    {
        if (Auth::user()->level == "administrator" || Auth::user()->level == "petugas") {
            $siswa = Siswa::where('id', $id)->first();
            return view('/admin/show_siswa', [
                'siswa' => $siswa
            ]);
        } else {
            return redirect()->route('users.dashboard');
        }
    }

    public function edit(Siswa $siswa, $id)
    {
        if (Auth::user()->level == "administrator") {
            $spp = Spp::all();
            $kelas = Kelas::all();
            $siswa = Siswa::where('id', $id)->first();
            $akunSiswa = User::where('username', $siswa->nis)->first();
            return view('/admin/form_siswa', [
                'siswa'         => $siswa,
                'kelas'         => $kelas,
                'akunSiswa'     => $akunSiswa,
                'spp'           => $spp
            ]);
        } else {
            return redirect()->route('users.dashboard');
        }
    }

    public function update(Request $request, Siswa $siswa, $id)
    {
        if (Auth::user()->level == "administrator") {
            $request->validate([
                'nisn'          => 'required|numeric' . $siswa->id,
                'nis'           => 'required|numeric',
                'nama'          => 'required|max:255',
                'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
                'no_telp'       => 'nullable|numeric',
                'alamat'        => 'nullable',
                'id_kelas'      => 'required|numeric',
                'id_spp'        => 'required|numeric',
                'password'      => 'nullable|confirmed|min:8',
            ]);

            $siswaUpdate = false;
            $akunSiswaUpdate = false;

            if ($request->password != null) {
                $siswaNis = Siswa::where('id', $id)->first();
                $akunSiswaUpdate = User::where('username', $siswaNis->nis)->update([
                    'password'      => Hash::make($request->password),
                    'updated_at'    => now()
                ]);
            } else {
                $siswaUpdate = Siswa::where('id', $id)->update([
                    'nisn'          => $request->nisn,
                    'nis'           => $request->nis,
                    'nama'          => $request->nama,
                    'id_kelas'      => $request->id_kelas,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'alamat'        => $request->alamat,
                    'no_telp'       => $request->no_telp,
                    'id_spp'        => $request->id_spp,
                    'updated_at'    => now()
                ]);
            }

            if ($siswaUpdate || $akunSiswaUpdate) {
                return redirect()->route('siswa.manage')->with([
                    'type' => 'success',
                    'msg' => 'Siswa berhasil diubah'
                ]);
            } else {
                return redirect()->route('siswa.manage')->with([
                    'type' => 'danger',
                    'msg' => 'Oopss.., Terjadi Kesalahan'
                ]);
            }
        } else {
            return redirect()->route('users.dashboard');
        }
    }

    public function api_list_siswa()
    {
        $list_datasiswa = DB::table('siswa As s')
            ->select('s.*', 'k.nama_kelas As nama_kelas', 'k.kompetensi_keahlian As kk')
            ->join('kelas As k', 's.id_kelas', '=', 'k.id_kelas')
            ->get();
        return response()->json($list_datasiswa);
    }

    public function delete(Siswa $siswa, $id)
    {
        if (Auth::user()->level == "administrator") {
            $SiswaScan = Siswa::where('id', $id)->get();
            $siswa = Siswa::where('id', $id);
            $akunSiswa = User::where('username', $SiswaScan->nis);

            $delete = $akunSiswa->delete();
            $deleteDataSiswa = $siswa->delete();
            if ($delete && $deleteDataSiswa) {
                return redirect()->route('siswa.manage')->with([
                    'type' => 'success',
                    'msg' => 'Siswa berhasil dihapus'
                ]);
            } else {
                return redirect()->route('siswa.manage')->with([
                    'type' => 'danger',
                    'msg' => 'Oopss.., Terjadi Kesalahan'
                ]);
            }
        } else {
            return redirect()->route('users.dashboard');
        }
    }

    public function export()
    {
        if (Auth::user()->level == "administrator") {
            return Excel::download(new SiswaExport, 'siswa-' . now() . '.xlsx');
        } else {
            return redirect()->route('users.dashboard');
        }
    }
}
