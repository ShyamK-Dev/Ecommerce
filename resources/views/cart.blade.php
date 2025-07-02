@extends('layouts.default')
@section('title', 'Your Cart | Ecom')
@section('content')
    <section class="py-4">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h2 fw-bold mb-0">Your Shopping Cart</h1>
                <span class="badge bg-primary rounded-pill">{{ $cartItems->sum('quantity') }} items</span>
            </div>

            @if($cartItems->isEmpty())
                <div class="card border-0 shadow-sm text-center py-5">
                    <div class="card-body">
                        <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
                        <h3 class="h4 mb-3">Your cart is empty</h3>
                        <a href="{{ route('home') }}" class="btn btn-primary px-4">
                            <i class="fas fa-arrow-left me-2"></i> Continue Shopping
                        </a>
                    </div>
                </div>
            @else
                <div class="row g-4">
                    @foreach($cartItems as $item)
                    <div class="col-12">
                        <div class="card border-0 shadow-sm hover-lift">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="{{ $item->image }}" class="img-fluid rounded-start h-100 object-fit-cover" 
                                         alt="{{ $item->title }}" style="min-height: 200px;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body d-flex flex-column h-100">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <h5 class="card-title mb-2">
                                                <a href="{{ route('product.details', $item->slug) }}" 
                                                   class="text-decoration-none text-dark">
                                                    {{ $item->title }}
                                                </a>
                                            </h5>
                                            <form action="{{ route('cart.remove', $item->product_id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-link text-danger p-0">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                        
                                        <div class="mt-auto">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <form action="{{ route('cart.update', $item->product_id) }}" method="POST" class="d-flex">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="action" value="decrease">
                                                        <button type="submit" class="btn btn-sm btn-outline-secondary minus-btn">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                    </form>
                                                    <span class="mx-3">{{ $item->quantity }}</span>
                                                    <form action="{{ route('cart.update', $item->product_id) }}" method="POST" class="d-flex">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="action" value="increase">
                                                        <button type="submit" class="btn btn-sm btn-outline-secondary plus-btn">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                                <span class="fs-5 fw-bold">&#8377;{{ number_format($item->price * $item->quantity, 2) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                
                <!-- Pagination -->
                @if($cartItems->hasPages())
                <div class="row mt-4">
                    <div class="col-12">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                {{-- Previous Page Link --}}
                                @if($cartItems->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link">&laquo;</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $cartItems->previousPageUrl() }}" rel="prev">&laquo;</a>
                                    </li>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach($cartItems->getUrlRange(1, $cartItems->lastPage()) as $page => $url)
                                    @if($page == $cartItems->currentPage())
                                        <li class="page-item active">
                                            <span class="page-link">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if($cartItems->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $cartItems->nextPageUrl() }}" rel="next">&raquo;</a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link">&raquo;</span>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
                @endif

                <!-- Order Summary -->
                <div class="row mt-4">
                    <div class="col-md-6 offset-md-6">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Order Summary</h5>
                                
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal ({{ \App\Models\Cart::where('user_id', Auth::id())->count() }} items)</span>
                                    <span>&#8377;{{ number_format($subtotal, 2) }}</span>
                                </div>
                                
                                
                                
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Shipping</span>
                                    <span>&#8377;0.00</span> <!-- Adjust as needed -->
                                </div>
                                
                                <hr>
                                
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="fw-bold">Total</span>
                                    <span class="fw-bold">&#8377;{{ number_format($subtotal, 2) }}</span>
                                </div>
                                
                                <a href="{{ route('checkout.show') }}" class="btn btn-primary w-100 py-2">
                                    <i class="fas fa-lock me-2"></i> Proceed to Checkout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

@section('styles')

<style>
    .hover-lift {
        transition: all 0.3s ease;
    }
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .object-fit-cover {
        object-fit: cover;
        object-position: center;
    }

    .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
    .page-link {
        color: #0d6efd;
    }
    
</style>
@endsection