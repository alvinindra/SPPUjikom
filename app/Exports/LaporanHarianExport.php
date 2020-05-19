<?php

namespace App\Exports;

use App\Models\Pembayaran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanHarianExport implements FromView
{

    public function __construct($date, $tanggal)
    {
        $this->date = $date;
        $this->tanggal = $tanggal;
    }
    public function collection()
    {
        return Pembayaran::orderBy('id_pembayaran', 'desc')->whereDate('tgl_bayar', $this->date)->get();
    }

    public function view(): View
    {
        return view('admin.dashboard-cetak', [
            'transaksi' => $this->collection(),
            'date' => $this->date,
            'tanggal' => $this->tanggal,
            'jumlah' => 0
        ]);
    }
}
