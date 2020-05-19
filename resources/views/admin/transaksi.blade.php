@extends('layouts.app')

@section('page-name','Transaksi SPP')

@section('content')
<div class="row">
    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@yield('page-name')</h3>
            </div>
            <div class="card-body" style="align-self: center">
               
                <form class="form-inline" action="" method="GET">
                    <div class="form-group">
                        <label for="inputPassword2" class="form-label mr-2 mb-0">Cari Siswa : </label>
                        <input type="text" class="form-control" placeholder="Masukan NISN" name="nisn">
                    </div>
                    <button type="submit" class="btn btn-primary ml-2">Cari</button>
                </form>
            </div>
        </div>
    </div>
    @if (isset($check))
        <div class="alert alert-danger w-100" id="message" style="border-radius: 0px !important">
            <i class="fe fe-alert-triangle mr-2" aria-hidden="true"></i> 
            Maaf, Siswa Tidak Ditemukan
        </div>
    @elseif (isset($_GET['nisn']) && $_GET['nisn'] != '')
    <div class="col-12 col-md-6">
        <div class="card">
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
                </table>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-12 mb-5">
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
            <div class="card-body mb-5">
                @if(session()->has('msg'))
                <div class="card-alert alert alert-{{ session()->get('type') }}" id="message" style="border-radius: 0px !important">
                    @if(session()->get('type') == 'success')
                        <i class="fe fe-check mr-2" aria-hidden="true"></i>
                    @else
                        <i class="fe fe-alert-triangle mr-2" aria-hidden="true"></i> 
                    @endif
                        {{ session()->get('msg') }}
                </div>
                @endif
                <table class="table table-responsive-lg card-table table-hover text-wrap">
                    <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th>NISN</th>
                            <th>Bulan Dibayar</th>
                            <th>Tahun Ajaran</th>
                            <th>Jumlah Bayar</th>
                            <th>Tanggal Dibayar</th>
                            <th>Keterangan</th>
                            <th class="text-center">Aksi</th> 
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($transaksi as $index => $item)
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
                            <td class="text-center">
                                @if ( $item->keterangan == 'Lunas')
                                <a class="btn btn-danger" href="{{ route('transaksi.cancel', $item->id_pembayaran) }}" title="Cancel">Cancel</a>
                                @else
                                    <a class="btn btn-info" href="{{ route('transaksi.pay', $item->id_pembayaran) }}" title="Bayar Spp">Bayar</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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
    @endif
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/daterangepicker.css') }}" />
@endsection
@section('js')
<script>
    require(['jquery', 'moment'], function ($, moment) {
        $(document).ready(function () {
            $('.footer').addClass('fixed-bottom');
        });
    });
</script>
@endsection
