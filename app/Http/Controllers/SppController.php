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

class SppController extends Controller
{
    public function manage_spp()
    {
        if (Auth::user()->level == "administrator") {
            $spp = Spp::orderBy('created_at', 'desc')->paginate(10);
            return view('/admin/manage_spp', ['spp' => $spp]);
        } else {
            return redirect()->route('users.dashboard');
        }
    }

    public function create()
    {
        if (Auth::user()->level == "administrator") {
            return view('/admin/form_spp');
        } else {
            return redirect()->route('users.dashboard');
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->level == "administrator") {
            $request->validate([
                'tahun'     => 'required|numeric',
                'nominal'   => 'required|numeric'
            ]);

            $resultPerbulan = $request->nominal / 12;
            $spp = Spp::create([
                'tahun'             => $request->tahun + '/' + ($request->tahun + 1),
                'nominal'           => $request->nominal,
                'total_perbulan'    => $resultPerbulan,
                'created_at'        => now(),
                'updated_at'        => now()
            ]);

            if ($spp) {
                return redirect()->route('spp.manage')->with([
                    'type' => 'success',
                    'msg' => 'SPP berhasil ditambahkan'
                ]);
            } else {
                return redirect()->route('spp.manage')->with([
                    'type' => 'danger',
                    'msg' => 'Err.., Terjadi Kesalahan'
                ]);
            }
        }

        // $cek1 = Spp::where('nama_spp', $request->nama_spp)
        //     ->where('tahun', $request->tahun)
        //     ->where('nominal', $request->nominal)
        //     ->get();

        // if ($cek1->count() > 0) {
        //     return redirect()->route('kelas.create')->with([
        //         'type' => 'danger',
        //         'msg' => 'Maaf, Spp telah ada'
        //     ]);
        // } else {
        // } else {
        //     return redirect()->route('users.dashboard');
        // }
    }

    public function edit(Spp $spp, $id)
    {
        if (Auth::user()->level == "administrator") {
            $spp = Spp::where('id_spp', $id)->first();
            return view('/admin/form_spp', [
                'spp' => $spp
            ]);
        } else {
            return redirect()->route('users.dashboard');
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->level == "administrator") {
            $request->validate([
                'tahun'     => 'required|numeric',
                'nominal'   => 'required|numeric'
            ]);

            $resultPerbulan = $request->nominal / 12;
            $sppUpdate = Spp::where('id_spp', $id)->update([
                'nama_spp'          => $request->nama_spp,
                'tahun'             => $request->tahun + '/' + ($request->tahun + 1),
                'nominal'           => $request->nominal,
                'total_perbulan'    => $resultPerbulan,
                'updated_at'        => now()
            ]);

            if ($sppUpdate) {
                return redirect()->route('spp.manage')->with([
                    'type' => 'success',
                    'msg' => 'SPP berhasil diubah'
                ]);
            } else {
                return redirect()->route('spp.manage')->with([
                    'type' => 'danger',
                    'msg' => 'Err.., Terjadi Kesalahan'
                ]);
            }
        }

        // $cek1 = Spp::where('nama_spp', $request->nama_spp)
        //     ->where('tahun', $request->tahun)
        //     ->where('nominal', $request->nominal)
        //     ->get();

        // if ($cek1->count() > 0) {
        //     return redirect()->route('kelas.create')->with([
        //         'type' => 'danger',
        //         'msg' => 'Maaf, Spp telah ada'
        //     ]);
        // } else {
        // } else {
        //     return redirect()->route('users.dashboard');
        // }
    }

    public function delete($id)
    {
        if (Auth::user()->level == "administrator") {
            $spp = Spp::where('id_spp', $id);

            if ($spp->count() > 0) {
                $deleteSpp = $spp->delete();
                if ($deleteSpp) {
                    return redirect()->route('spp.manage')->with([
                        'type' => 'success',
                        'msg' => 'SPP berhasil dihapus'
                    ]);
                } else {
                    return redirect()->route('spp.manage')->with([
                        'type' => 'danger',
                        'msg' => 'Oopss.., Terjadi Kesalahan'
                    ]);
                }
            }
        } else {
            return redirect()->route('users.dashboard');
        }
    }

    public function api_list_spp()
    {
        $list_dataspp = Spp::all();
        return response()->json($list_dataspp);
    }
}
