<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        @auth
            <a class="navbar-brand" href="{{ route('karyawan.index') }}">Manage Karyawan</a>
        @else
            <a class="navbar-brand" href="/">Manage Karyawan</a>
        @endauth
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item me-3">
                    @auth
                        <a href="{{ route('profile') }}" class="nav-link">Profile</a>
                    @endauth
                </li>
                <li class="nav-item">
                    @auth
                        <form action="{{ route('logout', Auth::id()) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">Logout</button>
                        </form>
                    @endauth
                </li>
            </ul>
        </div>
    </div>
</nav>
