@extends('layouts.app')

@section('page-name', (isset($spp) ? 'Ubah SPP' : 'SPP Baru'))

@section('content')
    <div class="row">
        <div class="col-lg-8 col-12">
            <form action="{{ (isset($spp) ? route('spp.update', $spp->id_spp) : route('spp.create')) }}" method="post" class="card">
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
                                <label class="form-label">Tahun<span class="form-required">*</span></label>
                                <input type="text" class="form-control" name="tahun" placeholder="Tahun" pattern="\d*" maxlength="4" value="{{ isset($spp) ? $spp->tahun : old('tahun') }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nominal<span class="form-required">*</span></label>
                                <input id="inputNominal" type="text" class="form-control" name="nominal" placeholder="Nominal" pattern="\d*" maxlength="10" value="{{ isset($spp) ? $spp->nominal : old('nominal') }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Perbulan<span class="form-required">*</span></label>
                                <input id="outputPerbulan" type="text" class="form-control" name="perbulan" placeholder="Perbulan" pattern="\d*" maxlength="4" value="{{ isset($spp) ? $spp->total_perbulan : old('total_perbulan') }}" readonly>
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

        const input = document.querySelector('#inputNominal');
        const output = document.querySelector('#outputPerbulan');

        input.addEventListener('input', divide);
        input.addEventListener('change', divide);
        
        function divide() {
            const divided = input.value / 12;
            output.value = divided;
        }
    });
</script>
@endsection