<?php
include(__DIR__ . '/connection_database.php');

session_start();
function image_uploader($sourcefile): string
{
    if (!isset($sourcefile['name']) || !isset($sourcefile['tmp_name'])) {
        return ''; // or throw an Exception if you want stricter behavior
    }

    $filename = uniqid() . '.' . pathinfo($sourcefile['name'], PATHINFO_EXTENSION);
    move_uploaded_file($sourcefile['tmp_name'], 'C:/xampp/htdocs/ETEC_FINAL/servers/assets/images/' . $filename);
    return $filename;
}


class Product_information
{
    private $product_title;
    private $product_price;
    private $stock;
    private $category;
    private $product_description;
    private $filename;
    private $author_id;

    public function __construct($product_title, $product_price, $stock, $category, $product_description, $filename, $author_id)
    {
        $this->product_title = $product_title;
        $this->product_price = $product_price;
        $this->stock = $stock;
        $this->category = $category;
        $this->product_description = $product_description;
        $this->filename = $filename;
        $this->author_id = $author_id;
    }

    public function insert_product()
    {
        try {
            if (empty($this->product_title) || empty($this->product_price) || empty($this->stock) || empty($this->category) || empty($this->product_description) || empty($this->filename) || empty($this->author_id)) {
                throw new Exception(" some field is not completed. please check it again!!!");
            } else {
                $insert_product = " INSERT INTO `goods` ( `product_title` ,`product_price`, `stock`, `category`, `product_description`, `product_thumbnail`, `author_id`)
                                VALUES ('$this->product_title','$this->product_price','$this->stock', '$this->category', '$this->product_description', '$this->filename', '$this->author_id';)";
                // print_r($insert_product);
                $result = connection_database()->query($insert_product);

                print_r($result);
            }
            // print_r($_POST);
            // echo $this->author_id;
        } catch (Exception $exception) {
            header('Location: form.php?status=invalid');
            exit();
        }
    }
}

try {
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['add_product'])) {

        $author_id = $_SESSION['Admin_id'] ?? '';
        $product_title = $_POST['product_title'] ?? '';
        $product_price = $_POST['product_price'] ?? '';
        $stock = $_POST['stock'] ?? '';
        $category = $_POST['category'] ?? '';
        $product_description = $_POST['product_description'] ?? '';


        $filename = '';
        if (isset($_FILES['product_thumbnail']) && is_array($_FILES['product_thumbnail'])) {
            $filename = image_uploader($_FILES['product_thumbnail']);
        }

        $product_information = new Product_information($product_title, $product_price, $stock, $category, $product_description, $filename, $author_id);
        $product_information->insert_product();
    }
} catch (Exception $exception) {
    header("Location: form.php");
    exit();
}
?>