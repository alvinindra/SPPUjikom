<div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                    <li class="nav-item">
                        <a href="{{ route('users.dashboard') }}" class="nav-link {{ set_active(['users.*'], 'active') }}">
                            <i class="fe fe-home"></i>Dashboard
                        </a>
                    </li>
                    <?php $role = Auth::user()->level; ?>
                    @if ($role == "administrator")
                        <li class="nav-item">
                            <a href="{{ route('transaksi.index') }}" class="nav-link {{ set_active(['transaksi.*'], 'active') }}">
                                <i class="fe fe-repeat"></i>Transaksi SPP
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('spp.manage') }}" class="nav-link {{ set_active(['spp.*'], 'active') }}">
                                <i class="fe fe-repeat"></i>SPP
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('siswa.manage') }}" class="nav-link {{ set_active(['siswa.*'], 'active') }}">
                                <i class="fe fe-users"></i>Siswa
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kelas.manage') }}" class="nav-link {{ set_active(['kelas.*'], 'active') }}">
                                <i class="fe fe-box"></i>Kelas
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href class="nav-link {{ set_active(['kuitansi.*'], 'active') }}">
                                <i class="fe fe-folder"></i>Kuitansi
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{ route('admin.manage.users') }}" class="nav-link {{ set_active(['admin.*'], 'active') }}">
                                <i class="fe fe-box"></i>Manage Users
                            </a>
                        </li>
                    @endif
                    
                    @if ($role == "petugas")
                        <li class="nav-item">
                            <a href="{{ route('transaksi.index') }}" class="nav-link {{ set_active(['transaksi.*'], 'active') }}">
                                <i class="fe fe-repeat"></i>Transaksi SPP
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('siswa.manage') }}" class="nav-link {{ set_active(['siswa.*'], 'active') }}">
                                <i class="fe fe-users"></i>Siswa
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>