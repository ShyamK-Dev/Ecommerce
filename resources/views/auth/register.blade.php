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

    .form-signup {
        max-width: 450px;
        padding: 2.5rem;
        border-radius: 16px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        background: white;
        margin: 2rem auto;
        position: relative;
        transition: all 0.3s ease;
    }

    /* Success message styles */
    .success-container {
        display: none;
        text-align: center;
        padding: 2rem;
    }

    .success-icon {
        font-size: 4rem;
        color: var(--success-color);
        margin-bottom: 1.5rem;
        animation: bounce 0.5s ease;
    }

    .success-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 1rem;
    }

    .success-message {
        color: var(--text-light);
        margin-bottom: 2rem;
    }

    .success-actions {
        margin-top: 2rem;
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    .form-signup .form-floating:focus-within {
        z-index: 2;
    }

    .form-signup .form-control {
        border: 1px solid #e2e8f0;
        padding: 1rem;
        margin-bottom: 1rem;
    }

    .form-signup .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(99, 102, 241, 0.25);
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

    .btn-signup {
        background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
        border: none;
        padding: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px -1px rgba(99, 102, 241, 0.3);
    }

    .btn-signup:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.4);
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

    .password-strength {
        height: 4px;
        background: #e2e8f0;
        margin-top: -0.5rem;
        margin-bottom: 1rem;
        border-radius: 2px;
        overflow: hidden;
    }

    .password-strength-bar {
        height: 100%;
        width: 0%;
        background: var(--text-light);
        transition: width 0.3s ease, background 0.3s ease;
    }

    .terms-text {
        font-size: 0.8rem;
        color: var(--text-light);
        text-align: center;
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
        .form-signup {
            padding: 1.5rem;
            margin: 1rem;
        }
    }
    </style>    
@endsection

@section('content')
<main class="form-signup w-100">
    <form action="{{route('register.post')}}" method="POST">
        @csrf
        <div class="logo-container">
            <img src="{{asset('assets/img/logoimg.png')}}" alt="Company Logo" class="logo">
        </div>
        
        <h1 class="title">Create Your Account</h1>

            
                <div class="form-floating mb-3">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Full Name" required>
                    <label for="name">Full Name</label>
                    @error('name')
                    <div class="text-danger small mt-1">{{$message}}</div>
                    @enderror
                </div>
        

        <div class="form-floating mb-3">
            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="Enter Your Email" required>
            <label for="floatingInput">Email Address</label>
            @error('email')
            <div class="text-danger small mt-1">{{$message}}</div>
            @enderror
        </div>

        <div class="form-floating mb-1">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Enter Your Password" required
                   oninput="checkPasswordStrength(this.value)">
            <label for="floatingPassword">Password</label>
            <div class="password-strength">
                <div class="password-strength-bar" id="passwordStrengthBar"></div>
            </div>
            @error('password')
            <div class="text-danger small mt-1">{{$message}}</div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="password" name="password_confirmation" class="form-control" id="floatingPasswordConfirm" 
                   placeholder="Confirm Your Password" required>
            <label for="floatingPasswordConfirm">Confirm Password</label>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="termsCheck" required>
            <label class="form-check-label" for="termsCheck">
                I agree to the <a href="#" class="link-primary">Terms of Service</a> and <a href="#" class="link-primary">Privacy Policy</a>
            </label>
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

        <button class="btn btn-signup w-100 py-2 mb-3" type="submit">Create Account</button>
       
        <div id="successContainer" class="success-container" style="display: none;">
            <div class="success-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h2 class="success-title">Account Created Successfully!</h2>
            <p class="success-message">Thank you for registering. We've sent a verification email to your address.</p>
            <div class="success-actions">
                <a href="{{route('login')}}" class="btn btn-primary">Continue to Login</a>
            </div>
        </div>

        <div class="divider">or sign up with</div>

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

        <p class="text-center mt-4">Already have an account? <a href="{{route('login')}}" class="link-primary">Sign in</a></p>
        
        <p class="footer-text">&copy; 2025-2026 Company Name. All rights reserved.</p>
    </form>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const signupForm = document.getElementById('signupForm');
    const signupFormContainer = document.getElementById('signupFormContainer');
    const successContainer = document.getElementById('successContainer');

    // Handle form submission
    signupForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // In a real implementation, you would use fetch() to submit the form
        // Here's a mock success response after 1.5 seconds
        setTimeout(function() {
            // Hide form and show success message
            signupFormContainer.style.display = 'none';
            successContainer.style.display = 'block';
            
            // In a real implementation, you would:
            // 1. Submit the form with fetch()
            // 2. On success response, show the success message
            // 3. On error, show error messages
        }, 1500);
    });

    // Password strength checker and other existing JavaScript...
});

document.addEventListener('DOMContentLoaded', function() {
    // Auto-dismiss alerts after animation completes
    const alerts = document.querySelectorAll('.fade-out');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.remove();
        }, 5000); // matches CSS animation duration
    });

    // Password strength checker
    function checkPasswordStrength(password) {
        const strengthBar = document.getElementById('passwordStrengthBar');
        let strength = 0;
        
        // Check length
        if (password.length >= 8) strength += 1;
        if (password.length >= 12) strength += 1;
        
        // Check for mixed case
        if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1;
        
        // Check for numbers
        if (password.match(/[0-9]/)) strength += 1;
        
        // Check for special chars
        if (password.match(/[^a-zA-Z0-9]/)) strength += 1;
        
        // Update the strength bar
        switch(strength) {
            case 0:
                strengthBar.style.width = '0%';
                strengthBar.style.backgroundColor = 'var(--text-light)';
                break;
            case 1:
                strengthBar.style.width = '25%';
                strengthBar.style.backgroundColor = '#ef4444';
                break;
            case 2:
                strengthBar.style.width = '50%';
                strengthBar.style.backgroundColor = '#f59e0b';
                break;
            case 3:
                strengthBar.style.width = '75%';
                strengthBar.style.backgroundColor = '#3b82f6';
                break;
            case 4:
            case 5:
                strengthBar.style.width = '100%';
                strengthBar.style.backgroundColor = 'var(--success-color)';
                break;
        }
    }

    // Expose function to window for inline usage
    window.checkPasswordStrength = checkPasswordStrength;
});
</script>
@endsection