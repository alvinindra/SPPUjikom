@extends('layouts.app')

@section('page-name','Siswa')

@section('content')
    <div class="page-header">
        <h1 class="page-title">
            @yield('page-name')
        </h1>
        <div class="page-options d-flex">
            <div class="input-icon ml-2">
                
                <form action="" method="GET">
                    <span class="input-icon-addon">
                        <i class="fe fe-search"></i>
                    </span>
                    <input type="text" class="form-control w-10" placeholder="Cari Siswa, masukan nama" name="q">
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@yield('page-name')</h3>
                    @if ( Auth::user()->level == 'administrator' )
                        <a href="{{ route('siswa.create') }}" class="btn btn-outline-primary btn-sm ml-5">Tambah Siswa</a>
                    <div class="card-options">
                        <a href="{{ route('siswa.export') }}" class="btn btn-primary btn-sm ml-2" download="true">Export</a>
                    </div>
                    @endif
                </div>
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
                <div class="table-responsive">
                    <table id="tb_list_datasiswa" class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th>Nisn</th>
                            <th>Nis</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Kompetensi Keahlian</th>
                            <th>Jenis Kelamin</th>
                            <th>No.telp</th>
                            <th class="text-center">Aksi</th> 
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $index => $item)
                            <tr>
                                <td><span class="text-muted">{{ $index+1 }}</span></td>
                                <td>{{ $item->nisn}}</td>
                                <td>{{ $item->nis}}</td>
                                <td>
                                    <a href="{{ route('siswa.show', $item->id) }}" class="link-unmuted">
                                        {{ $item->nama }}
                                    </a>
                                </td>
                                <td>
                                    {{ $item->kelas->nama_kelas }}
                                </td>
                                <td>
                                    {{ $item->kelas->kompetensi_keahlian }}
                                </td>
                                <td>
                                    {{ $item->jenis_kelamin}}
                                </td>
                                <td>
                                    {{ $item->no_telp}}
                                </td>
                                <td class="text-center">
                                    <a class="icon" href="{{ route('siswa.show', $item->id) }}" title="Lihat Detail Siswa">
                                        <i class="fe fe-eye"></i> 
                                    </a>
                                    @if ( Auth::user()->level == 'administrator')
                                        <a class="icon" href="{{ route('siswa.edit', $item->id) }}" title="Edit Siswa">
                                            <i class="fe fe-edit"></i> 
                                        </a>
                                        <a class="icon btn-delete" href="void:javascript(0)" data-id="{{ $item->id }}" title="Delete Siswa">
                                            <i class="fe fe-trash"></i>
                                        </a>
                                        <form action="{{ route('siswa.delete', $item->id) }}" method="POST" id="form-{{ $item->id }}">
                                            @csrf 
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="d-flex">
                        <div class="ml-auto mb-0">
                            {{ $siswa->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
{{-- <script src="{{ asset('/plugins/datatables/plugin.js')}}"></script> --}}
<script>
    require(['jquery','sweetalert'], function($, sweetalert) {
        $(document).ready(function () {
            $(document).on('click','.btn-delete', function(){
                formid = $(this).attr('data-id');
                swal({
                    title: 'Anda yakin ingin menghapusnya?',
                    text: 'Siswa yang telah dihapus tidak dapat dikembalikan',
                    dangerMode: true,
                    buttons: {
                        cancel: true,
                        confirm: true,
                    },
                }).then((result) => {
                    if (result) {
                        $('#form-' + formid).submit();
                    }
                })
            })

        });
    });
</script>
@endsection
