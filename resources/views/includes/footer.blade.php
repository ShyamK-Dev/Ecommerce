<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
/* Footer Styles */
footer {
    box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);
}

.social-links a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background-color: #f8f9fa;
    color: #6c757d;
    transition: all 0.3s ease;
}

.social-links a:hover {
    background-color: #6366f1;
    color: white;
    transform: translateY(-3px);
}

footer ul li a {
    transition: all 0.2s ease;
}

footer ul li a:hover {
    color: #6366f1 !important;
    padding-left: 3px;
}

.input-group button {
    background: linear-gradient(135deg, #8b5cf6, #6366f1);
    border: none;
}
</style>

<footer class="bg-white py-5 mt-auto">
    <div class="container">
        <div class="row">
            <!-- Company Info -->
            <div class="col-lg-4 mb-4 mb-lg-0">
                <img src="{{ asset('assets/img/logoimg.png') }}" alt="Logo" height="60" class="mb-3">
                <p class="text-muted">Making authentication simple and secure for everyone.</p>
                <div class="social-links mt-3">
                    <a href="#" class="text-decoration-none me-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-decoration-none me-3"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-decoration-none me-3"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-decoration-none me-3"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="text-decoration-none"><i class="fab fa-github"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-md-4 col-lg-2 mb-4 mb-md-0">
                <h5 class="mb-3">Quick Links</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="" class="text-decoration-none text-muted">Home</a></li>
                    <li class="mb-2"><a href="" class="text-decoration-none text-muted">About Us</a></li>
                    <li class="mb-2"><a href="" class="text-decoration-none text-muted">Features</a></li>
                    <li class="mb-2"><a href="" class="text-decoration-none text-muted">Pricing</a></li>
                    <li><a href="" class="text-decoration-none text-muted">Contact</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div class="col-md-4 col-lg-2 mb-4 mb-md-0">
                <h5 class="mb-3">Support</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="" class="text-decoration-none text-muted">FAQ</a></li>
                    <li class="mb-2"><a href="" class="text-decoration-none text-muted">Privacy Policy</a></li>
                    <li class="mb-2"><a href="" class="text-decoration-none text-muted">Terms of Service</a></li>
                    <li><a href="#" class="text-decoration-none text-muted">Help Center</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div class="col-lg-4">
                <h5 class="mb-3">Subscribe to our Newsletter</h5>
                <p class="text-muted mb-3">Stay updated with our latest news and offers.</p>
                <form class="mb-3">
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Your email" aria-label="Your email">
                        <button class="btn btn-primary" type="button">Subscribe</button>
                    </div>
                </form>
                <small class="text-muted">We'll never share your email with anyone else.</small>
            </div>
        </div>

        <hr class="my-4">

        <div class="row align-items-center">
            <div class="col-12 text-center ">
                <p class="text-muted mb-0">&copy; {{ date('Y') }} Your Company. All rights reserved.</p>
            </div>
            <div class="col-12 text-center ">
                <p class="text-muted mb-0">Made with <i class="fas fa-heart text-danger"></i> by Your Team</p>
            </div>
        </div>
    </div>
</footer>
