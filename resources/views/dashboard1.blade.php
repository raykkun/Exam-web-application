<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - {{ $title ?? 'Laravel 12' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
<main>
  <div class="container py-4">
    <header class="pb-3 mb-4 border-bottom">
        <div class="row align-items-center">
            <div class="col-md-10">
                <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                    <img src="https://www.itsolutionstuff.com/assets/images/logo-it-2.png" alt="Logo" width="200">
                </a>          
            </div>
            <div class="col-md-2 text-end">
                @auth
                    <!-- Link Logout Menggunakan POST sesuai Form di bawah -->
                    <a class="btn btn-outline-danger btn-sm" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endauth
            </div>
        </div>
    </header>

    <div class="p-5 mb-4 bg-light rounded-3">
      <div class="container-fluid py-5">

        @if(session('success'))
            <div class="alert alert-success" role="alert"> 
              {{ session('success') }}
            </div>
        @endif
            
        <h1 class="display-5 fw-bold">
            Hi, {{ auth()->check() ? auth()->user()->name : 'Guest' }}
        </h1>
       
        <p class="col-md-8 fs-4">Welcome to dashboard. Anda berhasil login sebagai <strong>{{ auth()->user()?->email }}</strong>.</p>
        
        <div class="mt-4">
            <a href="{{ url('schedule') }}" class="btn btn-primary">Jadwal</a>
            <a href="{{ url('testResults') }}" class="btn btn-secondary">Hasil</a>
        </div>
      </div>
    </div>
  </div>
</main>

</body>
</html>
