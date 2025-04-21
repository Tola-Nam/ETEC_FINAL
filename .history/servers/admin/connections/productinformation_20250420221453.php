<?php
include(__DIR__ . '/connectiondatabase.php');
// include(__DIR__ . '/../uploaderimage.php');


// include('./connectiondatabase.php');
// include('./uploaderimage.php');
class Productinformation
{
    protected $product_title;
    protected $product_price;
    protected $stock;
    protected $category;
    protected $product_description;
    protected $filename;
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

    public function insertproduct()
    {
        try {

            if (!empty($this->product_title) || !empty($this->product_price) || !empty($this->stock) || !empty($this->category) || !empty($this->product_description) || !empty($this->filename)) {
                $inserproduct = "INSERT INTO `goods` ( `product_title`, `product_price`,`stock`,`category`,`product_description`,`product_thumbnail`,`author_id`)
                                VALUES ('$this->product_title','$this->product_price','$this->stock','$this->category','$this->product_description','$this->filename','$$this->author_id');";

                try {
                    $inserQuery = connectiondatabase()->query($inserproduct);
                    if (empty($inserQuery)) {
                        header('Location: form.php?message=fail');
                    } else {
                        header('Location: dashboard.php?message=success');
                    }
                } catch (Exception $exception) {
                    header("Location : ");
                }
            } else {
                header('Location : http://localhost/ETEC_FINAL/servers/admin/form.php?status=invalid');
            }
        } catch (Exception $e) {
            header('Location: http://localhost/ETEC_FINAL/servers/admin/form.php?status=invalid');
        }
    }
}


try {
    session_start();
    if (!empty($_SERVER['REQUEST_METHOD']) == "POST") {
        $product_title = $_POST['product_title'] ?? '';
        $product_price = $_POST['product_price'] ?? '';
        $stock = $_POST['stock'] ?? '';
        $category = $_POST['category'] ?? '';
        $product_description = $_POST['product_description'] ?? '';
        $imageuploader = $_FILES['product_thubnail'] ?? '';
        // $filename = imageuploader($imageuploader);
        $author_id = $_SESSION['Admin_id'] ?? '';

        if (!empty($_POST)) {

            $productinformation = new Productinformation($product_title, $product_price, $stock, $category, $product_description, $filename, $author_id);
        }
        if (!empty($_POST['addproduct'])) {
            $productinformation->insertproduct();
        }

    }
} catch (Exception $exception) {
    header("Location : http://localhost/ETEC_FINAL/servers/admin/form.php");
}
?>