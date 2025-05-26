<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zalando - Fashion Store</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css">
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

<body class="bg-white font-sans">
    <!-- Loading Screen -->
    <div id="loading-screen"
        class="fixed inset-0 bg-gray-900 flex flex-col items-center justify-center text-white z-50">
        <div class="w-12 h-12 border-4 border-gray-600 border-t-emerald-500 rounded-full loader mb-4"></div>
        <p class="text-lg">Loading, please wait...</p>
    </div>

    <!-- Main Content -->
    <div id="main-content" class="container mx-auto px-4 mt-4">
        <!-- Navigation -->
        <?php include('../include/header.php') ?>
        <!-- Swiper Container -->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <!-- Category 1: New Arrivals -->
                <div class="swiper-slide">
                    <div class="p-6">
                        <h4 class="text-2xl font-bold text-gray-900 mb-6">New Arrivals</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <a href="./product.php"
                                class="bg-white rounded-lg shadow-md overflow-hidden card-hover cursor-pointer">
                                <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=300&h=200&fit=crop"
                                    class="w-full h-48 object-cover" alt="Fashion Item 1" loading="lazy">
                                <div class="p-4">
                                    <h5 class="text-lg font-semibold text-gray-900 mb-2">Summer Collection</h5>
                                    <p class="text-gray-600 text-sm mb-3">Discover the latest trends for this season.
                                    </p>
                                    <span
                                        class="inline-block bg-emerald-500 text-white px-3 py-1 rounded-full text-sm font-medium">$29.99</span>
                                </div>
                            </a>

                            <div class="bg-white rounded-lg shadow-md overflow-hidden card-hover cursor-pointer">
                                <img src="https://images.unsplash.com/photo-1445205170230-053b83016050?w=300&h=200&fit=crop"
                                    class="w-full h-48 object-cover" alt="Fashion Item 2" loading="lazy">
                                <div class="p-4">
                                    <h5 class="text-lg font-semibold text-gray-900 mb-2">Casual Wear</h5>
                                    <p class="text-gray-600 text-sm mb-3">Comfortable styles for everyday wear.</p>
                                    <span
                                        class="inline-block bg-emerald-500 text-white px-3 py-1 rounded-full text-sm font-medium">$39.99</span>
                                </div>
                            </div>

                            <div class="bg-white rounded-lg shadow-md overflow-hidden card-hover cursor-pointer">
                                <img src="https://images.unsplash.com/photo-1434389677669-e08b4cac3105?w=300&h=200&fit=crop"
                                    class="w-full h-48 object-cover" alt="Fashion Item 3" loading="lazy">
                                <div class="p-4">
                                    <h5 class="text-lg font-semibold text-gray-900 mb-2">Accessories</h5>
                                    <p class="text-gray-600 text-sm mb-3">Complete your look with our accessories.</p>
                                    <span
                                        class="inline-block bg-emerald-500 text-white px-3 py-1 rounded-full text-sm font-medium">$19.99</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Category 2: Best Sellers -->
                <div class="swiper-slide">
                    <div class="p-6">
                        <h4 class="text-2xl font-bold text-gray-900 mb-6">Best Sellers</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-white rounded-lg shadow-md overflow-hidden card-hover cursor-pointer">
                                <img src="https://images.unsplash.com/photo-1429932390-5c0e7267e0b2?w=300&h=200&fit=crop"
                                    class="w-full h-48 object-cover" alt="Best Seller 1" loading="lazy">
                                <div class="p-4">
                                    <h5 class="text-lg font-semibold text-gray-900 mb-2">Premium Denim</h5>
                                    <p class="text-gray-600 text-sm mb-3">High-quality jeans for every occasion.</p>
                                    <span
                                        class="inline-block bg-emerald-500 text-white px-3 py-1 rounded-full text-sm font-medium">$59.99</span>
                                </div>
                            </div>

                            <div class="bg-white rounded-lg shadow-md overflow-hidden card-hover cursor-pointer">
                                <img src="https://images.unsplash.com/photo-1516762689617-e1cffcef479d?w=300&h=200&fit=crop"
                                    class="w-full h-48 object-cover" alt="Best Seller 2" loading="lazy">
                                <div class="p-4">
                                    <h5 class="text-lg font-semibold text-gray-900 mb-2">Designer Shoes</h5>
                                    <p class="text-gray-600 text-sm mb-3">Step out in style with our shoe collection.
                                    </p>
                                    <span
                                        class="inline-block bg-emerald-500 text-white px-3 py-1 rounded-full text-sm font-medium">$89.99</span>
                                </div>
                            </div>

                            <div class="bg-white rounded-lg shadow-md overflow-hidden card-hover cursor-pointer">
                                <img src="https://images.unsplash.com/photo-1567401893414-76b7b1e5a7a5?w=300&h=200&fit=crop"
                                    class="w-full h-48 object-cover" alt="Best Seller 3" loading="lazy">
                                <div class="p-4">
                                    <h5 class="text-lg font-semibold text-gray-900 mb-2">Winter Coats</h5>
                                    <p class="text-gray-600 text-sm mb-3">Stay warm and stylish this winter.</p>
                                    <span
                                        class="inline-block bg-emerald-500 text-white px-3 py-1 rounded-full text-sm font-medium">$129.99</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Category 3: Sale Items -->
                <div class="swiper-slide">
                    <div class="p-6">
                        <h4 class="text-2xl font-bold text-gray-900 mb-6">Sale Items</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-white rounded-lg shadow-md overflow-hidden card-hover cursor-pointer">
                                <img src="https://images.unsplash.com/photo-1558769132-cb1aea458c5e?w=300&h=200&fit=crop"
                                    class="w-full h-48 object-cover" alt="Sale Item 1" loading="lazy">
                                <div class="p-4">
                                    <h5 class="text-lg font-semibold text-gray-900 mb-2">Basic Tees</h5>
                                    <p class="text-gray-600 text-sm mb-3">Essential t-shirts at unbeatable prices.</p>
                                    <div class="flex items-center gap-2">
                                        <span
                                            class="inline-block bg-red-500 text-white px-3 py-1 rounded-full text-sm font-medium line-through">$24.99</span>
                                        <span
                                            class="inline-block bg-emerald-500 text-white px-3 py-1 rounded-full text-sm font-medium">$14.99</span>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white rounded-lg shadow-md overflow-hidden card-hover cursor-pointer">
                                <img src="https://images.unsplash.com/photo-1515372039744-b8f02a3ae446?w=300&h=200&fit=crop"
                                    class="w-full h-48 object-cover" alt="Sale Item 2" loading="lazy">
                                <div class="p-4">
                                    <h5 class="text-lg font-semibold text-gray-900 mb-2">Summer Dresses</h5>
                                    <p class="text-gray-600 text-sm mb-3">Light and breezy dresses for summer.</p>
                                    <div class="flex items-center gap-2">
                                        <span
                                            class="inline-block bg-red-500 text-white px-3 py-1 rounded-full text-sm font-medium line-through">$49.99</span>
                                        <span
                                            class="inline-block bg-emerald-500 text-white px-3 py-1 rounded-full text-sm font-medium">$29.99</span>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white rounded-lg shadow-md overflow-hidden card-hover cursor-pointer">
                                <img src="https://images.unsplash.com/photo-1506629905607-45dc0ac2d17b?w=300&h=200&fit=crop"
                                    class="w-full h-48 object-cover" alt="Sale Item 3" loading="lazy">
                                <div class="p-4">
                                    <h5 class="text-lg font-semibold text-gray-900 mb-2">Sneakers</h5>
                                    <p class="text-gray-600 text-sm mb-3">Comfortable sneakers for active lifestyle.</p>
                                    <div class="flex items-center gap-2">
                                        <span
                                            class="inline-block bg-red-500 text-white px-3 py-1 rounded-full text-sm font-medium line-through">$79.99</span>
                                        <span
                                            class="inline-block bg-emerald-500 text-white px-3 py-1 rounded-full text-sm font-medium">$49.99</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <!-- Category 1: New Arrivals -->
                <div class="swiper-slide">
                    <div class="p-6">
                        <h4 class="text-2xl font-bold text-gray-900 mb-6">New Arrivals</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <a href="./product.php"
                                class="bg-white rounded-lg shadow-md overflow-hidden card-hover cursor-pointer">
                                <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=300&h=200&fit=crop"
                                    class="w-full h-48 object-cover" alt="Fashion Item 1" loading="lazy">
                                <div class="p-4">
                                    <h5 class="text-lg font-semibold text-gray-900 mb-2">Summer Collection</h5>
                                    <p class="text-gray-600 text-sm mb-3">Discover the latest trends for this season.
                                    </p>
                                    <span
                                        class="inline-block bg-emerald-500 text-white px-3 py-1 rounded-full text-sm font-medium">$29.99</span>
                                </div>
                            </a>

                            <div class="bg-white rounded-lg shadow-md overflow-hidden card-hover cursor-pointer">
                                <img src="https://images.unsplash.com/photo-1445205170230-053b83016050?w=300&h=200&fit=crop"
                                    class="w-full h-48 object-cover" alt="Fashion Item 2" loading="lazy">
                                <div class="p-4">
                                    <h5 class="text-lg font-semibold text-gray-900 mb-2">Casual Wear</h5>
                                    <p class="text-gray-600 text-sm mb-3">Comfortable styles for everyday wear.</p>
                                    <span
                                        class="inline-block bg-emerald-500 text-white px-3 py-1 rounded-full text-sm font-medium">$39.99</span>
                                </div>
                            </div>

                            <div class="bg-white rounded-lg shadow-md overflow-hidden card-hover cursor-pointer">
                                <img src="https://images.unsplash.com/photo-1434389677669-e08b4cac3105?w=300&h=200&fit=crop"
                                    class="w-full h-48 object-cover" alt="Fashion Item 3" loading="lazy">
                                <div class="p-4">
                                    <h5 class="text-lg font-semibold text-gray-900 mb-2">Accessories</h5>
                                    <p class="text-gray-600 text-sm mb-3">Complete your look with our accessories.</p>
                                    <span
                                        class="inline-block bg-emerald-500 text-white px-3 py-1 rounded-full text-sm font-medium">$19.99</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Category 2: Best Sellers -->
                <div class="swiper-slide">
                    <div class="p-6">
                        <h4 class="text-2xl font-bold text-gray-900 mb-6">Best Sellers</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-white rounded-lg shadow-md overflow-hidden card-hover cursor-pointer">
                                <img src="https://images.unsplash.com/photo-1429932390-5c0e7267e0b2?w=300&h=200&fit=crop"
                                    class="w-full h-48 object-cover" alt="Best Seller 1" loading="lazy">
                                <div class="p-4">
                                    <h5 class="text-lg font-semibold text-gray-900 mb-2">Premium Denim</h5>
                                    <p class="text-gray-600 text-sm mb-3">High-quality jeans for every occasion.</p>
                                    <span
                                        class="inline-block bg-emerald-500 text-white px-3 py-1 rounded-full text-sm font-medium">$59.99</span>
                                </div>
                            </div>

                            <div class="bg-white rounded-lg shadow-md overflow-hidden card-hover cursor-pointer">
                                <img src="https://images.unsplash.com/photo-1516762689617-e1cffcef479d?w=300&h=200&fit=crop"
                                    class="w-full h-48 object-cover" alt="Best Seller 2" loading="lazy">
                                <div class="p-4">
                                    <h5 class="text-lg font-semibold text-gray-900 mb-2">Designer Shoes</h5>
                                    <p class="text-gray-600 text-sm mb-3">Step out in style with our shoe collection.
                                    </p>
                                    <span
                                        class="inline-block bg-emerald-500 text-white px-3 py-1 rounded-full text-sm font-medium">$89.99</span>
                                </div>
                            </div>

                            <div class="bg-white rounded-lg shadow-md overflow-hidden card-hover cursor-pointer">
                                <img src="https://images.unsplash.com/photo-1567401893414-76b7b1e5a7a5?w=300&h=200&fit=crop"
                                    class="w-full h-48 object-cover" alt="Best Seller 3" loading="lazy">
                                <div class="p-4">
                                    <h5 class="text-lg font-semibold text-gray-900 mb-2">Winter Coats</h5>
                                    <p class="text-gray-600 text-sm mb-3">Stay warm and stylish this winter.</p>
                                    <span
                                        class="inline-block bg-emerald-500 text-white px-3 py-1 rounded-full text-sm font-medium">$129.99</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Category 3: Sale Items -->
                <div class="swiper-slide">
                    <div class="p-6">
                        <h4 class="text-2xl font-bold text-gray-900 mb-6">Sale Items</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-white rounded-lg shadow-md overflow-hidden card-hover cursor-pointer">
                                <img src="https://images.unsplash.com/photo-1558769132-cb1aea458c5e?w=300&h=200&fit=crop"
                                    class="w-full h-48 object-cover" alt="Sale Item 1" loading="lazy">
                                <div class="p-4">
                                    <h5 class="text-lg font-semibold text-gray-900 mb-2">Basic Tees</h5>
                                    <p class="text-gray-600 text-sm mb-3">Essential t-shirts at unbeatable prices.</p>
                                    <div class="flex items-center gap-2">
                                        <span
                                            class="inline-block bg-red-500 text-white px-3 py-1 rounded-full text-sm font-medium line-through">$24.99</span>
                                        <span
                                            class="inline-block bg-emerald-500 text-white px-3 py-1 rounded-full text-sm font-medium">$14.99</span>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white rounded-lg shadow-md overflow-hidden card-hover cursor-pointer">
                                <img src="https://images.unsplash.com/photo-1515372039744-b8f02a3ae446?w=300&h=200&fit=crop"
                                    class="w-full h-48 object-cover" alt="Sale Item 2" loading="lazy">
                                <div class="p-4">
                                    <h5 class="text-lg font-semibold text-gray-900 mb-2">Summer Dresses</h5>
                                    <p class="text-gray-600 text-sm mb-3">Light and breezy dresses for summer.</p>
                                    <div class="flex items-center gap-2">
                                        <span
                                            class="inline-block bg-red-500 text-white px-3 py-1 rounded-full text-sm font-medium line-through">$49.99</span>
                                        <span
                                            class="inline-block bg-emerald-500 text-white px-3 py-1 rounded-full text-sm font-medium">$29.99</span>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white rounded-lg shadow-md overflow-hidden card-hover cursor-pointer">
                                <img src="https://images.unsplash.com/photo-1506629905607-45dc0ac2d17b?w=300&h=200&fit=crop"
                                    class="w-full h-48 object-cover" alt="Sale Item 3" loading="lazy">
                                <div class="p-4">
                                    <h5 class="text-lg font-semibold text-gray-900 mb-2">Sneakers</h5>
                                    <p class="text-gray-600 text-sm mb-3">Comfortable sneakers for active lifestyle.</p>
                                    <div class="flex items-center gap-2">
                                        <span
                                            class="inline-block bg-red-500 text-white px-3 py-1 rounded-full text-sm font-medium line-through">$79.99</span>
                                        <span
                                            class="inline-block bg-emerald-500 text-white px-3 py-1 rounded-full text-sm font-medium">$49.99</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <!-- Category 1: New Arrivals -->
                <div class="swiper-slide">
                    <div class="p-6">
                        <h4 class="text-2xl font-bold text-gray-900 mb-6">New Arrivals</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <a href="./product.php"
                                class="bg-white rounded-lg shadow-md overflow-hidden card-hover cursor-pointer">
                                <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=300&h=200&fit=crop"
                                    class="w-full h-48 object-cover" alt="Fashion Item 1" loading="lazy">
                                <div class="p-4">
                                    <h5 class="text-lg font-semibold text-gray-900 mb-2">Summer Collection</h5>
                                    <p class="text-gray-600 text-sm mb-3">Discover the latest trends for this season.
                                    </p>
                                    <span
                                        class="inline-block bg-emerald-500 text-white px-3 py-1 rounded-full text-sm font-medium">$29.99</span>
                                </div>
                            </a>

                            <div class="bg-white rounded-lg shadow-md overflow-hidden card-hover cursor-pointer">
                                <img src="https://images.unsplash.com/photo-1445205170230-053b83016050?w=300&h=200&fit=crop"
                                    class="w-full h-48 object-cover" alt="Fashion Item 2" loading="lazy">
                                <div class="p-4">
                                    <h5 class="text-lg font-semibold text-gray-900 mb-2">Casual Wear</h5>
                                    <p class="text-gray-600 text-sm mb-3">Comfortable styles for everyday wear.</p>
                                    <span
                                        class="inline-block bg-emerald-500 text-white px-3 py-1 rounded-full text-sm font-medium">$39.99</span>
                                </div>
                            </div>

                            <div class="bg-white rounded-lg shadow-md overflow-hidden card-hover cursor-pointer">
                                <img src="https://images.unsplash.com/photo-1434389677669-e08b4cac3105?w=300&h=200&fit=crop"
                                    class="w-full h-48 object-cover" alt="Fashion Item 3" loading="lazy">
                                <div class="p-4">
                                    <h5 class="text-lg font-semibold text-gray-900 mb-2">Accessories</h5>
                                    <p class="text-gray-600 text-sm mb-3">Complete your look with our accessories.</p>
                                    <span
                                        class="inline-block bg-emerald-500 text-white px-3 py-1 rounded-full text-sm font-medium">$19.99</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Category 2: Best Sellers -->
                <div class="swiper-slide">
                    <div class="p-6">
                        <h4 class="text-2xl font-bold text-gray-900 mb-6">Best Sellers</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-white rounded-lg shadow-md overflow-hidden card-hover cursor-pointer">
                                <img src="https://images.unsplash.com/photo-1429932390-5c0e7267e0b2?w=300&h=200&fit=crop"
                                    class="w-full h-48 object-cover" alt="Best Seller 1" loading="lazy">
                                <div class="p-4">
                                    <h5 class="text-lg font-semibold text-gray-900 mb-2">Premium Denim</h5>
                                    <p class="text-gray-600 text-sm mb-3">High-quality jeans for every occasion.</p>
                                    <span
                                        class="inline-block bg-emerald-500 text-white px-3 py-1 rounded-full text-sm font-medium">$59.99</span>
                                </div>
                            </div>

                            <div class="bg-white rounded-lg shadow-md overflow-hidden card-hover cursor-pointer">
                                <img src="https://images.unsplash.com/photo-1516762689617-e1cffcef479d?w=300&h=200&fit=crop"
                                    class="w-full h-48 object-cover" alt="Best Seller 2" loading="lazy">
                                <div class="p-4">
                                    <h5 class="text-lg font-semibold text-gray-900 mb-2">Designer Shoes</h5>
                                    <p class="text-gray-600 text-sm mb-3">Step out in style with our shoe collection.
                                    </p>
                                    <span
                                        class="inline-block bg-emerald-500 text-white px-3 py-1 rounded-full text-sm font-medium">$89.99</span>
                                </div>
                            </div>

                            <div class="bg-white rounded-lg shadow-md overflow-hidden card-hover cursor-pointer">
                                <img src="https://images.unsplash.com/photo-1567401893414-76b7b1e5a7a5?w=300&h=200&fit=crop"
                                    class="w-full h-48 object-cover" alt="Best Seller 3" loading="lazy">
                                <div class="p-4">
                                    <h5 class="text-lg font-semibold text-gray-900 mb-2">Winter Coats</h5>
                                    <p class="text-gray-600 text-sm mb-3">Stay warm and stylish this winter.</p>
                                    <span
                                        class="inline-block bg-emerald-500 text-white px-3 py-1 rounded-full text-sm font-medium">$129.99</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Category 3: Sale Items -->
                <div class="swiper-slide">
                    <div class="p-6">
                        <h4 class="text-2xl font-bold text-gray-900 mb-6">Sale Items</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-white rounded-lg shadow-md overflow-hidden card-hover cursor-pointer">
                                <img src="https://images.unsplash.com/photo-1558769132-cb1aea458c5e?w=300&h=200&fit=crop"
                                    class="w-full h-48 object-cover" alt="Sale Item 1" loading="lazy">
                                <div class="p-4">
                                    <h5 class="text-lg font-semibold text-gray-900 mb-2">Basic Tees</h5>
                                    <p class="text-gray-600 text-sm mb-3">Essential t-shirts at unbeatable prices.</p>
                                    <div class="flex items-center gap-2">
                                        <span
                                            class="inline-block bg-red-500 text-white px-3 py-1 rounded-full text-sm font-medium line-through">$24.99</span>
                                        <span
                                            class="inline-block bg-emerald-500 text-white px-3 py-1 rounded-full text-sm font-medium">$14.99</span>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white rounded-lg shadow-md overflow-hidden card-hover cursor-pointer">
                                <img src="https://images.unsplash.com/photo-1515372039744-b8f02a3ae446?w=300&h=200&fit=crop"
                                    class="w-full h-48 object-cover" alt="Sale Item 2" loading="lazy">
                                <div class="p-4">
                                    <h5 class="text-lg font-semibold text-gray-900 mb-2">Summer Dresses</h5>
                                    <p class="text-gray-600 text-sm mb-3">Light and breezy dresses for summer.</p>
                                    <div class="flex items-center gap-2">
                                        <span
                                            class="inline-block bg-red-500 text-white px-3 py-1 rounded-full text-sm font-medium line-through">$49.99</span>
                                        <span
                                            class="inline-block bg-emerald-500 text-white px-3 py-1 rounded-full text-sm font-medium">$29.99</span>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white rounded-lg shadow-md overflow-hidden card-hover cursor-pointer">
                                <img src="https://images.unsplash.com/photo-1506629905607-45dc0ac2d17b?w=300&h=200&fit=crop"
                                    class="w-full h-48 object-cover" alt="Sale Item 3" loading="lazy">
                                <div class="p-4">
                                    <h5 class="text-lg font-semibold text-gray-900 mb-2">Sneakers</h5>
                                    <p class="text-gray-600 text-sm mb-3">Comfortable sneakers for active lifestyle.</p>
                                    <div class="flex items-center gap-2">
                                        <span
                                            class="inline-block bg-red-500 text-white px-3 py-1 rounded-full text-sm font-medium line-through">$79.99</span>
                                        <span
                                            class="inline-block bg-emerald-500 text-white px-3 py-1 rounded-full text-sm font-medium">$49.99</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <footer>
    </footer>
    <?php include('../include/footer.php') ?>
    </footer>

    <!-- Swiper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js"></script>

    <script src="../controllers/conIndex.js"></script>
</body>

</html>