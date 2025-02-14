<meta name="csrf-token" content="{{ csrf_token() }}">
<?php
    $englishLearnerTitle = $sessionInfo['englishLearnerTitle'] ?? "";
?>
<style>
    /* Sticky Navbar */
    .navbar {
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1000;
        background: #212529 !important; /* Ensuring consistent dark background */
        border-bottom: none !important; /* Remove any bottom border */
        box-shadow: none !important; /* Remove any unwanted shadow */
        outline: none !important; /* Remove outline */
    }

    /* Remove the border from navbar items (including links) */
    .navbar-nav .nav-link {
        border: none !important; /* Ensure no border */
        outline: none !important; /* Remove outline */
    }

    /* Additional: Remove outline and box-shadow from active navbar items */
    .navbar-dark .nav-link.active,
    .navbar-dark .nav-link:focus,
    .navbar-dark .nav-link:hover {
        outline: none !important; /* Remove focus outline */
        box-shadow: none !important; /* Remove shadow */
        color: #ff7e5f !important; /* Adjust hover color */
    }

    /* Navbar brand logo */
    .navbar-brand img {
        max-height: 40px;
    }

    /* Navigation links styling */
    .navbar-dark .nav-link {
        color: rgba(255, 255, 255, 0.9);
        font-weight: 500;
        padding: 12px 18px;
        transition: all 0.3s ease-in-out;
        border: none !important;
        outline: none !important;
    }

    /* Hover effect - animated underline */
    .navbar-dark .nav-link::after {
        content: '';
        position: absolute;
        left: 50%;
        bottom: -4px;
        width: 0;
        height: 2px;
        /*background: linear-gradient(90deg, #ff7e5f, #feb47b);*/
        transition: width 0.3s ease-in-out, left 0.3s ease-in-out;
    }

    .navbar-dark .nav-link:hover::after, .navbar-dark .nav-link.active::after {
        width: 70%;
        left: 15%;
    }

    /* Smooth hover color transition */
    .navbar-dark .nav-link:hover, .navbar-dark .nav-link.active {
        /*color: #ff7e5f;*/
    }

    /* Page content padding to prevent overlap */
    body {
        padding-top: 70px;
    }
</style>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <!-- Logo and Title -->
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/home') }}">
                <img src="{{ \App\Helpers\asset('/img/success-icon.png') }}" alt="Lingo AI Logo">
                <span class="ms-2 fw-bold" style="font-size: 1.4rem;">Lingo AI</span>
            </a>

            <!-- Mobile Menu Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Menu -->
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="{{ url('/home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/features') }}" class="nav-link">Features</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/about') }}" class="nav-link">About</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/contact') }}" class="nav-link">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<script src="{{ \App\Helpers\asset('js/jquery-3.7.1.min.js') }}"></script>
