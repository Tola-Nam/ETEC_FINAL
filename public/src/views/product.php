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
                        class="w-full bg-gray-900 text-white py-3 px-6 rounded-lg font-semibold transition-colors">
                        Add to Cart
                    </button>
                    <!-- <button
                        class="w-full border border-gray-300 text-gray-900 py-3 px-6 rounded-lg font-semibold hover:border-gray-900 transition-colors">
                        Add to Wishlist
                    </button> -->
                </div>

                <!-- Product Details -->
                <div class="border-t pt-6">
                    <div class="space-y-4">
                        <details class="group">
                            <summary
                                class="flex justify-between items-center cursor-pointer font-semibold text-gray-900 hover:bg-gray-700">
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
                                class="flex justify-between items-center cursor-pointer font-semibold text-gray-900 hover:bg-gray-700">
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
                                class="flex justify-between items-center cursor-pointer font-semibold text-gray-900 hover:bg-gray-700">
                                Care Instructions
                                <span class="group-open:rotate-180 transition-transform">↓</span>
                            </summary>
                            <div class="mt-4 text-gray-600">
                                <p>Machine wash cold with like colors</p>
                                <p>Tumble dry low</p>
                                <p>Do not bleach</p>
                            </div>
                        </details>
                        <button onclick="openModal()"
                            class="flex justify-between items-center w-100 cursor-pointer font-semibold text-gray-900 hover:bg-gray-700">
                            size guide
                            <span class="group-open:rotate-180 transition-transform">↓</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- You May Also Like -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php
            require_once('../models/connection.php');
            $connection = connection();

            $code = $_GET['code'] ?? '';
            $status = $_GET['status'] ?? '';

            $selectedCategory = "SELECT product_code, product_title, product_price, product_thumbnail, category FROM goods";

            if ($Query = $connection->query($selectedCategory)) {
                while ($row = mysqli_fetch_assoc($Query)) {
                    if (!empty($status)) {
                        if (
                            ($status == "fashion" && $row['category'] === 'fashion') ||
                            ($status == "NewFashion" && $row['category'] === 'NewFashion') ||
                            ($status == "Electronics" && $row['category'] === 'Electronics') ||
                            ($status == "SkinCare" && $row['category'] === 'SkinCare')
                        ) {
                            echo '<a href="./product.php?code=' . urlencode($row['product_code']) . '&status=fashion$status=NewFashion$status=Electronics&status=SkinCare" class="group">
                                    <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden mb-4">
                                        <img src="http://localhost/ETEC_FINAL/servers/assets/images/' . htmlspecialchars($row['product_thumbnail']) . '"
                                            alt="Related product"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform" />
                                    </div>
                                    <h3 class="font-semibold text-gray-900">' . htmlspecialchars($row['product_title']) . '</h3>
                                    <p class="text-gray-600">$' . number_format($row['product_price'], 2) . '</p>
                                </a>';
                        }
                    }
                }
            } else {
                echo '<script>alert("not found in system!!!")</script>';
            }
            ?>
        </div>
    </section>
    <!-- Footer -->
    <?php require_once('../include/footer.php') ?>

    <script src="../controllers/productRoute.js"></script>

    <!-- modal -->
    <div id="sizeGuide"
        class="fixed inset-0 z-100 w-100 hidden flex items-center justify-center bg-black bg-opacity-50">
        <!-- Modal Dialog -->
        <div class="bg-white rounded-lg  w-[90%] max-w-[700px]  shadow-lg w-full max-w-md p-6 relative">
            <button onclick="closeModal()" id="close" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                <i class="bi bi-x-circle-fill text-2xl"></i>
            </button>
            <div class="max-w-6xl mx-auto bg-white rounded-lg shadow-lg">
                <!-- Header Section -->
                <div class="bg-white p-6 border-b border-gray-200 rounded-t-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold text-gray-800">
                            Enter your height and weight
                        </h2>
                    </div>

                    <div class="flex flex-wrap gap-4 items-end">
                        <div class="flex-1 min-w-32">
                            <label class="block text-sm font-medium text-gray-600 mb-2">Height (cm)</label>
                            <input type="number" id="height-input" placeholder="only 175" min="140" max="180"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                        </div>
                        <div class="flex-1 min-w-32">
                            <label class="block text-sm font-medium text-gray-600 mb-2">Weight (kg)</label>
                            <input type="number" id="weight-input" placeholder=" only 75" min="35" max="80"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                        </div>
                        <button onclick="highlightSize()"
                            class="bg-gray-900 text-white px-8 py-2 rounded-md hover:bg-gray-800 transition-colors font-medium">
                            Apply
                        </button>
                    </div>

                    <!-- Result Display -->
                    <div id="result-display" class="mt-4 p-3 bg-gray-100 rounded-md hidden">
                        <p class="text-sm font-medium text-gray-700">
                            <span class="text-blue-600">Your recommended size:</span>
                            <span id="size-result" class="font-bold text-lg"></span>
                        </p>
                    </div>
                </div>

                <!-- Chart Section -->
                <div class="p-6">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Height</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <!-- Header Row with Weight Values -->
                            <thead>
                                <tr>
                                    <th class="w-20 p-2 text-xs font-medium text-gray-600"></th>
                                    <th class="p-2 text-xs font-medium text-gray-600 border-l border-gray-200">40-42
                                    </th>
                                    <th class="p-2 text-xs font-medium text-gray-600 border-l border-gray-200">43-44
                                    </th>
                                    <th class="p-2 text-xs font-medium text-gray-600 border-l border-gray-200">45-47
                                    </th>
                                    <th class="p-2 text-xs font-medium text-gray-600 border-l border-gray-200">48-49
                                    </th>
                                    <th class="p-2 text-xs font-medium text-gray-600 border-l border-gray-200">50-52
                                    </th>
                                    <th class="p-2 text-xs font-medium text-gray-600 border-l border-gray-200">53-54
                                    </th>
                                    <th class="p-2 text-xs font-medium text-gray-600 border-l border-gray-200">55-57
                                    </th>
                                    <th class="p-2 text-xs font-medium text-gray-600 border-l border-gray-200">58-59
                                    </th>
                                    <th class="p-2 text-xs font-medium text-gray-600 border-l border-gray-200">60-62
                                    </th>
                                    <th class="p-2 text-xs font-medium text-gray-600 border-l border-gray-200">63-64
                                    </th>
                                    <th class="p-2 text-xs font-medium text-gray-600 border-l border-gray-200">65-67
                                    </th>
                                    <th class="p-2 text-xs font-medium text-gray-600 border-l border-gray-200">68-69
                                    </th>
                                    <th class="p-2 text-xs font-medium text-gray-600 border-l border-gray-200">70-75
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="size-chart-body">
                                <!-- Height rows -->
                                <tr class="border-t border-gray-200">
                                    <td class="p-2 text-xs font-medium text-gray-600 bg-gray-50">173-175</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200"></td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200"></td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200"></td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200"></td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200"></td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200"></td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">L</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">L</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">XL</td>
                                </tr>
                                <tr class="border-t border-gray-200">
                                    <td class="p-2 text-xs font-medium text-gray-600 bg-gray-50">170-172</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200"></td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200"></td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200"></td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">S</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">L</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">L</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">XL</td>
                                </tr>
                                <tr class="border-t border-gray-200">
                                    <td class="p-2 text-xs font-medium text-gray-600 bg-gray-50">168-169</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200"></td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200"></td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">S</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">S</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">L</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">L</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">XL</td>
                                </tr>
                                <tr class="border-t border-gray-200">
                                    <td class="p-2 text-xs font-medium text-gray-600 bg-gray-50">165-167</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200"></td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">S</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">S</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">S</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">S</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">L</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">L</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">L</td>
                                </tr>
                                <tr class="border-t border-gray-200">
                                    <td class="p-2 text-xs font-medium text-gray-600 bg-gray-50">163-164</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">XS</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">XS</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">S</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">S</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">S</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">S</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">S</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">L</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">L</td>
                                </tr>
                                <tr class="border-t border-gray-200">
                                    <td class="p-2 text-xs font-medium text-gray-600 bg-gray-50">161-162</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">XS</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">XS</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">XS</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">S</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">S</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">S</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">S</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">L</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">L</td>
                                </tr>
                                <tr class="border-t border-gray-200">
                                    <td class="p-2 text-xs font-medium text-gray-600 bg-gray-50">158-160</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">XS</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">XS</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">XS</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">S</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">S</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">S</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">S</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">S</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">L</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">L</td>
                                </tr>
                                <tr class="border-t border-gray-200">
                                    <td class="p-2 text-xs font-medium text-gray-600 bg-gray-50">155-157</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">XS</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">XS</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">XS</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">XS</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">S</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">S</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">S</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">S</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">L</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">L</td>
                                </tr>
                                <tr class="border-t border-gray-200">
                                    <td class="p-2 text-xs font-medium text-gray-600 bg-gray-50">153-154</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">XS</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">XS</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">XS</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">XS</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">S</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">S</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">S</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">S</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">L</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">L</td>
                                </tr>
                                <tr class="border-t border-gray-200">
                                    <td class="p-2 text-xs font-medium text-gray-600 bg-gray-50">149-152</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">XS</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">XS</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">XS</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">XS</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">S</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">S</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">S</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">S</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">S</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">M</td>
                                    <td class="p-2 text-center text-xs font-medium border-l border-gray-200">L</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6 text-right">
                        <span class="text-sm font-medium text-gray-800">Weight</span>
                    </div>
                </div>
            </div>
            <!-- Modal Footer -->
            <div class="flex justify-end gap-2 mt-3">
                <button type="button" onclick="closeModal()"
                    class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 flex items-center">
                    <i class="bi bi-x-circle me-2"></i> Cancel
                </button>
            </div>
        </div>
    </div>

    <script src="../controllers/productModal.js"></script>