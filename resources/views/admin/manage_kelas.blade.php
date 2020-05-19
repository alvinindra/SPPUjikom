@extends('layouts.app')

@section('page-name','Kelas')

@section('content')
    <div class="page-header">
        <h1 class="page-title">
            @yield('page-name')
        </h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@yield('page-name')</h3>
                    <a href="{{ route('kelas.create') }}" class="btn btn-outline-primary btn-sm ml-5">Tambah Kelas</a>
                    {{-- <div class="card-options">
                        <a href="" class="btn btn-primary btn-sm">Import</a>
                        <a href="" class="btn btn-secondary btn-sm ml-2" download="true">Export</a>
                    </div> --}}
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
                    <table id="tb_list_datakelas" class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th>Nama Kelas</th>
                            <th>Kompetensi Keahlian</th>
                            <th>Tanggal Dibuat</th>
                            <th class="text-center">Aksi</th> 
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($kelas as $index => $item)
                            <tr>
                                <td><span class="text-muted">{{ $index+1 }}</span></td>
                                <td>
                                    {{ $item->nama_kelas }}
                                </td>
                                <td>
                                    {{ $item->kompetensi_keahlian }}
                                </td>
                                <td>
                                   {{ $item->created_at }}
                                </td>
                                <td class="text-center">
                                    <a class="icon" href="{{ route('kelas.edit', $item->id_kelas) }}" title="Edit Kelas">
                                        <i class="fe fe-edit"></i>
                                    </a>
                                    <a class="icon btn-delete" href="void:javascript(0)" data-id="{{ $item->id_kelas }}" title="Delete Kelas">
                                        <i class="fe fe-trash"></i>
                                    </a>
                                    <form action="{{ route('kelas.delete', $item->id_kelas) }}" method="POST" id="form-{{ $item->id_kelas }}">
                                        @csrf 
                                    </form>
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
@section('js')
<script src="{{ asset('/plugins/datatables/plugin.js')}}"></script>
<script>
    require(['datatables','jquery','sweetalert'], function(datatable, $) {
        $(document).ready(function () {
            $(document).on('click','.btn-delete', function(){
                formid = $(this).attr('data-id');
                swal({
                    title: 'Anda yakin ingin menghapus?',
                    text: 'Kelas yang dihapus tidak dapat dikembalikan',
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
