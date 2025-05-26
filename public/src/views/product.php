<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Premium Cotton Basics - Modern Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "brand-purple": "#6b46c1",
                        "brand-dark": "#1f2937",
                    },
                },
            },
        };
    </script>

    <style>
        /* Custom animations and styles */
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .loader {
            animation: spin 1s linear infinite;
        }

        .card-hover {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .swiper-slide {
            width: auto;
        }

        #main-content {
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        #main-content.loaded {
            opacity: 1;
        }
    </style>

</head>

<body class="bg-white">
    <!-- Loading Screen -->
    <div id="loading-screen"
        class="fixed inset-0 bg-gray-900 flex flex-col items-center justify-center text-white z-50">
        <div class="w-12 h-12 border-4 border-gray-600 border-t-emerald-500 rounded-full loader mb-4"></div>
        <p class="text-lg">Loading, please wait...</p>
    </div>
    <!-- Header -->
    <?php require_once('../include/header.php') ?>
    <!-- Breadcrumb -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <nav class="text-sm text-gray-500">
            <a href="#" class="hover:text-gray-700">Home</a> /
            <a href="#" class="hover:text-gray-700">Men</a> /
            <span class="text-gray-900">Basic Cotton T-Shirt</span>
        </nav>
    </div>

    <!-- Main Product Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Product Images -->
            <div class="space-y-4">
                <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden">
                    <img id="mainImage"
                        src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=600&h=600&fit=crop&crop=center"
                        alt="Main product image" class="w-full h-full object-cover" />
                </div>
                <div class="grid grid-cols-4 gap-4">
                    <button
                        onclick="changeImage('https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=600&h=600&fit=crop&crop=center')"
                        class="aspect-square bg-gray-100 rounded-lg overflow-hidden border-2 border-gray-900">
                        <img src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=150&h=150&fit=crop&crop=center"
                            alt="Product view 1" class="w-full h-full object-cover" />
                    </button>
                    <button
                        onclick="changeImage('https://images.unsplash.com/photo-1576566588028-4147f3842f27?w=600&h=600&fit=crop&crop=center')"
                        class="aspect-square bg-gray-100 rounded-lg overflow-hidden border-2 border-transparent hover:border-gray-300">
                        <img src="https://images.unsplash.com/photo-1576566588028-4147f3842f27?w=150&h=150&fit=crop&crop=center"
                            alt="Product view 2" class="w-full h-full object-cover" />
                    </button>
                    <button
                        onclick="changeImage('https://images.unsplash.com/photo-1583743814966-8936f37f652?w=600&h=600&fit=crop&crop=center')"
                        class="aspect-square bg-gray-100 rounded-lg overflow-hidden border-2 border-transparent hover:border-gray-300">
                        <img src="https://images.unsplash.com/photo-1583743814966-8936f37f652?w=150&h=150&fit=crop&crop=center"
                            alt="Product view 3" class="w-full h-full object-cover" />
                    </button>
                    <button
                        onclick="changeImage('https://images.unsplash.com/photo-1618354691373-d851c5c3a990?w=600&h=600&fit=crop&crop=center')"
                        class="aspect-square bg-gray-100 rounded-lg overflow-hidden border-2 border-transparent hover:border-gray-300">
                        <img src="https://images.unsplash.com/photo-1618354691373-d851c5c3a990?w=150&h=150&fit=crop&crop=center"
                            alt="Product view 4" class="w-full h-full object-cover" />
                    </button>
                </div>
            </div>

            <!-- Product Info -->
            <div class="space-y-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">
                        Premium Cotton Basic T-Shirt
                    </h1>
                    <p class="text-xl text-gray-600 mt-2">Essential wardrobe staple</p>
                </div>

                <div class="flex items-center space-x-4">
                    <span class="text-2xl font-bold text-gray-900">$24.99</span>
                    <span class="text-lg text-gray-500 line-through">$34.99</span>
                    <span class="bg-red-100 text-red-800 px-2 py-1 text-sm font-semibold rounded">30% OFF</span>
                </div>

                <!-- Color Selection -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Color</h3>
                    <div class="flex space-x-3">
                        <button onclick="selectColor(this, 'white')"
                            class="w-10 h-10 bg-white border-2 border-gray-900 rounded-full"></button>
                        <button onclick="selectColor(this, 'black')"
                            class="w-10 h-10 bg-black border-2 border-transparent rounded-full hover:border-gray-300"></button>
                        <button onclick="selectColor(this, 'gray')"
                            class="w-10 h-10 bg-gray-500 border-2 border-transparent rounded-full hover:border-gray-300"></button>
                        <button onclick="selectColor(this, 'navy')"
                            class="w-10 h-10 bg-blue-900 border-2 border-transparent rounded-full hover:border-gray-300"></button>
                    </div>
                    <p class="text-sm text-gray-600 mt-2" id="selectedColor">
                        Selected: White
                    </p>
                </div>

                <!-- Size Selection -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Size</h3>
                    <div class="grid grid-cols-4 gap-3">
                        <button onclick="selectSize(this, 'XS')"
                            class="py-2 px-3 border border-gray-300 rounded-md text-center hover:border-gray-900">
                            XS
                        </button>
                        <button onclick="selectSize(this, 'S')"
                            class="py-2 px-3 border border-gray-300 rounded-md text-center hover:border-gray-900">
                            S
                        </button>
                        <button onclick="selectSize(this, 'M')"
                            class="py-2 px-3 border border-gray-900 bg-gray-900 text-white rounded-md text-center">
                            M
                        </button>
                        <button onclick="selectSize(this, 'L')"
                            class="py-2 px-3 border border-gray-300 rounded-md text-center hover:border-gray-900">
                            L
                        </button>
                        <button onclick="selectSize(this, 'XL')"
                            class="py-2 px-3 border border-gray-300 rounded-md text-center hover:border-gray-900">
                            XL
                        </button>
                        <button onclick="selectSize(this, 'XXL')"
                            class="py-2 px-3 border border-gray-300 rounded-md text-center hover:border-gray-900">
                            XXL
                        </button>
                    </div>
                    <p class="text-sm text-gray-600 mt-2" id="selectedSize">
                        Selected: M
                    </p>
                </div>

                <!-- Quantity -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Quantity</h3>
                    <div class="flex items-center space-x-3">
                        <button onclick="changeQuantity(-1)"
                            class="w-10 h-10 border border-gray-300 rounded-full flex items-center justify-center hover:border-gray-900">
                            <span class="text-lg">−</span>
                        </button>
                        <span id="quantity" class="text-lg font-semibold w-8 text-center">1</span>
                        <button onclick="changeQuantity(1)"
                            class="w-10 h-10 border border-gray-300 rounded-full flex items-center justify-center hover:border-gray-900">
                            <span class="text-lg">+</span>
                        </button>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-4">
                    <button onclick="addToCart()"
                        class="w-full bg-gray-900 text-white py-3 px-6 rounded-lg font-semibold hover:bg-gray-800 transition-colors">
                        Add to Cart
                    </button>
                    <button
                        class="w-full border border-gray-300 text-gray-900 py-3 px-6 rounded-lg font-semibold hover:border-gray-900 transition-colors">
                        Add to Wishlist
                    </button>
                </div>

                <!-- Product Details -->
                <div class="border-t pt-6">
                    <div class="space-y-4">
                        <details class="group">
                            <summary
                                class="flex justify-between items-center cursor-pointer font-semibold text-gray-900">
                                Product Details
                                <span class="group-open:rotate-180 transition-transform">↓</span>
                            </summary>
                            <div class="mt-4 text-gray-600 space-y-2">
                                <p>Premium 100% cotton construction</p>
                                <p>Pre-shrunk for lasting fit</p>
                                <p>Reinforced seams for durability</p>
                                <p>Classic crew neck design</p>
                            </div>
                        </details>

                        <details class="group">
                            <summary
                                class="flex justify-between items-center cursor-pointer font-semibold text-gray-900">
                                Size & Fit
                                <span class="group-open:rotate-180 transition-transform">↓</span>
                            </summary>
                            <div class="mt-4 text-gray-600">
                                <p>Regular fit through body and sleeves</p>
                                <p>Model is 6'2" and wears size M</p>
                            </div>
                        </details>

                        <details class="group">
                            <summary
                                class="flex justify-between items-center cursor-pointer font-semibold text-gray-900">
                                Care Instructions
                                <span class="group-open:rotate-180 transition-transform">↓</span>
                            </summary>
                            <div class="mt-4 text-gray-600">
                                <p>Machine wash cold with like colors</p>
                                <p>Tumble dry low</p>
                                <p>Do not bleach</p>
                            </div>
                        </details>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- You May Also Like -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h2 class="text-2xl font-bold text-gray-900 mb-8">You May Also Like</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="group">
                <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden mb-4">
                    <img src="https://images.unsplash.com/photo-1556821840-3a63f95609a7?w=300&h=300&fit=crop&crop=center"
                        alt="Related product"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform" />
                </div>
                <h3 class="font-semibold text-gray-900">Classic Crew Sweatshirt</h3>
                <p class="text-gray-600">$39.99</p>
            </div>

            <div class="group">
                <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden mb-4">
                    <img src="https://images.unsplash.com/photo-1594633312681-425c7b97ccd1?w=300&h=300&fit=crop&crop=center"
                        alt="Related product"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform" />
                </div>
                <h3 class="font-semibold text-gray-900">Relaxed Fit Jeans</h3>
                <p class="text-gray-600">$59.99</p>
            </div>

            <div class="group">
                <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden mb-4">
                    <img src="https://images.unsplash.com/photo-1562157873-818bc0726f68?w=300&h=300&fit=crop&crop=center"
                        alt="Related product"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform" />
                </div>
                <h3 class="font-semibold text-gray-900">Lightweight Hoodie</h3>
                <p class="text-gray-600">$44.99</p>
            </div>

            <div class="group">
                <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden mb-4">
                    <img src="https://images.unsplash.com/photo-1506629905607-d5b967e56db5?w=300&h=300&fit=crop&crop=center"
                        alt="Related product"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform" />
                </div>
                <h3 class="font-semibold text-gray-900">Cotton Chino Pants</h3>
                <p class="text-gray-600">$49.99</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php require_once('../include/footer.php') ?>

    <script src="../controllers/productRoute.js"></script>
</body>

</html>