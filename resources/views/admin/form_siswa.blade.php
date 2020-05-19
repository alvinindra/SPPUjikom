@extends('layouts.app')

@section('page-name', (isset($siswa) ? 'Ubah Siswa' : 'Siswa Baru'))

@section('content')
    <div class="row">
        <div class="col-lg-8 col-12">
            <form action="{{ (isset($siswa) ? route('siswa.update', $siswa->id) : route('siswa.create')) }}" method="post" class="card">
                <div class="card-header">
                    <h3 class="card-title">@yield('page-name')</h3>
                </div>
                <div class="card-body">
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
                                <label class="form-label">Kelas<span class="form-required">*</span></label>
                                <select id="select-beast" class="form-control custom-select" name="id_kelas" required>
                                    @foreach($kelas as $item)
                                        <option value="{{ $item->id_kelas }}" {{ isset($siswa) ? ($item->id_kelas == $siswa->id_kelas ? 'selected' : '') : '' }}>{{ $item->nama_kelas }} - {{ $item->kompetensi_keahlian }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nisn<span class="form-required">*</span></label>
                                <input type="text" class="form-control" maxlength="10" name="nisn" placeholder="NISN Siswa" value="{{ isset($siswa) ? $siswa->nisn : old('nisn') }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nis<span class="form-required">*Nis adalah username</span></label>
                                <input type="text" class="form-control" maxlength="9" name="nis" placeholder="NIS Siswa" value="{{ isset($siswa) ? $siswa->nis : old('nis') }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Password<span class="form-required">*</span></label>
                                <input type="password" class="form-control" name="password" placeholder="Password Siswa" value="" {{ isset($akunSiswa) ? '' : 'required' }}>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Konfirmasi Password<span class="form-required">*</span></label>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Password Siswa" value="" {{ isset($akunSiswa) ? '' : 'required' }}>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nama<span class="form-required">*</span></label>
                                <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" value="{{ isset($siswa) ? $siswa->nama : old('nama') }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email<span class="form-required">*</span></label>
                                <input type="email" class="form-control" name="email" placeholder="Email" value="{{ isset($akunSiswa) ? $akunSiswa->email : old('email') }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Jenis Kelamin</label>
                                <select id="select-beast" class="form-control custom-select" name="jenis_kelamin">
                                    <option value="Laki-laki" {{ isset($siswa) ? ($siswa->jenis_kelamin == 'Laki-laki' ? 'selected' : '') : '' }}>Laki - Laki</option>
                                    <option value="Perempuan" {{ isset($siswa) ? ($siswa->jenis_kelamin == 'Perempuan' ? 'selected' : '') : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Alamat</label>
                                <textarea class="form-control" name="alamat">{{ isset($siswa) ? $siswa->alamat : old('alamat') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">No. Telp.</label>
                                <input type="text" class="form-control" name="no_telp" maxlength="13" placeholder="Nomor Telp. Lengkap" value="{{ isset($siswa) ? $siswa->no_telp : old('no_telp') }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Spp<span class="form-required">*</span></label>
                                <select id="select-beast" class="form-control custom-select" name="id_spp" required>
                                    @foreach($spp as $item)
                                        <option value="{{ $item->id_spp }}" {{ isset($siswa) ? ($item->id_spp == $siswa->id_spp ? 'selected' : '') : '' }}>SPP Tahun Ajaran {{ $item->tahun }} - {{ format_idr($item->nominal) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="d-flex">
                        <a href="{{ url()->previous() }}" class="btn btn-link">Batal</a>
                        <button type="submit" class="btn btn-primary ml-auto">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
<script>
    require(['jquery', 'selectize','datepicker'], function ($, selectize) {
        $(document).ready(function () {

            $('.custom-select').selectize({});
            $('[data-toggle="datepicker"]').datepicker({
                format: 'yyyy-MM-dd'
            });
        });
    });
</script>
@endsection