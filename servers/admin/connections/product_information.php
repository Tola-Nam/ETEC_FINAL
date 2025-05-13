<?php
require_once(__DIR__ . '/connection_database.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!class_exists('Product_information')) {
    class Product_information
    {
        private $product_title;
        private $product_price;
        private $stock;
        private $category;
        private $product_description;
        private $filename;
        private $Admin_id;

        public function __construct($product_title, $product_price, $stock, $category, $product_description, $filename, $Admin_id)
        {
            $this->product_title = $product_title;
            $this->product_price = $product_price;
            $this->stock = $stock;
            $this->category = $category;
            $this->product_description = $product_description;
            $this->filename = $filename;
            $this->Admin_id = $Admin_id;
        }

        public function file_uploader($source_file): string
        {
            $filename = rand(0, 999999999) . date('YmdHis') . '.' . pathinfo($source_file['name'], PATHINFO_EXTENSION);
            $destination = __DIR__ . '/../../assets/images/' . $filename;

            if (move_uploaded_file($source_file['tmp_name'], $destination)) {
                return $filename;
            } else {
                throw new Exception("Image upload failed!");
            }
        }

        public function insert_product(): void
        {
            $conn = connection_database();
            $stmt = $conn->prepare("INSERT INTO `goods` (`product_title`, `product_price`, `stock`, `category`, `product_description`, `product_thumbnail`, `author_id`) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?)");

            $stmt->bind_param("ssisssi", $this->product_title, $this->product_price, $this->stock, $this->category, $this->product_description, $this->filename, $this->Admin_id);

            if ($stmt->execute()) {
                echo "success";
            } else {
                echo "Database insertion failed.";
            }
        }
    }
}

// Handle AJAX request
try {
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $product_title = $_POST['product_title'] ?? '';
        $product_price = $_POST['product_price'] ?? '';
        $stock = $_POST['stock'] ?? '';
        $category = $_POST['category'] ?? '';
        $product_description = $_POST['product_description'] ?? '';
        $Admin_id = $_SESSION['Admin_id'] ?? 1; // Temporary fallback

        $source_file = $_FILES['product_thumbnail'];

        $product = new Product_information($product_title, $product_price, $stock, $category, $product_description, '', $Admin_id);

        $filename = $product->file_uploader($source_file);
        $product = new Product_information($product_title, $product_price, $stock, $category, $product_description, $filename, $Admin_id);

        $product->insert_product();
    }
} catch (Exception $e) {
    http_response_code(500);
    echo "Error: " . $e->getMessage();
}
