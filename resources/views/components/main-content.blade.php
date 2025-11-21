@if(session('user_role') == 1)
    <!-- Admin Dashboard Content -->
    <div class="dashboard-container" style="display: flex; gap: 30px; align-items: flex-start;">
        <main style="flex: 1; min-width: 0;">
            <div class="main-dashboard-content">
                <div class="welcome-section">
                    <h1>Selamat Datang, {{ session('user_name', 'Admin') }}!</h1>
                    <p>Anda login sebagai <strong>{{ session('user_role_name', 'Administrator') }}</strong>. Silakan kelola data master melalui menu di bawah ini.</p>
                    <a href="{{ route('logout') }}" class="btn-dashboard btn-logout"
                       onclick="event.preventDefault(); document.getElementById('logout-form-dashboard').submit();">
                        Logout
                    </a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="dashboard-grid">
                    <a href="{{ route('admin.jenis-hewan.index') }}" class="dashboard-card">
                        <h3><i class="fas fa-paw"></i> Jenis Hewan</h3>
                        <p>Kelola kategori utama hewan.</p>
                    </a>
                    <a href="{{ route('admin.ras-hewan.index') }}" class="dashboard-card">
                        <h3><i class="fas fa-dog"></i> Ras Hewan</h3>
                        <p>Kelola berbagai ras dari setiap jenis hewan.</p>
                    </a>
                    <a href="{{ route('admin.kategori-hewan.index') }}" class="dashboard-card">
                        <h3><i class="fas fa-tags"></i> Kategori Hewan</h3>
                        <p>Kelola kategori umum untuk hewan.</p>
                    </a>

                    <a href="{{ route('admin.kategori-klinis.index') }}" class="dashboard-card">
                        <h3><i class="fas fa-stethoscope"></i> Kategori Klinis</h3>
                        <p>Kelola kategori untuk keperluan klinis.</p>
                    </a>
                    <a href="{{ route('admin.kode-tindakan-terapi.index') }}" class="dashboard-card">
                        <h3><i class="fas fa-notes-medical"></i> Kode Tindakan</h3>
                        <p>Kelola kode untuk tindakan dan terapi.</p>
                    </a>

                    <a href="{{ route('admin.users.index') }}" class="dashboard-card">
                        <h3><i class="fas fa-users-cog"></i> Manajemen User</h3>
                        <p>Kelola akun pengguna sistem.</p>
                    </a>
                    <a href="{{ route('admin.roles.index') }}" class="dashboard-card">
                        <h3><i class="fas fa-user-shield"></i> Manajemen Role</h3>
                        <p>Kelola hak akses dan peran pengguna.</p>
                    </a>
                    <a href="{{ route('admin.pemilik.index') }}" class="dashboard-card">
                        <h3><i class="fas fa-user-friends"></i> Data Pemilik</h3>
                        <p>Kelola data pemilik hewan peliharaan.</p>
                    </a>
                    <a href="{{ route('admin.pets.index') }}" class="dashboard-card">
                        <h3><i class="fas fa-cat"></i> Data Pasien (Pets)</h3>
                        <p>Lihat dan kelola data semua pasien.</p>
                    </a>
                </div>

                <form id="logout-form-dashboard" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </main>
    </div>
@elseif(session('user_role') == 2)
    <!-- Dokter Dashboard Content -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Selamat Datang, {{ session('user_name') }}!</h4>
                        <a href="{{ route('logout') }}" class="btn btn-danger btn-sm"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form-dashboard').submit();">
                            Logout
                        </a>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <p>Anda login sebagai <strong>{{ session('user_role_name') }}</strong>. Silakan kelola pasien melalui menu di bawah ini.</p>

                        <hr>

                        <h5><i class="fas fa-database"></i> Menu </h5>
                        <div class="row mt-3">

                        </div>
                    </div>

                    <form id="logout-form-dashboard" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
@elseif(session('user_role') == 3)
    <!-- Perawat Dashboard Content -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Selamat Datang, {{ session('user_name') }}!</h4>
                        <a href="{{ route('logout') }}" class="btn btn-danger btn-sm"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form-dashboard').submit();">
                            Logout
                        </a>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <p>Anda login sebagai <strong>{{ session('user_role_name') }}</strong>. Silakan kelola pasien melalui menu di bawah ini.</p>

                        <hr>

                        <h5><i class="fas fa-database"></i> Menu </h5>
                        <div class="row mt-3">

                        </div>
                    </div>

                    <form id="logout-form-dashboard" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
@elseif(session('user_role') == 4)
    <!-- Resepsionis Dashboard Content -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Selamat Datang, {{ session('user_name') }}!</h4>
                        <a href="{{ route('logout') }}" class="btn btn-danger btn-sm"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form-dashboard').submit();">
                            Logout
                        </a>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <p>Anda login sebagai <strong>{{ session('user_role_name') }}</strong>. Silakan kelola registrasi pasien melalui menu di bawah ini.</p>

                        <hr>

                        <h5><i class="fas fa-database"></i> Menu Registrasi </h5>
                        <div class="row mt-3">
                              <div class="col-md-4 mb-3">
                                <a href="{{ route('resepsionis.pendaftaran') }}" class="btn btn-outline-primary btn-block w-100">Registrasi pasien</a>
                            </div>

                        </div>
                    </div>

                    <form id="logout-form-dashboard" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
@elseif(session('user_role') == 5)
    <!-- Pemilik Dashboard Content -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Selamat Datang, {{ session('user_name') }}!</h4>
                        <a href="{{ route('logout') }}" class="btn btn-danger btn-sm"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form-dashboard').submit();">
                            Logout
                        </a>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <p>Anda login sebagai <strong>{{ session('user_role_name') }}</strong>. KEEP ON TRACK UR PETS.</p>

                        <hr>

                        <h5><i class="fas fa-database"></i> Menu </h5>
                        <div class="row mt-3">
                            <div class="col-md-4 mb-3">
                                <a href="{{ route('pemilik.pets.index') }}" class="btn btn-outline-primary btn-block w-100">Data Peliharaan Saya</a>
                            </div>
                        </div>
                    </div>

                    <form id="logout-form-dashboard" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
@else
    <!-- Default Content -->
    <div class="welcome-section">
        <h1>Selamat Datang!</h1>
        <p>Silakan login untuk mengakses dashboard.</p>
    </div>
@endif
