<?php
require_once(__DIR__ . '/connection_database.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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
    //* function for chance name image before insert to storing in database system.
    public function file_uploader($source_file): string
    {
        $filename = rand(0, 999999999) . date('YmdHis') . '.' . pathinfo($source_file['name'], PATHINFO_EXTENSION);
        $destination = __DIR__ . '/../assets/images/' . $filename;

        if (move_uploaded_file($source_file['tmp_name'], $destination)) {
            return $filename;
        } else {
            throw new Exception("Upload failed!");
        }
    }
    //? function for insert data into database system.
    public function insert_product(): void
    {
        try {
            // if (
            //     empty($this->product_title) ||
            //     empty($this->product_price) ||
            //     empty($this->stock) ||
            //     empty($this->category) ||
            //     empty($this->product_description) ||
            //     empty($this->filename) ||
            //     empty($this->Admin_id)
            // ) {
            //     throw new Exception("Some field is not completed. Please check it again!");
            // } else {
            //     $conn = connection_database();
            //     $insert_product = "INSERT INTO `goods` (`product_title`, `product_price`, `stock`, `category`, `product_description`, `product_thumbnail`, `author_id`) 
            //                    VALUES ('$this->product_title','$this->product_price','$this->stock', '$this->category', '$this->product_description', '$this->filename', '$this->Admin_id')";

            //     $result = $conn->query($insert_product);
            //     print_r($result);
            //     if (isset($result)) {
            //         header('Location: http://localhost/ETEC_FINAL/servers/include/header.php?message=success');
            //     }
            // }
            // echo " Hello world";
            echo $this->Admin_id;
            echo $this->stock;
            echo $this->filename;
            echo $this->category;
            echo $this->product_price;
            echo $this->product_title;
            echo $this->product_description;
        } catch (Exception $exception) {
            error_log($exception->getMessage());
            // header('Location: http://localhost/ETEC_FINAL/servers/include/header.php?status=invalid');
            // exit();
        }
    }
}

try {

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $product_title = $_POST['product_title'] ?? '';
        $product_price = $_POST['product_price'] ?? '';
        $stock = $_POST['stock'] ?? '';
        $category = $_POST['category'] ?? '';
        $product_description = $_POST['product_description'] ?? '';
        $Admin_id = $_SESSION['Admin_id'] ?? null;
        $source_file = $_FILES['product_thumbnail'];

        $product_information = new Product_information($product_title, $product_price, $stock, $category, $product_description, $filename, $Admin_id);
        // if (isset($_FILES['product_thumbnail']) && $_FILES['product_thumbnail']['error'] === UPLOAD_ERR_OK) {
        //     $product_information->file_uploader($_FILES['product_thumbnail']);
        //     $product_information = new Product_information($product_title, $product_price, $stock, $category, $product_description, $filename, $Admin_id);
        // }

        $filename = $product_information->file_uploader($source_file);
        if (isset($_POST['add_product'])) {
            $product_information->insert_product();
        }
    }
} catch (Exception $exception) {
    header("Location: http://localhost/ETEC_FINAL/servers/include/header.php");
    exit();
}
?>