@extends('layouts.auth')
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <style>
    
    :root {
        --primary-color: #6366f1;
        --primary-hover: #4f46e5;
        --gradient-start: #8b5cf6;
        --gradient-end: #6366f1;
        --text-dark: #1e293b;
        --text-light: #64748b;
        --bg-light: #f8fafc;
        --error-color: #ef4444;
        --success-color: #10b981;
    }

    html, body {
        height: 100%;
        background-color: var(--bg-light);
    }

    .form-signin {
        max-width: 400px;
        padding: 2.5rem;
        border-radius: 16px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        background: white;
        margin: 2rem auto;
    }

    .form-signin .form-floating:focus-within {
        z-index: 2;
    }

    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
        border: 1px solid #e2e8f0;
        padding: 1rem;
    }

    .form-signin input[type="password"] {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        border: 1px solid #e2e8f0;
        padding: 1rem;
    }

    .logo-container {
        display: flex;
        justify-content: center;
        margin-bottom: 0.1rem;
    }

    .logo {
        height: 80px;
        transition: transform 0.3s ease;
    }

    .logo:hover {
        transform: scale(1.05);
    }

    .title {
        color: var(--text-dark);
        font-weight: 700;
        font-size: 1.75rem;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .btn-signin {
        background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
        border: none;
        padding: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px -1px rgba(99, 102, 241, 0.3);
    }

    .btn-signin:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.4);
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(99, 102, 241, 0.25);
    }

    .divider {
        display: flex;
        align-items: center;
        margin: 1.5rem 0;
        color: var(--text-light);
    }

    .divider::before, .divider::after {
        content: "";
        flex: 1;
        border-bottom: 1px solid #e2e8f0;
    }

    .divider::before {
        margin-right: 1rem;
    }

    .divider::after {
        margin-left: 1rem;
    }

    .footer-text {
        color: var(--text-light);
        font-size: 0.875rem;
        text-align: center;
        margin-top: 2rem;
    }

    .link-primary {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s ease;
    }

    .link-primary:hover {
        color: var(--primary-hover);
        text-decoration: underline;
    }

    .social-login {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin: 1.5rem 0;
    }

    .social-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: white;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .social-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .remember-forgot {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 1rem 0;
    }

    /* Error message animation styles */
    .alert-message {
        position: relative;
        overflow: hidden;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        margin-bottom: 1rem;
    }

    .alert-progress {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 4px;
        background-color: rgba(255, 255, 255, 0.4);
        width: 100%;
        transform-origin: left;
        animation: progress 5s linear forwards;
    }

    .alert-danger .alert-progress {
        background-color: rgba(239, 68, 68, 0.4);
    }

    .alert-success .alert-progress {
        background-color: rgba(16, 185, 129, 0.4);
    }

    @keyframes progress {
        0% {
            transform: scaleX(1);
        }
        100% {
            transform: scaleX(0);
        }
    }

    .fade-out {
        animation: fadeOut 0.5s ease forwards;
        animation-delay: 4.5s;
    }

    @keyframes fadeOut {
        to {
            opacity: 0;
            height: 0;
            padding: 0;
            margin: 0;
        }
    }

    @media (max-width: 576px) {
        .form-signin {
            padding: 1.5rem;
            margin: 1rem;
        }
    }
    </style>    
@endsection

@section('content')
<main class="form-signin w-100">
    <form action="{{route('login.post')}}" method="POST">
        @csrf
        <div class="logo-container">
            <img src="{{asset('assets/img/logoimg.png')}}" alt="Company Logo" class="logo">
        </div>
        
        <h1 class="title">Welcome Back</h1>

        <div class="form-floating mb-3">
            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="Enter Your Email">
            <label for="floatingInput">Email Address</label>
            @error('email')
            <div class="text-danger small mt-1">{{$message}}</div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Enter Your Password">
            <label for="floatingPassword">Password</label>
            @error('password')
            <div class="text-danger small mt-1">{{$message}}</div>
            @enderror
        </div>

        <div class="remember-forgot">
            <div class="form-check">
                <input name="rememberme" type="checkbox" class="form-check-input" value="remember-me" id="flexCheckDefault">
                <label for="flexCheckDefault" class="form-check-label">Remember Me</label>
            </div>
            {{-- <a href="{{route('password.request')}}" class="link-primary small">Forgot Password?</a> --}}
        </div>

        @if(session()->has('success'))
            <div class="alert-message alert-success fade-out">
                {{session()->get('success')}}
                <div class="alert-progress"></div>
            </div>
        @endif
        @if(session("error"))
            <div class="alert-message alert-danger fade-out">
                {{session('error')}}
                <div class="alert-progress"></div>
            </div>
        @endif

        <button class="btn btn-signin w-100 py-2 mb-3" type="submit">Sign In</button>

        <div class="divider">or continue with</div>

        <div class="social-login">
            <button type="button" class="social-btn">
                <i class="fab fa-google text-danger"></i>
            </button>
            <button type="button" class="social-btn">
                <i class="fab fa-facebook-f text-primary"></i>
            </button>
            <button type="button" class="social-btn">
                <i class="fab fa-apple"></i>
            </button>
        </div>

        <p class="text-center mt-4">Don't have an account? <a href="{{route('register')}}" class="link-primary">Sign up</a></p>
        
        <p class="footer-text">&copy; 2025-2026 Company Name. All rights reserved.</p>
    </form>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-dismiss alerts after animation completes
        const alerts = document.querySelectorAll('.fade-out');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.remove();
            }, 5000); // matches CSS animation duration
        });
    });
    </script>
@endsection