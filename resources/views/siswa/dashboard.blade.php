@extends('layouts.app')

@section('page-name','Dashboard')

@section('content')
<div class="row">
    <div class="col-12 col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="table-bordered table-responsive">
                    <table class="table card-table text-nowrap">
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
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-8 mb-5">
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
                <div class="table-responsive table-bordered">
                    <table class="table card-table table-hover text-wrap">
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
                        @foreach ($pembayaran as $index => $item)
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
</div>
@endsection
@section('js')
    <script>
        require(['jquery', 'moment'], function ($, moment) {
            $(document).ready(function () {
                $('#btn-cetak-spp').on('click', function(){
                    var form = document.createElement("form");
                    form.setAttribute("style", "display: none");
                    form.setAttribute("method", "post");
                    form.setAttribute("action", "{{route('transaksi.cetak', $siswa->id)}}");
                    form.setAttribute("target", "_blank");
                    
                    var token = document.createElement("input");
                    token.setAttribute("name", "_token");
                    token.setAttribute("value", "{{csrf_token()}}");
                    
                    var dateForm = document.createElement("input");
                    dateForm.setAttribute("name", "date");
                    dateForm.setAttribute("value", $('#date').val());
    
                    form.appendChild(token);
                    form.appendChild(dateForm);
                    document.body.appendChild(form);
                    form.submit();
                });
            });
        });
    </script>
@endsection