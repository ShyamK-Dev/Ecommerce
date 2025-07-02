@extends('layouts.default')
@section('title', $product->title . ' | Ecom')
@section('content')
    <main class="container py-5" style="max-width: 1200px">
        <section>
             <!-- Animated Alert Messages -->
             @if(session()->has('success'))
             <div class="alert-message alert-success fade-out">
                 <div class="d-flex align-items-center">
                     <i class="fas fa-check-circle me-2"></i>
                     {{ session()->get('success') }}
                 </div>
                 <div class="alert-progress"></div>
             </div>
             @endif
             
             @if(session('error'))
             <div class="alert-message alert-danger fade-out">
                 <div class="d-flex align-items-center">
                     <i class="fas fa-exclamation-circle me-2"></i>
                     {{ session('error') }}
                 </div>
                 <div class="alert-progress"></div>
             </div>
             @endif
 

            <div class="row g-5">
                <!-- Product Images -->
                <div class="col-md-6">
                    <div class="mb-4">
                        <img src="{{ $product->image }}" alt="{{ $product->title }}" class="img-fluid rounded shadow-sm" style="max-height: 500px; width: 100%; object-fit: contain;">
                    </div>
                    <div class="d-flex gap-2">
                        @foreach([$product->image, $product->image, $product->image] as $thumbnail)
                        <button class="btn p-0 border rounded" style="width: 80px; height: 80px;">
                            <img src="{{ $thumbnail }}" alt="Thumbnail" class="img-fluid h-100 w-100 object-fit-cover">
                        </button>
                        @endforeach
                    </div>
                </div>

                <!-- Product Details -->
                <div class="col-md-6">
                    <div class="d-flex flex-column h-100">
                        <!-- Title & Price -->
                        <div class="mb-3">
                            <h1 class="h2 fw-bold mb-2">{{ $product->title }}</h1>
                            <div class="d-flex align-items-center mb-3">
                                @if($product->discount)
                                <span class="text-danger fs-4 fw-bold me-2">${{ number_format($product->price * (1 - $product->discount/100), 2) }}</span>
                                <span class="text-muted text-decoration-line-through">${{ number_format($product->price, 2) }}</span>
                                <span class="badge bg-danger ms-2">Save {{ $product->discount }}%</span>
                                @else
                                <span class="fs-4 fw-bold">&#8377;{{ number_format($product->price, 2) }}</span>
                                @endif
                            </div>
                        </div>

                        <!-- Rating & Stock -->
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-2">
                                <div class="text-warning small me-2">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <span class="text-muted small">(24 reviews)</span>
                                <span class="ms-3 text-success small">
                                    <i class="fas fa-check-circle me-1"></i> In Stock
                                </span>
                            </div>
                            <div class="text-muted small">
                                <span>SKU: {{ $product->sku ?? 'N/A' }}</span>
                                <span class="ms-3">Category: {{ $product->category->name ?? 'Uncategorized' }}</span>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <h3 class="h5 mb-2">Description</h3>
                            <p class="text-muted">{{ $product->description }}</p>
                        </div>

                        <!-- Quantity & Add to Cart -->
                        <div class="mt-auto">
                            <div class="row g-3 align-items-center mb-4">
                                <div class="col-auto">
                                    <label for="quantity" class="col-form-label">Quantity:</label>
                                </div>
                                <div class="col-auto">
                                    <div class="input-group" style="width: 120px;">
                                        <button class="btn btn-outline-secondary" type="button">-</button>
                                        <input type="number" class="form-control text-center" value="1" min="1" id="quantity">
                                        <button class="btn btn-outline-secondary" type="button">+</button>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-3">
                                <a class="btn btn-primary flex-grow-1 py-3" href="{{route('cart.add', $product->id)}}">
                                    <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                                </a>
                                <button class="btn btn-outline-secondary px-3">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Additional Info -->
                        <div class="mt-4 pt-3 border-top">
                            <div class="d-flex small text-muted gap-4">
                                <span><i class="fas fa-shield-alt me-2"></i> 1-Year Warranty</span>
                                <span><i class="fas fa-truck me-2"></i> Free Shipping</span>
                                <span><i class="fas fa-undo me-2"></i> 30-Day Returns</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Tabs -->
            <div class="row mt-5">
                <div class="col-12">
                    <ul class="nav nav-tabs" id="productTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button">Details</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="specs-tab" data-bs-toggle="tab" data-bs-target="#specs" type="button">Specifications</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button">Reviews</button>
                        </li>
                    </ul>
                    <div class="tab-content p-4 border border-top-0 rounded-bottom">
                        <div class="tab-pane fade show active" id="details" role="tabpanel">
                            <p>Detailed product information goes here. You can include more specific details about the product features, materials, dimensions, etc.</p>
                            <p>{{ $product->description }}</p>
                        </div>
                        <div class="tab-pane fade" id="specs" role="tabpanel">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row">Material</th>
                                        <td>Premium Quality</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Dimensions</th>
                                        <td>10 x 5 x 3 inches</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Weight</th>
                                        <td>1.5 lbs</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Color</th>
                                        <td>Black</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="reviews" role="tabpanel">
                            <div class="mb-4">
                                <h5>Customer Reviews</h5>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="text-warning me-2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                    <span>4.2 out of 5</span>
                                </div>
                                <button class="btn btn-sm btn-outline-primary">Write a Review</button>
                            </div>
                            <!-- Sample Reviews -->
                            <div class="border-top pt-3">
                                <!-- Review items would go here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Products -->
            <div class="row mt-5">
                <div class="col-12">
                    <h3 class="h4 mb-4">You may also like</h3>
                    <div class="row g-4">
                        @foreach([1,2,3,4] as $related)
                        <div class="col-6 col-md-3">
                            <div class="card h-100 border-0 shadow-sm">
                                <img src="{{ $product->image }}" class="card-img-top p-3" alt="Related product">
                                <div class="card-body">
                                    <h5 class="card-title h6">{{ $product->title }}</h5>
                                    <p class="card-text text-primary fw-bold">&#8377;{{ number_format($product->price * 0.9, 2) }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('styles')
<style>
    .object-fit-cover {
        object-fit: cover;
    }
    .nav-tabs .nav-link {
        color: #495057;
        font-weight: 500;
    }
    .nav-tabs .nav-link.active {
        color: #6366f1;
        border-bottom: 2px solid #6366f1;
    }
    .input-group button {
        width: 40px;
    }
    #quantity {
        -moz-appearance: textfield;
    }
    #quantity::-webkit-outer-spin-button,
    #quantity::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

     /* Animated Alert Styles */
     .alert-message {
        position: fixed;
        top: 20px;
        right: 20px;
        min-width: 300px;
        padding: 15px 20px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 1050;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }
    
    .alert-success {
        background-color: #d1fae5;
        color: #065f46;
        border-left: 4px solid #10b981;
    }
    
    .alert-danger {
        background-color: #fee2e2;
        color: #b91c1c;
        border-left: 4px solid #ef4444;
    }
    
    .alert-progress {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 4px;
        background-color: rgba(255,255,255,0.4);
        width: 100%;
        transform-origin: left;
        animation: progress 5s linear forwards;
    }
    
    .alert-success .alert-progress {
        background-color: rgba(16, 185, 129, 0.4);
    }
    
    .alert-danger .alert-progress {
        background-color: rgba(239, 68, 68, 0.4);
    }
    
    @keyframes progress {
        0% { transform: scaleX(1); }
        100% { transform: scaleX(0); }
    }
    
    .fade-out {
        animation: fadeOut 0.5s ease forwards;
        animation-delay: 4.5s;
    }
    
    @keyframes fadeOut {
        to { opacity: 0; transform: translateY(-20px); }
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Quantity controls
        document.querySelectorAll('.input-group button').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.parentNode.querySelector('input');
                let value = parseInt(input.value);
                if (this.textContent === '+') {
                    input.value = value + 1;
                } else {
                    if (value > 1) input.value = value - 1;
                }
            });
        });
    

    // Auto-remove alerts after animation completes
    const alerts = document.querySelectorAll('.fade-out');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.remove();
            }, 5000); // matches total animation duration
        });
    });
</script>
@endsection