<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
    <div class="container">
        <!-- Brand Logo with smooth hover effect -->
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('assets/img/logoimg.png') }}" alt="Logo" height="60" class="d-inline-block align-top logo-hover">
        </a>

        <!-- Mobile Toggle Button - Modern Style -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Content -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
                <!-- Home Link with Active Indicator -->
                <li class="nav-item mx-2">
                    <a class="nav-link position-relative px-3 py-2 {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                        Home
                        <span class="active-indicator"></span>
                    </a>
                </li>
                
                <!-- Cart Link -->
                <li class="nav-item mx-2">
                    <a class="nav-link position-relative px-3 py-2 {{ request()->routeIs('cart.show') ? 'active' : '' }}" href="{{ route('cart.show') }}">
                        Cart
                        <span class="active-indicator"></span>
                    </a>
                </li>

                <!-- Conditional Auth Links -->
                @auth
                <li class="nav-item ms-lg-3">
                    <a class="btn btn-outline-danger px-4 py-2 rounded-pill" href="{{ route('logout') }}">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<style>
    /* Modern Navbar Styling */
    .navbar {
        transition: all 0.3s ease;
    }
    
    .logo-hover {
        transition: transform 0.3s ease;
    }
    
    .logo-hover:hover {
        transform: scale(1.05);
    }
    
    .navbar-toggler:focus {
        box-shadow: none;
    }
    
    .nav-link {
        font-weight: 500;
        color: #4a5568;
        transition: all 0.3s ease;
        border-radius: 6px;
    }
    
    .nav-link:hover {
        color: #6366f1;
        background: rgba(99, 102, 241, 0.1);
    }
    
    .active-indicator {
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 20px;
        height: 3px;
        background: #6366f1;
        border-radius: 3px;
        opacity: 0;
        transition: all 0.3s ease;
    }
    
    .nav-link.active .active-indicator {
        opacity: 1;
    }
    
    .btn-outline-danger {
        border-color: #ef4444;
        color: #ef4444;
        transition: all 0.3s ease;
    }
    
    .btn-outline-danger:hover {
        background: #ef4444;
        color: white;
    }
    
    @media (max-width: 991.98px) {
        .navbar-nav {
            padding-top: 1rem;
        }
        
        .nav-item {
            margin: 0.25rem 0;
        }
        
        .active-indicator {
            display: none;
        }
    }
</style>