@extends('layouts.default')
@section('title', 'Payment')
@section('content')
<main class="checkout-container">
    <div class="checkout-card">
        <div class="checkout-header">
            <div class="checkout-progress">
                <div class="progress-step">
                    <div class="step-number">1</div>
                    <div class="step-label">Information</div>
                </div>
                <div class="progress-step active">
                    <div class="step-number">2</div>
                    <div class="step-label">Payment</div>
                </div>
                <div class="progress-step">
                    <div class="step-number">3</div>
                    <div class="step-label">Confirmation</div>
                </div>
            </div>
            <h1 class="checkout-title">Complete Payment</h1>
            <p class="checkout-subtitle">Secure transaction powered by Razorpay</p>
        </div>

        <div class="payment-body">
          

            <!-- Order Summary -->
            <div class="payment-summary">
                @foreach($cartItems as $item)
                <div class="summary-item">
                    <div class="d-flex align-items-center">
                        <img src="{{ $item->image }}" alt="{{ $item->title }}" 
                             class="img-thumbnail me-3" style="width: 60px; height: 60px; object-fit: cover;">
                        <div>
                            <h6 class="mb-0">{{ $item->title }}</h6>
                            <small class="text-muted">Qty: {{ $item->quantity }}</small>
                        </div>
                    </div>
                    <span class="amount">₹{{ number_format($item->price * $item->quantity, 2) }}</span>
                </div>
                @endforeach
                
                <div class="summary-divider"></div>
                
                <div class="summary-item">
                    <span>Subtotal ({{ \App\Models\Cart::where('user_id', Auth::id())->count() }} items)</span>
                    <span>₹{{ number_format($subtotal, 2) }}</span>
                </div>
                
                <div class="summary-item">
                    <span>Delivery</span>
                    <span class="free">FREE</span>
                </div>
                
                <div class="summary-divider"></div>
                
                <div class="summary-total">
                    <span>Total Payable</span>
                    <span class="total-amount">₹{{ number_format($subtotal, 2) }}</span>
                </div>
            </div>

            <!-- Payment Form -->
            <form action="{{ route('payment.create-order') }}" method="POST" class="checkout-form">
                @csrf
                <div class="form-actions">
                    <button type="submit" class="checkout-button payment-button" id="pay-button">
                        <span class="button-text">Pay Now</span>
                        <span class="button-amount">₹{{ number_format($subtotal, 2) }}</span>
                        <i class="fas fa-lock button-icon"></i>
                    </button>
                </div>
            </form>

            <div class="payment-security">
                <i class="fas fa-shield-alt security-icon"></i>
                <span class="security-text">Secure 256-bit SSL encrypted payment</span>
            </div>
        </div>
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

    .payment-body {
        margin-top: 2rem;
    }

    .shipping-review {
        background: #f8fafc;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1.5rem;
    }

    .shipping-review h3 {
        color: var(--dark);
    }

    .payment-summary {
        background: #f8fafc;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .summary-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.75rem;
        font-size: 1rem;
        color: #475569;
    }

    .summary-item .d-flex {
        width: 70%;
    }

    .amount {
        font-weight: 500;
        color: #1e293b;
    }

    .free {
        color: #10b981;
        font-weight: 500;
    }

    .summary-divider {
        height: 1px;
        background: #e2e8f0;
        margin: 1rem 0;
    }

    .summary-total {
        display: flex;
        justify-content: space-between;
        font-size: 1.1rem;
        font-weight: 600;
        color: #1e293b;
    }

    .total-amount {
        color: #4f46e5;
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

    .payment-button {
        width: 100%;
        justify-content: space-between;
        padding: 1rem 1.5rem;
    }

    .button-text {
        flex-grow: 1;
        text-align: left;
    }

    .button-amount {
        margin: 0 1rem;
        font-weight: 700;
    }

    .button-icon {
        transition: transform 0.3s ease;
    }

    .checkout-button:hover .button-icon {
        transform: translateX(4px);
    }

    .payment-security {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 1.5rem;
        color: #64748b;
        font-size: 0.85rem;
    }

    .security-icon {
        color: #10b981;
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
        
        .payment-button {
            padding: 1rem;
        }
        
        .button-amount {
            margin: 0 0.5rem;
        }
    }
</style>
@endsection