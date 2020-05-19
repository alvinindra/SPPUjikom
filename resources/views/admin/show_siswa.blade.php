@extends('layouts.app')

@section('page-name','Siswa')

@section('content')
<div class="row">
    <div class="col-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@yield('page-name')</h3>
            </div>
            <div class="card-body">
                <table class="table card-table table-bordered text-nowrap">
                    <tr>
                        <td class="font-weight-bold">Nisn</td>
                        <td>{{$siswa->nisn}}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Nis</td>
                        <td>{{$siswa->nis}}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Nama</td>
                        <td>{{$siswa->nama}}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Kelas</td>
                        <td>{{$siswa->kelas->nama_kelas}}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Jenis Kelamin</td>
                        <td>{{$siswa->jenis_kelamin}}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Alamat</td>
                        <td>{{$siswa->alamat}}</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">No.Telp</td>
                        <td>{{$siswa->no_telp}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tagihan SPP</h3>
                <div class="card-options">
                    <button id="btn-cetak-spp" class="btn btn-primary mr-1 text-nowrap"
                        value="{{ $siswa->id }}">Cetak</button>
                    <a id="btn-export-spp" class="btn btn-primary text-nowrap"
                        href="{{ route('transaksi.export',$siswa->id ) }}">Export</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table card-table table-hover table-vcenter text-wrap">
                    <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th>NISN</th>
                            <th>Bulan Dibayar</th>
                            <th>Tahun Ajaran</th>
                            <th>Jumlah Bayar</th>
                            <th>Tanggal Dibayar</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswa->pembayaran as $index => $item)
                            <tr>
                                <td><span class="text-muted">{{ $index+1 }}</span></td>
                                <td>
                                    {{ $item->nisn }}
                                </td>
                                <td>
                                    {{ $item->bulan_dibayar }}
                                </td>
                                <td>
                                    {{ $item->spp->tahun }}
                                </td>
                                <td>
                                    Rp.{{ format_idr($item->jumlah_bayar) }}
                                </td>
                                <td>
                                    {{ $item->tgl_bayar }}
                                </td>
                                <td class="text-center">
                                    @if ( $item->keterangan == 'Lunas')
                                        <span class="tag tag-green">Lunas</span>
                                    @else
                                        <span class="tag tag-red">Belum Lunas</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/daterangepicker.css') }}" />
@endsection
@section('js')
<script>
    require(['jquery', 'moment'], function ($, moment) {

    });

</script>
@endsection
