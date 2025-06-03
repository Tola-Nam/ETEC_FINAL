<?php
include_once "../admin/connections/connection_database.php";
require_once('../admin/connections/product_information.php');
$connection = connection_database();

// Get product_code from URL
$product_code = $_GET['product_code'] ?? '';

// echo $product_code;

if (empty($product_code)) {
    die("<p class='text-red-500'>Product code is missing.</p>");
}

// Fetch product data using prepared statement
$stmt = $connection->prepare("SELECT product_title, product_price, stock, discount, category, product_description, product_thumbnail FROM goods WHERE product_code = ?");
$stmt->bind_param("s", $product_code);
$stmt->execute();
$Query = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 p-10">
    <div class="w-full max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-4">Update Product</h2>

        <?php if ($getData = $Query->fetch_assoc()) { ?>
            <form method="post" action="#" enctype="multipart/form-data">
                <input type="hidden" name="product_code" value="<?= htmlspecialchars($product_code) ?>">

                <!-- Title -->
                <div class="mb-2">
                    <label class="block text-sm font-medium">Product Title</label>
                    <input type="text" name="product_title" value="<?= htmlspecialchars($getData['product_title']) ?>"
                        class="w-full px-3 py-2 border rounded-lg text-black" required>
                </div>

                <!-- Price -->
                <div class="mb-2">
                    <label class="block text-sm font-medium">Price</label>
                    <input type="text" name="product_price" value="<?= htmlspecialchars($getData['product_price']) ?>"
                        class="w-full px-3 py-2 border rounded-lg text-black" required>
                </div>

                <!-- Stock -->
                <div class="mb-2">
                    <label class="block text-sm font-medium">Stock</label>
                    <input type="number" name="stock" value="<?= htmlspecialchars($getData['stock']) ?>"
                        class="w-full px-3 py-2 border rounded-lg text-black" required>
                </div>

                <!-- Discount -->
                <div class="mb-2">
                    <label class="block text-sm font-medium">Discount</label>
                    <input type="number" name="discount" value="<?= htmlspecialchars($getData['discount']) ?>"
                        class="w-full px-3 py-2 border rounded-lg text-black" required>
                </div>

                <!-- Category -->
                <div class="mb-2">
                    <label class="block text-sm font-medium">Category</label>
                    <select name="category" class="w-full px-3 py-2 border rounded-lg text-black" required>
                        <?php
                        $categories = ['NewFashion', 'Electronics', 'Shoes', 'SkinCare'];
                        foreach ($categories as $cat) {
                            $selected = ($getData['category'] === $cat) ? 'selected' : '';
                            echo "<option value=\"$cat\" $selected>$cat</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Description -->
                <div class="mb-2">
                    <label class="block text-sm font-medium">Description</label>
                    <textarea name="product_description" rows="3" class="w-full px-3 py-2 border rounded-lg text-black"
                        required><?= htmlspecialchars($getData['product_description']) ?></textarea>
                </div>

                <!-- Thumbnail Preview -->
                <div class="mb-2">
                    <label class="block text-sm font-medium">Current Image</label>
                    <img src="/ETEC_FINAL/servers/assets/images/<?= htmlspecialchars($getData['product_thumbnail']) ?>"
                        style="width: 80px; height: 80px; object-fit: cover;" class="rounded shadow-sm mb-2">
                    <input type="file" name="product_thumbnail" class="w-full px-3 py-2 border rounded-lg text-black">
                </div>

                <!-- Submit -->
                <button type="submit" name="updateProduct"
                    class="w-full bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Update Product
                </button>
            </form>
        <?php } else {
            echo "<p class='text-red-500'>Product not found.</p>";
        } ?>
    </div>
</body>

</html>