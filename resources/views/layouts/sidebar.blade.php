        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('dashboard.index') }}" class="brand-link px-3 text-center">
                <img src="{{ asset('images/logo-1.png') }}" alt="Pazzar Logo" class="w-50">
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('images/users.png') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="{{ route('dashboard.index') }}" class="d-block">{{ auth()->user()->name }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @if (in_array(auth()->user()->role, ['super-admin', 'admin']))
                            <li class="nav-item">
                                <a href="{{ route('dashboard.index') }}"
                                    class="nav-link {{ Request::is('dashboard') || Request::is('dashboard/*') ? 'active' : '' }}">
                                    <i class="far fa-user nav-icon"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->role === 'super-admin')
                            <li class="nav-item">
                                <a href="{{ route('banner.index') }}"
                                    class="nav-link {{ Request::is('banner') || Request::is('banner/*') ? 'active' : '' }}">
                                    <i class="far fa-image nav-icon"></i>
                                    <p>Banner</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('program.index') }}"
                                    class="nav-link {{ Request::is('program') || Request::is('program/*') ? 'active' : '' }}">
                                    <i class="far fa-star nav-icon"></i>
                                    <p>Program</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('payment-account.index') }}"
                                    class="nav-link {{ Request::is('payment-account') || Request::is('payment-account/*') ? 'active' : '' }}">
                                    <i class="fas fa-credit-card nav-icon"></i>
                                    <p>Akun Pembayaran</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('setting.index') }}"
                                    class="nav-link {{ Request::is('setting') || Request::is('setting/*') ? 'active' : '' }}">
                                    <i class="fas fa-cogs nav-icon"></i>
                                    <p>Pengaturan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('report.index') }}"
                                    class="nav-link {{ Request::is('report') || Request::is('report/*') ? 'active' : '' }}">
                                    <i class="fas fa-cogs nav-icon"></i>
                                    <p>Laporan Penerimaan</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
