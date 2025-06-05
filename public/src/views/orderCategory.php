<?php ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
</head>
<body>
    <!-- Main Content -->
    <div id="main-content" class="container mx-auto px-4 mt-4">
         <div class="p-6">
             <a href="./product.php?code=' . urlencode($product['product_code']) . '&status=fashion"
                class="product-card bg-white rounded-lg shadow-md overflow-hidden card-hover cursor-pointer">
                <div class="w-full h-64 overflow-hidden">
                     <img src="http://localhost/ETEC_FINAL/servers/assets/images/' . htmlspecialchars($product['product_thumbnail']) . '"
                         class="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
                         alt="' . htmlspecialchars($product['product_title']) . '"loading="lazy">
                </div>
                <div class="p-4">
                    <div class="flex items-center space-x-4">
                        <span class="productDiscount bg-green-100 text-green-800 px-2 py-1 text-sm font-semibold rounded">$</span>
                        <span id="productPrice"
                            class="bg-yellow-100 text-yellow-800 line-through px-2 py-1 text-sm font-semibold rounded">$' . $product['product_price'] . '</span>
                        <span id="percentDiscount"
                            class="bg-red-100 text-red-800 px-2 py-1 text-sm font-semibold rounded hidden">' . $product['discount'] . '%OFF</span>
                    </div>
                    <h5 class="text-lg font-semibold text-gray-900 mb-2">' . htmlspecialchars($product['product_title']) . '</h5>
                </div>
            </a>'
         </div>
    </div>
</body>
</html>