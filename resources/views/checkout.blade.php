@extends('layouts.default')
@section('title', 'Checkout')
@section('content')
    <main class="checkout-container">
        <div class="checkout-card">
            <div class="checkout-header">
                <div class="checkout-progress">
                    <div class="progress-step active">
                        <div class="step-number">1</div>
                        <div class="step-label">Information</div>
                    </div>
                    <div class="progress-step">
                        <div class="step-number">2</div>
                        <div class="step-label">Payment</div>
                    </div>
                    <div class="progress-step">
                        <div class="step-number">3</div>
                        <div class="step-label">Confirmation</div>
                    </div>
                </div>
                <h1 class="checkout-title">Checkout Details</h1>
                <p class="checkout-subtitle">Please enter your shipping information</p>
            </div>

            <form action="{{route('checkout.post')}}" method="POST" class="checkout-form">
                @csrf
                <div class="form-group floating">
                    <input type="text" class="form-control" id="address" name="address" placeholder=" " required>
                    <label for="address">Delivery Address</label>
                    <i class="fas fa-map-marker-alt input-icon"></i>
                </div>

                <div class="form-group floating">
                    <input type="text" class="form-control" id="phone" name="phone" placeholder=" " required>
                    <label for="phone">Phone Number</label>
                    <i class="fas fa-phone input-icon"></i>
                </div>

                <div class="form-group floating">
                    <input type="text" class="form-control" id="pincode" name="pincode" placeholder=" " required>
                    <label for="pincode">Postal/Zip Code</label>
                    <i class="fas fa-mail-bulk input-icon"></i>
                </div>

                <div class="form-actions">
                    <button type="submit" class="checkout-button">
                        <span>Continue to Payment</span>
                        <i class="fas fa-arrow-right button-icon"></i>
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection

@section('style')
<style>
    :root {
        --primary: #4f46e5;
        --primary-light: #6366f1;
        --dark: #1e293b;
        --light: #f8fafc;
        --border: #e2e8f0;
        --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .checkout-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 2rem;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

    .checkout-card {
        width: 100%;
        max-width: 600px;
        background: white;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        padding: 2.5rem;
    }

    .checkout-header {
        margin-bottom: 2.5rem;
        text-align: center;
    }

    .checkout-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--dark);
        margin: 1rem 0 0.5rem;
    }

    .checkout-subtitle {
        color: #64748b;
        font-size: 0.95rem;
        margin-bottom: 0;
    }

    .checkout-progress {
        display: flex;
        justify-content: space-between;
        position: relative;
        margin-bottom: 2rem;
    }

    .checkout-progress::before {
        content: '';
        position: absolute;
        top: 20px;
        left: 0;
        right: 0;
        height: 2px;
        background: var(--border);
        z-index: 1;
    }

    .progress-step {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        z-index: 2;
    }

    .progress-step.active .step-number {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    .step-number {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: white;
        border: 2px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        color: #94a3b8;
        transition: all 0.3s ease;
    }

    .step-label {
        margin-top: 0.5rem;
        font-size: 0.8rem;
        color: #94a3b8;
        font-weight: 500;
    }

    .progress-step.active .step-label {
        color: var(--primary);
    }

    .form-group {
        position: relative;
        margin-bottom: 1.75rem;
    }

    .form-control {
        width: 100%;
        padding: 1rem 1rem 1rem 3rem;
        border: 1px solid var(--border);
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background-color: #f8fafc;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary-light);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
        background-color: white;
    }

    .floating label {
        position: absolute;
        left: 3rem;
        top: 1rem;
        color: #64748b;
        transition: all 0.2s ease;
        pointer-events: none;
        background: white;
        padding: 0 0.5rem;
    }

    .floating input:focus + label,
    .floating input:not(:placeholder-shown) + label {
        top: -0.6rem;
        left: 2.5rem;
        font-size: 0.8rem;
        color: var(--primary);
        background: linear-gradient(to bottom, white 50%, #f8fafc 50%);
    }

    .input-icon {
        position: absolute;
        left: 1rem;
        top: 1rem;
        color: #94a3b8;
    }

    .form-control:focus ~ .input-icon {
        color: var(--primary);
    }

    .checkout-button {
        width: 100%;
        padding: 1rem;
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        transition: all 0.3s ease;
        margin-top: 1rem;
    }

    .checkout-button:hover {
        background: var(--primary-light);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    }

    .button-icon {
        transition: transform 0.3s ease;
    }

    .checkout-button:hover .button-icon {
        transform: translateX(4px);
    }

    @media (max-width: 640px) {
        .checkout-card {
            padding: 1.5rem;
        }
        
        .checkout-title {
            font-size: 1.5rem;
        }
        
        .step-number {
            width: 32px;
            height: 32px;
            font-size: 0.9rem;
        }
    }
</style>
@endsection