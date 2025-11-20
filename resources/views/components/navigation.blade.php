    <header class="top-nav">
        <nav>
            <img src="https://rshp.unair.ac.id/wp-content/uploads/2024/06/UNIVERSITAS-AIRLANGGA-scaled.webp" alt="Universitas Airlangga Logo" class="left-logo">
            <ul>
                       <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('strukturorg') }}">Struktur Organisasi</a></li>
        <li><a href="{{ route('layanan') }}">Layanan Umum</a></li>
        <li><a href="{{ route('visimisi') }}">Visi Misi</a></li>
                @guest
                    <li><a href="{{ route('login') }}" class="btn-login">Login</a></li>
                @else
                    <li>
                        <a href="{{ route('logout') }}" class="btn-login"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </nav>
    </header>