<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Dokter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Profil Dokter</h3>
            </div>
            <div class="card-body">
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <div class="row align-items-center">
                    <div class="col-md-4 text-center mb-4 mb-md-0">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'User') }}&background=random&size=150" 
                             alt="Profile Picture" 
                             class="rounded-circle img-thumbnail mb-3">
                        <h4>{{ Auth::user()->name ?? 'N/A' }}</h4>
                        <p class="text-muted mb-0">Dokter</p>
                    </div>
                    
                    <div class="col-md-8">
                        <h5 class="mb-4 text-primary border-bottom pb-2">Informasi Pribadi</h5>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted small text-uppercase">Nama Lengkap</label>
                            <p class="fs-5">{{ Auth::user()->name ?? 'N/A' }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted small text-uppercase">Email Address</label>
                            <p class="fs-5">{{ Auth::user()->email ?? 'N/A' }}</p>
                        </div>

                        <div class="mt-4">
                            <a href="{{ url()->previous() }}" class="btn btn-secondary px-4">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>