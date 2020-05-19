@extends('layouts.app')

@section('page-name','SPP')

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
                    <a href="{{ route('spp.create') }}" class="btn btn-outline-primary btn-sm ml-5">Tambah SPP</a>
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
                    <table id="tb_list_dataspp" class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th>Tahun</th>
                            <th>Nominal</th>
                            <th>Perbulan</th>
                            <th class="text-center">Aksi</th> 
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($spp as $index => $item)
                            <tr>
                                <td><span class="text-muted">{{ $index+1 }}</span></td>
                                <td>
                                    {{ $item->tahun }}
                                </td>
                                <td>
                                    Rp. {{ format_idr($item->nominal) }}
                                </td>
                                <td>
                                    Rp. {{ format_idr($item->total_perbulan) }}
                                </td>
                                <td class="text-center">
                                    <a class="icon" href="{{ route('spp.edit', $item->id_spp) }}" title="Edit SPP">
                                        <i class="fe fe-edit"></i>
                                    </a>
                                    <a class="icon btn-delete" href="void:javascript(0)" data-id="{{ $item->id_spp }}" title="Delete SPP">
                                        <i class="fe fe-trash"></i>
                                    </a>
                                    <form action="{{ route('spp.delete', $item->id_spp) }}" method="POST" id="form-{{ $item->id_spp }}">
                                        @csrf 
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="d-flex">
                        <div class="ml-auto mb-0">
                            {{ $spp->links() }}
                        </div>
                    </div>
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
                    text: 'SPP yang dihapus tidak dapat dikembalikan',
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
