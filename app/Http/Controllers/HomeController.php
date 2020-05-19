<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanHarianExport;
use App\Models\Spp;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Petugas;
use App\Models\Pembayaran;
use App\User;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $role = Auth::user()->level;

        if ($role == 'administrator' || $role == 'petugas') {
            $sppTotal = DB::table('pembayaran')->where('keterangan', 'Lunas')->get()->sum('jumlah_bayar');
            $transaksi = Pembayaran::orderBy('id_pembayaran', 'desc')->whereDate('tgl_bayar', now()->today())->get();
            $siswa = Siswa::count();
            $kelas = Kelas::count();
            $petugas = User::where('level', '!=', 'siswa')->get()->count();
            return view('/admin/dashboard', [
                'sppTotal'  => $sppTotal,
                'transaksi' => $transaksi,
                'siswa'     => $siswa,
                'kelas'     => $kelas,
                'petugas'   => $petugas,
                'jumlah'    => '0'
            ]);
        } else if ($role == 'siswa') {
            $siswa = Siswa::where('nis', Auth::user()->username)->first();
            $pembayaran = Pembayaran::where('nisn', $siswa->nisn)->get();
            return view('/siswa/dashboard', [
                'siswa'         => $siswa,
                'pembayaran'    => $pembayaran
            ]);
        }
    }

    public function cetak(Request $request)
    {
        $date = \Carbon\Carbon::create($request->date)->format('Y-m-d');
        $transaksi = Pembayaran::orderBy('id_pembayaran', 'desc')->whereDate('tgl_bayar', $date)->get();

        return view('admin.dashboard-cetak', ['transaksi' => $transaksi, 'date' => $request->date, 'jumlah' => 0, 'print' => true]);
    }

    public function export(Request $request)
    {
        $date = \Carbon\Carbon::create($request->date)->format('Y-m-d');
        return Excel::download(new LaporanHarianExport($date, $request->date), 'laporan-harian-' . now() . '.xlsx');
    }
}
