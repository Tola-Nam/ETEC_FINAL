<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- @link_bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!-- @link icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <!-- Bootstrap & Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- @link css -->
    <!-- <link rel="stylesheet" href="http://localhost/ETEC_FINAL/public/src/style/style.css"> -->
    <!-- @link tailwindcss -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- @font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- @ tailwindcss-->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>

    <div class="w-full max-w-lg bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-4">Add New Product</h2>

        <form action="" method="post">
            <?php
            include(__DIR__ . '/connections/product_information.php');
            if (!empty($_GET['message']) || !empty($_GET['status'])) {
                $message = $_GET['message'] ?? "";
                $status = $_GET['status'] ?? "";
                if ($message || $status === "invalid") {
                    echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        footer: '<a href=\"\">Why do I have this issue?</a>'
                    });
                </script>";
                }
            }
            ?>
            <!-- Product Name -->
            <div class="mb-4">
                <label class="block text-gray-600 text-sm font-medium mb-1" for="product-name">Product title</label>
                <input
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    type="text" id="product-name" name="product_title" placeholder="Enter product title">
            </div>

            <!-- Price -->
            <div class="mb-4">
                <label class="block text-gray-600 text-sm font-medium mb-1" for="price">Price ($)</label>
                <input
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    type="text" id="price" name="product_price" placeholder="Enter price">
            </div>
            <!-- STOCK -->
            <div class="mb-4">
                <label class="block text-gray-600 text-sm font-medium mb-1" for="price">Stock</label>
                <input
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    type="number" name="stock" id="stock" placeholder="Enter stock">
            </div>

            <!-- Category -->
            <div class="mb-4">
                <label class="block text-gray-600 text-sm font-medium mb-1" for="category">Category</label>
                <select name="category"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    id="category">
                    <option value="" disabled selected>Select a category</option>
                    <option value="electronics">Electronics</option>
                    <option value="fashion">Fashion</option>
                    <option value="home">Home & Living</option>
                    <option value="beauty">Beauty & Health</option>
                </select>
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label class="block text-gray-600 text-sm font-medium mb-1" for="description">Description</label>
                <textarea name="product_description"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    id="description" rows="4" placeholder="Enter product description"></textarea>
            </div>

            <!-- Product Image Upload -->
            <div class="mb-4">
                <label class="block text-gray-600 text-sm font-medium mb-1" for="product-image">Product Image</label>
                <input
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    type="file" name="product_thumbnail" id="product-image">
            </div>

            <!-- Submit Button -->
            <button name="add_product" type="submit"
                class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                Add Product
            </button>
        </form>
    </div>
</body>

</html>