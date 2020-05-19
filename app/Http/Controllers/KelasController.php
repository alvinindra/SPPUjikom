<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Spp;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Pembayaran;
use App\User;

class KelasController extends Controller
{
    public function manage_kelas()
    {
        if (Auth::user()->level == "administrator") {
            $kelas = Kelas::orderBy('created_at', 'asc')->paginate(10);
            return view('/admin/manage_kelas', ['kelas' => $kelas]);
        } else {
            return redirect()->route('users.dashboard');
        }
    }


    public function create()
    {
        if (Auth::user()->level == "administrator") {
            return view('/admin/form_kelas');
        } else {
            return redirect()->route('users.dashboard');
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->level == "administrator") {
            $request->validate([
                'nama_kelas'            => 'required|max:255',
                'kompetensi_keahlian'   => 'required|max:255'
            ]);

            $cek1 = Kelas::where('nama_kelas', $request->nama_kelas)
                ->where('kompetensi_keahlian', $request->kompetensi_keahlian)
                ->get();
            if ($cek1->count() > 0) {
                return redirect()->route('kelas.create')->with([
                    'type' => 'danger',
                    'msg' => 'Maaf, Kelas telah ada'
                ]);
            } else {
                $kelas = Kelas::create([
                    'nama_kelas'            => $request->nama_kelas,
                    'kompetensi_keahlian'   => $request->kompetensi_keahlian,
                    'created_at'            => now(),
                    'updated_at'            => now()
                ]);

                if ($kelas) {
                    return redirect()->route('kelas.manage')->with([
                        'type' => 'success',
                        'msg' => 'Kelas berhasil ditambahkan'
                    ]);
                } else {
                    return redirect()->route('kelas.manage')->with([
                        'type' => 'danger',
                        'msg' => 'Err.., Terjadi Kesalahan'
                    ]);
                }
            }
        } else {
            return redirect()->route('users.dashboard');
        }
    }

    public function edit(Kelas $kelas, $id)
    {
        if (Auth::user()->level == "administrator") {
            $kelas = Kelas::where('id_kelas', $id)->first();
            return view('/admin/form_kelas', [
                'kelas' => $kelas
            ]);
        } else {
            return redirect()->route('users.dashboard');
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->level == "administrator") {

            $request->validate([
                'nama_kelas'            => 'required|max:255',
                'kompetensi_keahlian'   => 'required|max:255'
            ]);

            $cek1 = Kelas::where('nama_kelas', $request->nama_kelas)
                ->where('kompetensi_keahlian', $request->kompetensi_keahlian)
                ->get();
            if ($cek1->count() > 0) {
                return redirect()->route('kelas.create')->with([
                    'type' => 'danger',
                    'msg' => 'Maaf, Kelas telah ada'
                ]);
            } else {
                $kelasUpdate = Kelas::where('id_kelas', $id)->update([
                    'nama_kelas'          => $request->nama_kelas,
                    'kompetensi_keahlian' => $request->kompetensi_keahlian,
                    'updated_at'          => now()
                ]);

                if ($kelasUpdate) {
                    return redirect()->route('kelas.manage')->with([
                        'type' => 'success',
                        'msg' => 'Kelas berhasil diubah'
                    ]);
                } else {
                    return redirect()->route('kelas.manage')->with([
                        'type' => 'danger',
                        'msg' => 'Err.., Terjadi Kesalahan'
                    ]);
                }
            }
        } else {
            return redirect()->route('users.dashboard');
        }
    }

    public function delete($id)
    {
        if (Auth::user()->level == "administrator") {
            $kelas = Kelas::where('id_kelas', $id);
            if ($kelas->count() > 0) {
                $deleteKelas = $kelas->delete();
                if ($deleteKelas) {
                    return redirect()->route('kelas.manage')->with([
                        'type' => 'success',
                        'msg' => 'Kelas berhasil dihapus'
                    ]);
                } else {
                    return redirect()->route('kelas.manage')->with([
                        'type' => 'danger',
                        'msg' => 'Oopss.., Terjadi Kesalahan'
                    ]);
                }
            }
        } else {
            return redirect()->route('users.dashboard');
        }
    }

    public function api_list_kelas()
    {
        $list_datakelas = Kelas::all();
        return response()->json($list_datakelas);
    }
}
