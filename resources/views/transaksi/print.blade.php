<h2 style="text-align:center"><b> SPP Ujikom </b></h2>
    <h3 style="text-align:center">Tanda Bukti Pembayaran</h3>
    <br>
    <p><b>Nama : {{ $siswa->nama }}</b> </p>
    <p><b>Kelas : {{ $siswa->kelas->nama_kelas }} - {{ $siswa->kelas->kompetensi_keahlian }}</b></p>
    <table class="table table-bordered" style="border: 1px solid black; width: 100%">
        <tr style="border: 1px solid black;" class="text-center">
            <th>Nisn</th>
            <th>Tagihan</th>
            <th>Tanggal Dibayar</th>
            <th>Jumlah</th>
            <th>Keterangan</th>
        </tr>
        @foreach ($transaksi as $index => $item)
        <tr>
            <td style="width:20px;">
                {{ $item->nisn }}
            </td>
            <td style="width:30px;">
                SPP Tahun Ajaran {{ $item->tahun_dibayar }}
            </td>
            <td style="width:20px; text-align: center;">
                {{ $item->tgl_bayar }}
            </td>
            <td style="width:20px;">
                IDR. {{ format_idr($item->jumlah_bayar) }}
            </td>
            <td style="width:20px; text-align: center;">
                {{ $item->keterangan }}
            </td>
        </tr>
        @endforeach
    </table>
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