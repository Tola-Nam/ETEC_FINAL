<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    'brand-purple': '#6366f1',
                    'brand-purple-light': '#818cf8',
                    'brand-purple-dark': '#4f46e5'
                }
            }
        }
    }
</script>
<style>
    /* Custom animations and transitions */
    .hover-lift {
        transition: all 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-2px);
    }

    .gradient-bg {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
    }

    .link-hover {
        position: relative;
        transition: all 0.3s ease;
    }

    .link-hover::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -4px;
        left: 0;
        background-color: white;
        transition: width 0.3s ease;
    }

    .link-hover:hover::after {
        width: 100%;
    }

    .newsletter-input:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.3);
    }

    .subscribe-btn {
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .subscribe-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s;
    }

    .subscribe-btn:hover::before {
        left: 100%;
    }

    @media (max-width: 768px) {
        .mobile-center {
            text-align: center;
        }
    }
</style>
</head>

<body class="bg-gray-100 min-h-screen">
    <!-- Main content placeholder -->
    <div class="flex-1 flex items-center justify-center py-20">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Your Website Content</h1>
            <p class="text-gray-600">Scroll down to see the enhanced footer</p>
        </div>
    </div>

    <!-- Enhanced Footer -->
    <footer class="gradient-bg text-white relative overflow-hidden">
        <!-- Background decoration -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-64 h-64 bg-white rounded-full -translate-x-32 -translate-y-32"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full translate-x-48 translate-y-48"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
                <!-- Shop Section -->
                <div class="mobile-center hover-lift">
                    <h3 class="text-xl font-bold mb-6 text-white">
                        <span class="border-b-2 border-white/30 pb-2">Shop</span>
                    </h3>
                    <ul class="space-y-3">
                        <li><a href="#"
                                class="link-hover text-white/90 hover:text-white text-sm font-medium block py-1">New
                                Arrivals</a></li>
                        <li><a href="#"
                                class="link-hover text-white/90 hover:text-white text-sm font-medium block py-1">Men's
                                Collection</a></li>
                        <li><a href="#"
                                class="link-hover text-white/90 hover:text-white text-sm font-medium block py-1">Women's
                                Collection</a></li>
                        <li><a href="#"
                                class="link-hover text-white/90 hover:text-white text-sm font-medium block py-1">Sale
                                Items</a></li>
                        <li><a href="#"
                                class="link-hover text-white/90 hover:text-white text-sm font-medium block py-1">Accessories</a>
                        </li>
                    </ul>
                </div>

                <!-- Support Section -->
                <div class="mobile-center hover-lift">
                    <h3 class="text-xl font-bold mb-6 text-white">
                        <span class="border-b-2 border-white/30 pb-2">Support</span>
                    </h3>
                    <ul class="space-y-3">
                        <li><a href="#"
                                class="link-hover text-white/90 hover:text-white text-sm font-medium block py-1">Contact
                                Us</a></li>
                        <li><a href="#"
                                class="link-hover text-white/90 hover:text-white text-sm font-medium block py-1">Size
                                Guide</a></li>
                        <li><a href="#"
                                class="link-hover text-white/90 hover:text-white text-sm font-medium block py-1">Returns
                                & Exchanges</a></li>
                        <li><a href="#"
                                class="link-hover text-white/90 hover:text-white text-sm font-medium block py-1">FAQ</a>
                        </li>
                        <li><a href="#"
                                class="link-hover text-white/90 hover:text-white text-sm font-medium block py-1">Shipping
                                Info</a></li>
                    </ul>
                </div>

                <!-- Company Section -->
                <div class="mobile-center hover-lift">
                    <h3 class="text-xl font-bold mb-6 text-white">
                        <span class="border-b-2 border-white/30 pb-2">Company</span>
                    </h3>
                    <ul class="space-y-3">
                        <li><a href="#"
                                class="link-hover text-white/90 hover:text-white text-sm font-medium block py-1">About
                                Us</a></li>
                        <li><a href="#"
                                class="link-hover text-white/90 hover:text-white text-sm font-medium block py-1">Careers</a>
                        </li>
                        <li><a href="#"
                                class="link-hover text-white/90 hover:text-white text-sm font-medium block py-1">Sustainability</a>
                        </li>
                        <li><a href="#"
                                class="link-hover text-white/90 hover:text-white text-sm font-medium block py-1">Press &
                                Media</a></li>
                        <li><a href="#"
                                class="link-hover text-white/90 hover:text-white text-sm font-medium block py-1">Investors</a>
                        </li>
                    </ul>
                </div>

                <!-- Newsletter Section -->
                <div class="mobile-center hover-lift lg:col-span-1">
                    <h3 class="text-xl font-bold mb-6 text-white">
                        <span class="border-b-2 border-white/30 pb-2">Stay Connected</span>
                    </h3>
                    <p class="text-white/90 mb-6 text-sm leading-relaxed">
                        Subscribe to get updates on new products, exclusive offers, and style inspiration delivered to
                        your inbox.
                    </p>
                    <div class="space-y-4">
                        <div class="flex flex-col sm:flex-row gap-2">
                            <input type="email" placeholder="Enter your email"
                                class="newsletter-input flex-1 px-4 py-3 text-gray-900 rounded-lg border-2 border-transparent focus:border-white/50 transition-all duration-300" />
                            <button
                                class="subscribe-btn flex-shrink-0 min-w-[120px] bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-6 py-3 rounded-xl font-semibold shadow-md hover:shadow-xl hover:from-purple-700 hover:to-indigo-700 transform hover:scale-105 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-400">
                                Subscribe
                            </button>

                        </div>

                        <!-- Social Media Links -->
                        <div class="flex justify-center lg:justify-start space-x-4 mt-6">
                            <a href="#"
                                class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center hover:bg-white/30 hover:scale-110 transition-all duration-300">
                                <span class="text-white font-bold">f</span>
                            </a>
                            <a href="#"
                                class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center hover:bg-white/30 hover:scale-110 transition-all duration-300">
                                <span class="text-white font-bold">t</span>
                            </a>
                            <a href="#"
                                class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center hover:bg-white/30 hover:scale-110 transition-all duration-300">
                                <span class="text-white font-bold">i</span>
                            </a>
                            <a href="#"
                                class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center hover:bg-white/30 hover:scale-110 transition-all duration-300">
                                <span class="text-white font-bold">y</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>