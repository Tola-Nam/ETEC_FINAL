<div class="w-full max-w-lg bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-semibold text-center text-gray-700 mb-4">Add New Product</h2>

    <form action="#" method="POST" enctype="multipart/form-data">
        <!-- Product Name -->
        <div class="mb-4">
            <label class="block text-gray-600 text-sm font-medium mb-1" for="product-name">Product Name</label>
            <input
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                type="text" id="product-name" placeholder="Enter product name" required>
        </div>

        <!-- Price -->
        <div class="mb-4">
            <label class="block text-gray-600 text-sm font-medium mb-1" for="price">Price ($)</label>
            <input
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                type="number" id="price" placeholder="Enter price" required>
        </div>

        <!-- Category -->
        <div class="mb-4">
            <label class="block text-gray-600 text-sm font-medium mb-1" for="category">Category</label>
            <select
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                id="category" required>
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
            <textarea
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                id="description" rows="4" placeholder="Enter product description" required></textarea>
        </div>

        <!-- Product Image Upload -->
        <div class="mb-4">
            <label class="block text-gray-600 text-sm font-medium mb-1" for="product-image">Product Image</label>
            <input
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                type="file" id="product-image" accept="image/*" required>
        </div>

        <!-- Submit Button -->
        <button class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
            Add Product
        </button>
    </form>
</div>