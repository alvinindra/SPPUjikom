@extends('layouts.app')

@section('page-name', (isset($user) ? 'Ubah Pengguna' : 'Pengguna Baru'))

@section('content')
    <div class="row">
        <div class="col-lg-8 col-12">
            <form action="{{ (isset($user) ? route('admin.edit.user', $user->id) : route('admin.create.user')) }}" method="post" class="card">
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
                                <label class="form-label">Nama<span class="form-required">*</span></label>
                                <input type="text" class="form-control" name="nama_users" placeholder="Nama" value="{{ isset($user) ? $user->nama_users : old('nama_users') }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Username<span class="form-required">*</span></label>
                                <input type="text" class="form-control" name="username" placeholder="Username" value="{{ isset($user) ? $user->username : old('username') }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email<span class="form-required">*</span></label>
                                <input type="text" class="form-control" name="email" placeholder="Email" value="{{ isset($user) ? $user->email : old('email') }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Password<span class="form-required">*</span></label>
                                <input type="password" class="form-control" name="password" value="" {{ isset($user) ? '' : 'required' }}>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Konfirmasi Password<span class="form-required">*</span></label>
                                <input type="password" class="form-control" name="password_confirmation" value="" {{ isset($user) ? '' : 'required' }}>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <select id="select-beast" class="form-control custom-select" name="level">
                                    <option value="administrator" {{ isset($user) ? ($user->level == 'administrator' ? 'selected' : '') : '' }}>Administrator</option>
                                    <option value="petugas" {{ isset($user) ? ($user->level == 'petugas' ? 'selected' : '') : '' }}>Petugas</option>
                                </select>
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