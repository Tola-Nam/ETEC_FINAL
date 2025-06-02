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

    <!-- Header -->
    <?php require_once('../include/header.php') ?>
    <!-- Main Product Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Product Images -->
            <div class="space-y-4">
                <?php
                require_once('../models/connection.php');
                $connection = connection();
                $code = $_GET['code'];
                if (isset($code)) {
                    $getProduct = " SELECT product_thumbnail FROM goods where product_code = '$code';";
                    $items = $connection->query($getProduct);
                    if ($row = mysqli_fetch_assoc($items)) {
                        echo '<div class="aspect-square bg-gray-100 rounded-lg overflow-hidden">
                        <img id="mainImage"
                        src="http://localhost/ETEC_FINAL/servers/assets/images/' . $row['product_thumbnail'] . '"
                        alt="Main product image" class="w-full h-full object-cover" />
                        </div>';
                    }
                } else {
                    echo '<script>alert("Product is not found!!!");</script>';
                }
                ?>
                <div class="grid grid-cols-4 gap-4">
                    <?php
                    require_once('../models/connection.php');
                    $connection = connection();

                    // Check and sanitize 'status' from GET
                    $status = isset($_GET['status']) ? mysqli_real_escape_string($connection, $_GET['status']) : '';

                    if ($status) {
                        // Corrected query: replace 'your_table_name' with actual table name
                        $QueryProduct = "SELECT product_thumbnail FROM goods WHERE category = '$status' LIMIT 4";
                        $routerProduct = $connection->query($QueryProduct);

                        while ($row = mysqli_fetch_assoc($routerProduct)) {
                            $thumbnail = htmlspecialchars($row['product_thumbnail']);
                            $imagePath = "http://localhost/ETEC_FINAL/servers/assets/images/" . $thumbnail;

                            echo '<button onclick="changeImage(\'' . $imagePath . '\')"
                                    class="aspect-square bg-gray-100 rounded-lg overflow-hidden border-2 border-gray-900">
                                    <img src="' . $imagePath . '?' . $code . '"
                                        alt="Product view" class="w-full h-full object-cover" />
                                </button>';
                        }
                    }
                    ?>
                </div>
            </div>

            <!-- Product Info -->
            <div class="space-y-6">
                <?php
                require_once('../models/connection.php');
                $connection = connection();
                $code = $_GET['code'];
                if ($code) {

                    $getinfo = " SELECT product_title,product_price,discount FROM goods where product_code='$code'";
                    $QueryInfo = $connection->query($getinfo);
                    if ($row = mysqli_fetch_assoc($QueryInfo)) {
                        ?>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">
                                <?php echo $row['product_title'] ?>
                            </h1>
                            <!-- <p class="text-xl text-gray-600 mt-2">Essential wardrobe staple</p> -->
                        </div>
                        <div class="flex items-center space-x-4">
                            <span id="productDiscount"
                                class="bg-green-100 text-green-800 px-2 py-1 text-sm font-semibold rounded">$</span>
                            <span id="productPrice"
                                class="bg-yellow-100 text-yellow-800 line-through px-2 py-1 text-sm font-semibold rounded">$<?php echo $row['product_price'] ?></span>
                            <span id="percentDiscount"
                                class="bg-red-100 text-red-800 px-2 py-1 text-sm font-semibold rounded"><?php echo $row['discount'] ?>%
                                OFF</span>
                        </div>
                        <?php
                    }
                } else {
                    echo '<script>alert("product is not found in system!!!");</script>';
                }

                ?>
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
                    <button onclick="addToCart(event)"
                        class="w-full bg-gray-900 text-white py-3 px-6 rounded-lg font-semibold transition-colors">
                        Add to Cart
                    </button>
                </div>

                <!-- Product Details -->
                <div class="border-t pt-6">
                    <div class="space-y-4">
                        <?php
                        require_once('../models/connection.php');
                        $connection = connection();
                        $code = $_GET['code'];

                        $getDetail = " SELECT product_description FROM goods WHERE product_code = '$code'";
                        $QueryProduct = $connection->query($getDetail);
                        if ($code) {
                            if ($result = mysqli_fetch_assoc($QueryProduct)) {
                                ?>
                                <details class="group">
                                    <summary
                                        class="flex justify-between items-center cursor-pointer font-semibold text-gray-900 hover:bg-gray-600">
                                        Product Details
                                        <span class="group-open:rotate-180 transition-transform">↓</span>
                                    </summary>
                                    <div class="mt-4 text-gray-600 space-y-2">
                                        <p class="hover:bg-gray-400 rounded"> Code <?php echo $code ?></p>
                                        <p class="hover:bg-gray-400 rounded"><?php echo $result['product_description'] ?></p>
                                    </div>
                                </details>
                            <?php }
                        } ?>
                        <details class="group">
                            <summary
                                class="flex justify-between items-center cursor-pointer font-semibold text-gray-900 hover:bg-gray-600">
                                Size & Fit
                                <span class="group-open:rotate-180 transition-transform">↓</span>
                            </summary>
                            <div class="mt-4 text-gray-600">
                                <p class="hover:bg-gray-400 rounded">Regular fit through body and sleeves</p>
                                <p id="sizeProduct" class="hover:bg-gray-400 rounded"></p>
                            </div>
                        </details>
                        <button onclick="openSizeGuide()"
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
        <div class="overflow-x-auto">
            <div class="flex space-x-4 min-w-max">
                <?php
                require_once('../models/connection.php');
                $connection = connection();
                $code = $_GET['code'] ?? '';
                $status = $_GET['status'] ?? '';

                $selectedCategory = "SELECT product_code, product_title, product_price, product_thumbnail, category FROM goods ORDER BY sale_count DESC";

                if ($Query = $connection->query($selectedCategory)) {
                    while ($row = mysqli_fetch_assoc($Query)) {
                        if (!empty($status)) {
                            if (
                                ($status == "fashion" && $row['category'] === 'fashion') ||
                                ($status == "NewFashion" && $row['category'] === 'NewFashion') ||
                                ($status == "Electronics" && $row['category'] === 'Electronics') ||
                                ($status == "SkinCare" && $row['category'] === 'SkinCare') ||
                                ($status == "Shoes" && $row['category'] === 'Shoes')
                            ) {
                                echo '<a href="./product.php?code=' . urlencode($row['product_code']) . '&status=' . $status . '" 
                                        class="w-full max-w-sm bg-white rounded-lg shadow overflow-hidden flex flex-col" style="height: 400px;">
                                        <!-- Image Section -->
                                        <div class="relative w-full h-[300px] bg-gray-100">
                                            <img src="http://localhost/ETEC_FINAL/servers/assets/images/' . htmlspecialchars($row['product_thumbnail']) . '"
                                                alt="' . htmlspecialchars($row['product_title']) . '"
                                                class="w-full h-full object-cover transition-transform duration-300 hover:scale-105" />
                                        </div>
                                        <!-- Text Content -->
                                        <div class="px-4 py-2">
                                            <p class="text-green-800 text-base font-semibold mb-1">
                                                $' . number_format($row['product_price'], 2) . '
                                            </p>
                                            <h3 class="text-gray-900 text-base font-semibold leading-snug break-words line-clamp-2">
                                                ' . htmlspecialchars($row['product_title']) . '
                                            </h3>
                                        </div>
                                    </a>';
                            }
                        }
                    }
                } else {
                    echo '<script>alert("not found in system!!!")</script>';
                }
                ?>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <?php require_once('../include/footer.php') ?>
    <script>
        // function for discount product
        const productPrice = parseFloat(
            document.getElementById("productPrice").innerText.replace("$", ""));
        const percentDiscount = parseFloat(
            document.getElementById("percentDiscount").innerText.replace("% OFF", ""));

        if (!isNaN(productPrice) && !isNaN(percentDiscount)) {
            const Discount = productPrice - (productPrice * percentDiscount) / 100;
            document.getElementById("productDiscount").innerText = `$${Discount.toFixed(2)}`;
        }

        const selectedText = document.getElementById('selectedSize').textContent.trim();
        const size = selectedText.split(':')[1].trim();
        if (size == 'M' || size == 'XS' || size == 'S' || size == 'L' || size == 'XL' || size == 'XXL') {
            document.getElementById('sizeProduct').textContent = `Model is 6'2" and wears size ${size}`;
        }
    </script>

    <script src="../controllers/productRoute.js"></script>

    <!-- modal openSizeGuide -->
    <div id="sizeGuide"
        class="fixed inset-0 z-100 w-100 hidden flex items-center justify-center bg-black bg-opacity-50">
        <!-- Modal Dialog -->
        <div class="bg-white rounded-lg  w-[90%] max-w-[700px]  shadow-lg max-w-md p-6 relative">
            <button onclick="closeSizeGuide()" id="close"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
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
                <button type="button" onclick="closeSizeGuide()"
                    class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 flex items-center">
                    <i class="bi bi-x-circle me-2"></i> Cancel
                </button>
            </div>
        </div>
    </div>
    <!-- Modal Backdrop -->
    <div id="ModalCheckOut"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-end z-50 hidden min-h-screen ">

        <!-- Modal Container -->
        <div class="bg-white rounded-lg  w-[90%] max-w-[700px]  shadow-lg max-w-md p-6 relative">

            <!-- Close Button -->
            <button onclick="CloseModal(event)" id="close" type="button"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 z-10">
                <i class="bi bi-x-circle-fill text-2xl"></i>
            </button>
            <!-- Product Section -->
            <div class="p-6">
                <div class="flex gap-4 mb-6">
                    <!-- Product Image -->
                    <div class="w-20 h-28 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <div class="w-14 h-20 bg-black rounded"></div>
                    </div>

                    <!-- Product Details -->
                    <div class="flex-1">
                        <div class="flex justify-between items-start mb-2">
                            <h2 class="text-lg font-medium text-gray-900 pr-2">
                                Relaxed Fit Cargo Trouser
                            </h2>
                            <button class="p-1 text-gray-400 hover:text-gray-600">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>

                        <p class="text-sm text-gray-600 mb-3">Code. 4122406209 - Black</p>

                        <!-- Size and Quantity Selection -->
                        <div class="grid grid-cols-2 gap-3 mb-3">
                            <div>
                                <label class="block text-sm text-gray-600 mb-1">Size</label>
                                <select
                                    class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-black focus:border-black">
                                    <option>M</option>
                                    <option>S</option>
                                    <option>L</option>
                                    <option>XL</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-600 mb-1">Quantity</label>
                                <select
                                    class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-black focus:border-black">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                </select>
                            </div>
                        </div>

                        <!-- Stock Status -->
                        <div class="text-right mb-3">
                            <p class="text-sm text-red-500 font-medium">2 Left in stock</p>
                        </div>

                        <!-- Pricing -->
                        <div class="text-right space-y-1">
                            <p class="text-sm text-gray-500 line-through">US $27.95</p>
                            <p class="text-sm text-gray-600">(40% off) -US $11.18</p>
                            <p class="text-lg font-semibold text-red-500">US $16.77</p>
                        </div>
                    </div>
                </div>

                <!-- Move to Wishlist Button -->
                <button
                    class="flex items-center gap-2 text-sm text-gray-600 hover:text-gray-800 transition-colors mb-6">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    Move to wishlist
                </button>
            </div>

            <!-- Order Summary -->
            <div class="border-t bg-gray-50 p-6">
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-900 font-medium">Total</span>
                        <span class="text-gray-900 font-medium">US $27.95</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Save</span>
                        <span class="text-green-600 font-medium">-US $11.18</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Delivery fee</span>
                        <span class="text-gray-900">US $1.25</span>
                    </div>
                    <hr class="border-gray-300" />
                    <div class="flex justify-between items-center pt-2">
                        <span class="text-lg font-semibold text-gray-900">Amount to pay</span>
                        <span class="text-lg font-semibold text-gray-900">US $18.02</span>
                    </div>
                </div>

                <!-- Checkout Button -->
                <button
                    class="w-full bg-black text-white py-4 rounded-lg font-medium text-lg hover:bg-gray-800 transition-colors duration-200 focus:outline-none focus:ring-4 focus:ring-gray-300">
                    Proceed to Checkout
                </button>
            </div>
        </div>
    </div>
    <script src="../controllers/productModal.js"></script>