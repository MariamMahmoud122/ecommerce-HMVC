<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MARIAM STUDIO | Premium Fashion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --burgundy: #800020;
            --beige: #F5F5DC;
            --electric-red: #FF0000;
            --dark: #1a1a1a;
        }

        body { 
            font-family: 'Montserrat', sans-serif; 
            background-color: #ffffff; 
            color: var(--dark);
        }

        .navbar { 
            background-color: #ffffff; 
            border-bottom: 3px solid var(--burgundy); 
            padding: 20px 0;
        }
        .navbar-brand { 
            font-weight: 900; 
            letter-spacing: 1px; 
            color: var(--dark) !important; 
            font-size: 24px;
        }
        .navbar-brand span { color: var(--burgundy); }

        .nav-link { 
            color: var(--dark) !important; 
            font-weight: 700; 
            text-transform: uppercase; 
            font-size: 14px;
            margin: 0 15px;
            transition: 0.3s;
        }
        .nav-link:hover { color: var(--electric-red) !important; }

        footer { 
            background-color: var(--beige); 
            border-top: 5px solid var(--burgundy); 
            padding: 60px 0 30px; 
            margin-top: 80px; 
        }
        .footer-heading { 
            font-weight: 900; 
            text-transform: uppercase; 
            color: var(--burgundy); 
            margin-bottom: 25px;
        }
        .footer-link { 
            color: var(--dark); 
            text-decoration: none; 
            font-weight: 600;
            display: block; 
            margin-bottom: 12px; 
            transition: 0.3s;
        }
        .footer-link:hover { color: var(--electric-red); padding-left: 5px; }

        .btn-join {
            background-color: var(--burgundy);
            color: white;
            font-weight: 700;
            border: none;
        }
        .btn-join:hover {
            background-color: var(--dark);
            color: white;
        }
    </style>
    @livewireStyles
</head>
<body>

    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/">MARIAM <span>STUDIO</span></a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
<ul class="navbar-nav mx-auto">
 
    <li class="nav-item">
        <a href="{{ route('shop') }}" wire:navigate class="nav-link">All</a>
    </li>

   
    <li class="nav-item">
        <a href="{{ route('shop', ['category' => 'mens']) }}" wire:navigate class="nav-link">Men</a>
    </li>

   
    <li class="nav-item">
        <a href="{{ route('shop', ['category' => 'womens']) }}" wire:navigate class="nav-link">Women</a>
    </li>

    
    <li class="nav-item">
        <a href="{{ route('shop', ['category' => 'kids']) }}" wire:navigate class="nav-link">Kids</a>
    </li>
</ul>
                
                <div class="d-flex align-items-center" style="gap: 20px;">
                    
                    @livewire(\Modules\Front\App\Livewire\CartCounter::class)

                    
                    <div class="dropdown">
                        <a href="#" class="profile-icon text-decoration-none" data-bs-toggle="dropdown" style="color: #800020;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="background-color: #F5F5DC; min-width: 150px;">
                            @if(auth()->check())
                                <li><span class="dropdown-item fw-bold text-dark">Hi, {{ auth()->user()->name }}</span></li>
                                <li><hr class="dropdown-divider"></li>

                                @if(auth()->user()->role === 1)
                                    <li><a class="dropdown-item fw-bold text-dark" href="/admin">DASHBOARD</a></li>
                                @endif

                                <li>
                                    
                                    <form action="{{ url('/logout-manual') }}" method="POST" id="logout-form">
                                        @csrf
                                        <button type="submit" class="dropdown-item fw-bold text-danger border-0 bg-transparent">LOGOUT</button>
                                    </form>
                                </li>
                            @else
                                <li><a class="dropdown-item fw-bold" href="/login" style="color: #800020;">LOGIN</a></li>
                                <li><a class="dropdown-item fw-bold text-dark" href="/register">REGISTER</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5 class="footer-heading">About MARIAM STUDIO</h5>
                    <p class="fw-bold">High-quality fashion for everyone. Bold styles, vibrant colors, and premium fabrics.</p>
                    <p class="small">123 Fashion St, Cairo, Egypt</p>
                </div>
                <div class="col-6 col-lg-2 mb-4">
                    <h6 class="footer-heading">Explore</h6>
                    <a href="#" class="footer-link">New In</a>
                    <a href="#" class="footer-link">Best Sellers</a>
                    <a href="#" class="footer-link">Clothing</a>
                </div>
                <div class="col-6 col-lg-2 mb-4">
                    <h6 class="footer-heading">Support</h6>
                    <a href="#" class="footer-link">Shipping</a>
                    <a href="#" class="footer-link">Returns</a>
                    <a href="#" class="footer-link">Contact</a>
                </div>
                <div class="col-lg-4 mb-4">
                    <h6 class="footer-heading">Newsletter</h6>
                    <p class="small fw-bold">Get 10% off your first order!</p>
                    <div class="input-group">
                        <input type="email" class="form-control border-dark" placeholder="Your Email">
                        <button class="btn btn-join px-4">JOIN</button>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5 pt-4 border-top border-secondary-subtle">
                <p class="small fw-bold">&copy; 2026 MARIAM MAHMOUD SOLIMAN. Professional Multi-Store Interface.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @livewireScripts
</body>
</html>