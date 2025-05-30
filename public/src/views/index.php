<?php
require_once('../models/connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zalando - Fashion Store</title>

    <!-- Tailwind CSS -->
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

        #main-content {
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        #main-content.loaded {
            opacity: 1;
        }

        /* Enhanced horizontal scrolling for category rows */
        .category-row {
            display: flex;
            gap: 1.5rem;
            overflow-x: auto;
            overflow-y: hidden;
            padding-bottom: 1rem;
            padding-right: 1rem;
            scroll-behavior: smooth;

            /* Enable momentum scrolling on iOS */
            -webkit-overflow-scrolling: touch;

            /* Ensure proper scrolling on all devices */
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 #f1f5f9;
        }

        /* Custom scrollbar styling */
        .category-row::-webkit-scrollbar {
            height: 8px;
        }

        .category-row::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }

        .category-row::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        .category-row::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .product-card {
            min-width: 250px;
            max-width: 250px;
            flex-shrink: 0;
            flex-grow: 0;
        }

        /* Add some margin to the last card for better scrolling experience */
        .product-card:last-child {
            margin-right: 1rem;
        }

        /* Smooth scrolling for the entire page */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="bg-white font-sans ">
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
        <!-- Products Container (No Swiper) -->
        <div class="p-6">
            <?php
            $connection = connection();

            // Fetch all goods ordered by category
            $getter = "SELECT * FROM `goods` ORDER BY `category` DESC";
            $result = $connection->query($getter);

            if ($result && $result->num_rows > 0) {
                $currentCategory = '';
                $categoryProducts = [];

                //! Group products by category
                while ($row = mysqli_fetch_assoc($result)) {
                    $categoryProducts[$row['category']][] = $row;
                }
                //^ Display each category in a single row
                foreach ($categoryProducts as $category => $products) {
                    echo "<h4 class='text-2xl font-bold text-gray-900 mb-6 mt-8'>" . htmlspecialchars($category) . "</h4>";
                    echo "<div class='category-row'>";
                    foreach ($products as $product) {
                        // block fashion 
                        if ($product['category'] === 'fashion') {
                            echo '<a href="./product.php?code=' . urlencode($product['product_code']) . '&status=fashion" 
                                class="product-card bg-white rounded-lg shadow-md overflow-hidden card-hover cursor-pointer">
                                
                                <div class="w-full h-64 overflow-hidden">
                                    <img src="http://localhost/ETEC_FINAL/servers/assets/images/' . htmlspecialchars($product['product_thumbnail']) . '"
                                        class="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
                                        alt="' . htmlspecialchars($product['product_title']) . '"
                                        loading="lazy">
                                </div>

                                <div class="p-4">
                                    <h5 class="text-lg font-semibold text-gray-900 mb-2">' . htmlspecialchars($product['product_title']) . '</h5>
                                    <p class="text-gray-600 text-sm mb-3">' . htmlspecialchars($product['product_description']) . '</p>
                                    <span class="inline-block bg-emerald-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                    $' . number_format($product['product_price'], 2) . '
                                    </span>
                                </div>
                            </a>';
                        }
                        // block new fashion 
                        if ($product['category'] === 'NewFashion') {
                            echo '<a href="./product.php?code=' . urlencode($product['product_code']) . '&status=NewFashion" 
                                class="product-card bg-white rounded-lg shadow-md overflow-hidden card-hover cursor-pointer">
                                
                                <div class="w-full h-64 overflow-hidden">
                                    <img src="http://localhost/ETEC_FINAL/servers/assets/images/' . htmlspecialchars($product['product_thumbnail']) . '"
                                        class="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
                                        alt="' . htmlspecialchars($product['product_title']) . '"
                                        loading="lazy">
                                </div>

                                <div class="p-4">
                                    <h5 class="text-lg font-semibold text-gray-900 mb-2">' . htmlspecialchars($product['product_title']) . '</h5>
                                    <p class="text-gray-600 text-sm mb-3">' . htmlspecialchars($product['product_description']) . '</p>
                                    <span class="inline-block bg-emerald-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                    $' . number_format($product['product_price'], 2) . '
                                    </span>
                                </div>
                            </a>';
                        }
                        // block skink care
                        if ($product['category'] === 'SkinCare') {
                            echo '<a href="./product.php?code=' . urlencode($product['product_code']) . '&status=SkinCare" 
                                class="product-card bg-white rounded-lg shadow-md overflow-hidden card-hover cursor-pointer">
                                
                                <div class="w-full h-64 overflow-hidden">
                                    <img src="http://localhost/ETEC_FINAL/servers/assets/images/' . htmlspecialchars($product['product_thumbnail']) . '"
                                        class="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
                                        alt="' . htmlspecialchars($product['product_title']) . '"
                                        loading="lazy">
                                </div>

                                <div class="p-4">
                                    <h5 class="text-lg font-semibold text-gray-900 mb-2">' . htmlspecialchars($product['product_title']) . '</h5>
                                    <p class="text-gray-600 text-sm mb-3">' . htmlspecialchars($product['product_description']) . '</p>
                                    <span class="inline-block bg-emerald-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                    $' . number_format($product['product_price'], 2) . '
                                    </span>
                                </div>
                            </a>';
                        }
                        // block electronics
                        if ($product['category'] === 'Electronics') {
                            echo '<a href="./product.php?code=' . urlencode($product['product_code']) . '&status=Electronics" 
                                class="product-card bg-white rounded-lg shadow-md overflow-hidden card-hover cursor-pointer">
                                
                                <div class="w-full h-64 overflow-hidden">
                                    <img src="http://localhost/ETEC_FINAL/servers/assets/images/' . htmlspecialchars($product['product_thumbnail']) . '"
                                        class="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
                                        alt="' . htmlspecialchars($product['product_title']) . '"
                                        loading="lazy">
                                </div>

                                <div class="p-4">
                                    <h5 class="text-lg font-semibold text-gray-900 mb-2">' . htmlspecialchars($product['product_title']) . '</h5>
                                    <p class="text-gray-600 text-sm mb-3">' . htmlspecialchars($product['product_description']) . '</p>
                                    <span class="inline-block bg-emerald-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                    $' . number_format($product['product_price'], 2) . '
                                    </span>
                                </div>
                            </a>';
                        }

                    }

                    echo "</div>"; //! Close category-row
                }
            } else {
                echo "<p class='text-gray-600'>No products found or query failed.</p>";
            }
            ?>
        </div>
    </div>

    <!-- Simplified JavaScript (No Swiper) -->
    <script>
        // Simple loading screen functionality
        window.addEventListener('load', function () {
            const loadingScreen = document.getElementById('loading-screen');
            const mainContent = document.getElementById('main-content');

            // Hide loading screen and show main content
            setTimeout(() => {
                loadingScreen.style.display = 'none';
                mainContent.classList.add('loaded');
            }, 1000);
        });
    </script>
    <!-- <script src="../controllers/conIndex.js"></script> -->
    <?php include('../include/footer.php') ?>