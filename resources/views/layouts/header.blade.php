<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 border-bottom border-white">
    <a class="navbar-brand" href="/">MiniBlog</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a href="{{ route('about') }}" class="nav-link text-white">About</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('contact') }}" class="nav-link text-white">Contact</a>
            </li>
        </ul>
    </div>
    <div class="ms-auto">
        @auth
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <div class="nav-link d-flex align-items-center" id="navbarDropdown" role="button"
                     data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="text-white fw-semibold text-center px-3 border border-white"
                         style="height: 40px; line-height: 40px; font-size: 16px;">
                        {{ Auth::user()->name }}
                    </div>
                </div>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm rounded-3 py-2" aria-labelledby="navbarDropdown">
                    <li>
                        <a class="dropdown-item px-3 py-2" href="{{ route('profile.edit') }}">
                            <i class="bi bi-pencil-square me-2 text-secondary"></i> Edit Profile
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item px-3 py-2" href="{{ route('user.profile', auth()->user()->username) }}">
                            <i class="bi bi-person-lines-fill me-2 text-secondary"></i> View Public Profile
                        </a>
                    </li>
                    <li><hr class="dropdown-divider mx-3"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item px-3 py-2 text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
        
        <!-- Bootstrap Icons CDN (only once in your layout) -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        


        @else
            <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Login</a>
            <a href="{{ route('register') }}" class="btn btn-outline-light">Register</a>
        @endauth
    </div>
    
</nav>
