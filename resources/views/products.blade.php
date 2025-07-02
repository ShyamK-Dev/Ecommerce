@extends('layouts.default')
@section('title', 'Ecom - Home')
@section('content')
    <main class="container py-5" style="max-width: 1200px">
        <section class="mb-5">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h2 fw-bold">Our Products</h1>
                <div class="d-flex">
                    <div class="dropdown me-2">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Sort By
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                            <li><a class="dropdown-item" href="#">Price: Low to High</a></li>
                            <li><a class="dropdown-item" href="#">Price: High to Low</a></li>
                            <li><a class="dropdown-item" href="#">Newest First</a></li>
                        </ul>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-outline-secondary"><i class="fas fa-th"></i></button>
                        <button type="button" class="btn btn-outline-secondary"><i class="fas fa-list"></i></button>
                    </div>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="row g-4">
                @foreach($products as $product)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                        <!-- Product Image with Badge -->
                        <div class="position-relative">
                            <img src="{{$product->image}}" alt="{{$product->title}}" class="card-img-top p-3 object-fit-cover" style="height: 200px">
                            @if($product->discount)
                            <span class="position-absolute top-0 start-0 bg-danger text-white px-2 py-1 m-2 small rounded">-{{$product->discount}}%</span>
                            @endif
                            <div class="card-img-overlay d-flex justify-content-end">
                                <button class="btn btn-sm btn-light rounded-circle shadow-sm" style="width: 32px; height: 32px">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Product Body -->
                        <div class="card-body pt-0">
                            <div class="d-flex flex-column h-100">
                                <!-- Title -->
                                <h3 class="h6 card-title mb-2">
                                    <a href="{{route('product.details', $product->slug)}}" class="text-decoration-none text-dark stretched-link">{{$product->title}}</a>
                                </h3>
                                
                                <!-- Price -->
                                <div class="mt-auto">
                                    @if($product->discount)
                                    <div class="d-flex align-items-center">
                                        <span class="text-danger fw-bold me-2">&#8377;{{number_format($product->price * (1 - $product->discount/100), 2)}}</span>
                                        <span class="text-muted text-decoration-line-through small">${{number_format($product->price, 2)}}</span>
                                    </div>
                                    @else
                                    <span class="fw-bold">&#8377;{{number_format($product->price, 2)}}</span>
                                    @endif
                                </div>
                                
                                <!-- Rating -->
                                <div class="small text-warning my-2">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <i class="far fa-star"></i>
                                    <span class="text-muted ms-1">(24)</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Add to Cart -->
                        <div class="card-footer bg-transparent border-0 pt-0 pb-3">
                            <button class="btn btn-primary w-100 add-to-cart" data-id="{{$product->id}}">
                                <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Enhanced Pagination -->
            @if($products->hasPages())
            <div class="mt-5">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center flex-wrap">
                        {{-- Previous Page Link --}}
                        @if($products->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link bg-light border-0">@lang('pagination.previous')</span>
                        </li>
                        @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $products->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
                        </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                            @if($page == $products->currentPage())
                            <li class="page-item active" aria-current="page">
                                <span class="page-link bg-primary border-primary">{{ $page }}</span>
                            </li>
                            @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if($products->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $products->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
                        </li>
                        @else
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link bg-light border-0">@lang('pagination.next')</span>
                        </li>
                        @endif
                    </ul>
                </nav>
                
                {{-- Showing Results --}}
                <div class="text-center text-muted small mt-2">
                    Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} results
                </div>
            </div>
            @endif
        </section>
    </main>
@endsection

@section('styles')
<style>
    /* Custom Styles */
    .hover-shadow {
        transition: all 0.3s ease;
    }
    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .object-fit-cover {
        object-fit: cover;
        object-position: center;
    }
    .transition-all {
        transition: all 0.3s ease;
    }
    .stretched-link::after {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 1;
        content: "";
    }
    .add-to-cart {
        transition: all 0.3s ease;
    }
    .add-to-cart:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    /* Pagination Styles */
    .page-item {
        margin: 0 2px;
    }
    .page-link {
        border-radius: 6px !important;
        border: 1px solid #dee2e6;
        color: #4a5568;
        min-width: 40px;
        text-align: center;
        transition: all 0.2s ease;
    }
    .page-link:hover {
        background-color: #f8f9fa;
        border-color: #dee2e6;
    }
    .page-item.active .page-link {
        font-weight: 500;
        box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);
    }
    .page-item.disabled .page-link {
        color: #adb5bd;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add to cart functionality
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-id');
                // AJAX call to add to cart
                console.log('Added product ID:', productId);
                
                // Show temporary feedback
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-check me-2"></i>Added!';
                this.classList.add('btn-success');
                this.classList.remove('btn-primary');
                
                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.classList.remove('btn-success');
                    this.classList.add('btn-primary');
                }, 2000);
            });
        });
    });
</script>
@endsection