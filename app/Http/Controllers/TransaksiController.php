<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Exports\SppSiswaExport;
use App\Models\Spp;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Pembayaran;
use App\User;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->level == "administrator" || Auth::user()->level == "petugas") {
            $value = $request->get('nisn');
            $siswa = Siswa::where('nisn', $value)->first();
            $transaksi = Pembayaran::where('nisn', $value)->orderBy('id_pembayaran', 'asc')->get();
            $check = Pembayaran::where('nisn', $value);
            if ($value == null) {
                return view('/admin/transaksi');
            } else if ($check->count() > 0) {
                return view('/admin/transaksi', [
                    'transaksi' => $transaksi,
                    'siswa' => $siswa
                ]);
            } else {
                return view('/admin/transaksi', [
                    'check' => $check
                ])->with([
                    'type' => 'danger',
                    'msg' => 'Maaf, Siswa Tidak Ditemukan'
                ]);
            }
        } else {
            return redirect()->route('users.dashboard');
        }
    }

    public function pay(Request $request, $id)
    {
        if (Auth::user()->level == "administrator" || Auth::user()->level == "petugas") {
            $paySpp = Pembayaran::where('id_pembayaran', $id)->update([
                'id_petugas' => Auth::user()->petugas->id_petugas,
                'tgl_bayar'  => now(),
                'keterangan' => 'Lunas',
            ]);

            if ($paySpp) {
                return back()->with([
                    'type' => 'success',
                    'msg' => 'Pembayaran SPP Berhasil'
                ]);
            } else {
                return back()->with([
                    'type' => 'danger',
                    'msg' => 'Maaf, Pembayaran SPP Gagal'
                ]);
            }
        } else {
            return redirect()->route('users.dashboard');
        }
    }

    public function cancel(Request $request, $id)
    {
        if (Auth::user()->level == "administrator" || Auth::user()->level == "petugas") {
            $paySpp = Pembayaran::where('id_pembayaran', $id)->update([
                'id_petugas' => Auth::user()->petugas->id_petugas,
                'tgl_bayar'  => null,
                'keterangan' => 'Belum Lunas',
            ]);

            if ($paySpp) {
                return back()->with([
                    'type' => 'success',
                    'msg' => 'Cancel Pembayaran SPP Berhasil'
                ]);
            } else {
                return back()->with([
                    'type' => 'danger',
                    'msg' => 'Maaf, Cancel Pembayaran SPP Gagal'
                ]);
            }
        } else {
            return redirect()->route('users.dashboard');
        }
    }

    public function print(Request $request, $id)
    {
        $siswa = Siswa::where('id', $id)->first();
        $transaksi = Pembayaran::where('nisn', $siswa->nisn)->orderBy('id_pembayaran', 'asc')->get();

        return view('transaksi.print', [
            'siswa' => $siswa,
            'transaksi' => $transaksi
        ]);
    }

    public function export(Request $request, $id)
    {
        $siswa = Siswa::where('id', $id)->first();
        $transaksi = Pembayaran::where('nisn', $siswa->nisn)->orderBy('id_pembayaran', 'asc')->get();

        return \Excel::download(new SppSiswaExport($siswa, $transaksi), 'spp_siswa-' . now() . '.xlsx');
    }
}
