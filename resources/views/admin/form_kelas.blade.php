@extends('layouts.app')

@section('page-name', (isset($kelas) ? 'Ubah Kelas' : 'Kelas Baru'))

@section('content')
    <div class="row">
        <div class="col-lg-8 col-12">
            <form action="{{ (isset($kelas) ? route('kelas.update', $kelas->id_kelas) : route('kelas.create')) }}" method="post" class="card">
                <div class="card-header">
                    <h3 class="card-title">@yield('page-name')</h3>
                </div>
                <div class="card-body">
                    @if(session()->has('msg'))
                        <div class="card-alert alert alert-{{ session()->get('type') }} mb-5" id="message" style="border-radius: 0px !important">
                            @if(session()->get('type') == 'success')
                                <i class="fe fe-check mr-2" aria-hidden="true"></i>
                            @else
                                <i class="fe fe-alert-triangle mr-2" aria-hidden="true"></i> 
                            @endif
                                {{ session()->get('msg') }}
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                {{ $error }}<br>
                            @endforeach
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-12">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Nama Kelas<span class="form-required">*</span></label>
                                <input type="text" class="form-control" name="nama_kelas" placeholder="Nama SPP" value="{{ isset($kelas) ? $kelas->nama_kelas : old('nama_kelas') }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Kompetensi Keahlian<span class="form-required">*</span></label>
                                <input type="text" class="form-control" name="kompetensi_keahlian" placeholder="Kompetensi Keahlian" value="{{ isset($kelas) ? $kelas->kompetensi_keahlian : old('kompetensi_keahlian') }}" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="d-flex">
                        <a href="{{ url()->previous() }}" class="btn btn-light">Batal</a>
                        <button type="submit" class="btn btn-primary ml-auto">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
<script>
    require(['jquery', 'selectize'], function ($, selectize) {
        $(document).ready(function () {
            $('#select-beast').selectize({});
        });
    });
</script>
@endsection