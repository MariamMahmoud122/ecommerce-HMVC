<div> <div class="position-relative">
    <a href="/cart" class="text-decoration-none" style="color: #800020;">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>
        @if($count > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.7rem;">
                {{ $count }}
            </span>
        @endif
    </a>
</div>

    <style>
        .cart-icon:hover svg {
            color: #FF0000 !important;
            transform: scale(1.1);
            transition: 0.3s;
        }
    </style>
</div>
