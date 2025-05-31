<!-- form.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add New Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100 p-10">

    <div class="w-full max-w-lg mx-auto bg-gray p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-4">Add New Product</h2>

        <form id="productForm" enctype="multipart/form-data">
            <!-- Product Title -->
            <div class="mb-2">
                <label for="product-title" class="block text-sm font-medium text-gray-700">Product Title</label>
                <input type="text" name="product_title" id="product-title"
                    class="w-full px-3 py-2 border rounded-lg text-black" required>
            </div>

            <!-- Price -->
            <div class="mb-2">
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="text" name="product_price" id="price" class="w-full px-3 py-2 border rounded-lg text-black"
                    required>
            </div>

            <!-- Stock -->
            <div class="mb-2">
                <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                <input type="number" name="stock" id="stock" class="w-full px-3 py-2 border rounded-lg text-black"
                    required>
            </div>
            <!-- discount -->
            <div class="mb-4">
                <label for="stock" class="block text-sm font-medium text-gray-700">discount</label>
                <input type="number" name="discount" id="stock" class="w-full px-3 py-2 border rounded-lg text-black"
                    required>
            </div>

            <!-- Category -->
            <div class="mb-2">
                <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category" id="category" class="w-full px-3 py-2 border rounded-lg text-black" required>
                    <option value="" disabled selected>Select a category</option>
                    <option value="electronics">NewFashion</option>
                    <option value="fashion">Electronics</option>
                    <option value="home">Shoes</option>
                    <option value="beauty">SkinCare</option>
                </select>
            </div>

            <!-- Description -->
            <div class="mb-2">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="product_description" id="description"
                    class="w-full px-3 py-2 border rounded-lg text-black" rows="3" required></textarea>
            </div>

            <!-- Image Upload -->
            <div class="mb-2">
                <label for="product_thumbnail" class="block text-sm font-medium text-gray-700">Product Image</label>
                <input type="file" name="product_thumbnail" id="product_thumbnail"
                    class="w-full px-3 py-2 border rounded-lg text-black" required>
            </div>

            <!-- Submit -->
            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Add Product
            </button>
        </form>
    </div>


    <script>
        document.getElementById("productForm").addEventListener("submit", function (e) {
            e.preventDefault();

            const formData = new FormData(this);
            fetch("/ETEC_FINAL/servers/admin/connections/product_information.php", {
                method: "POST",
                body: formData
            })
                .then(response => response.text())
                .then(data => {
                    if (data === "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Product Added',
                            text: 'The product has been successfully added!'
                        });
                        document.getElementById("productForm").reset();
                    } else {
                        throw new Error(data);
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message
                    });
                });
        });
    </script>

</body>

</html>