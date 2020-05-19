<h2 style="text-align:center"><b> SPP Ujikom </b></h2>
    <h3 style="text-align:center">Laporan Harian</h3>
    <p><b>Tanggal :</b> {{ $date }} </p>
<table style="border: 1px solid black; width: 100%">
    <thead style="border: 1px solid black;">
    <tr>
        <th><b>Tanggal</b></th>
        <th><b>Nama</b></th>
        <th><b>Kelas</b></th>
        <th><b>Pembayaran</b></th>
        <th><b>Total Perbulan</b></th>
    </tr>
    </thead>
    <tbody>
    @foreach ($transaksi as $index => $item)
        <tr class="{{ ($index%2) ? 'gray' : '' }}">
            <td style="width:20px;">{{ $item->tgl_bayar }}</td>
            <td style="width:20px;">{{ $item->siswa->nama }}</td>
            <td style="width:20px;">{{ $item->siswa->kelas->nama_kelas }} - {{ $item->siswa->kelas->kompetensi_keahlian }}</td>
            <td style="width:25px;">SPP Tahun Ajaran {{ $item->tahun_dibayar }}</td>
            <td style="width:20px;">IDR. {{ format_idr($item->jumlah_bayar) }}</td>
            @php
                $jumlah += $item->jumlah_bayar
            @endphp
        </tr>
    @endforeach
        <tr>
            <td><b>Total</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td>IDR. {{ format_idr($jumlah) }}</td>
        </tr>
    </tbody>
</table>
@if(isset($print))
<style>
@media print {
    tr.gray {
        background-color: #ececec !important;
        -webkit-print-color-adjust: exact; 
    }
    th {
        background-color: #dadada !important;
        -webkit-print-color-adjust: exact; 
    }
}
</style>
<script>
    window.print()
    window.onafterprint = function(){
        window.close()
    }
</script>
@endif