<style>
    .footer {
        background-color: #121212;
        color: #f3fdfc;
        padding: 20px 0;
    }
    .footer .footer-link {
        color: rgba(255,255,255,0.75);
        text-decoration: none;
        transition: color 0.3s;
    }
    .footer .footer-link:hover {
        color: #ffffff;
    }
</style>

<footer class="footer">
    <div class="container text-center">
        <div class="row">
            <div class="col-md-6 text-start">
                <p class="mb-0">&copy; {{ date('Y') }} Lingo AI. All Rights Reserved.</p>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ url('/privacy-policy') }}" class="footer-link me-3">Privacy Policy</a>
                <a href="{{ url('/terms') }}" class="footer-link">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>

