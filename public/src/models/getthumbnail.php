<?php
require_once('./connection.php');

function GetProduct(): void
{
    $connection = connection();

    //~ Fetch all goods ordered by category
    $getter = "SELECT * FROM `goods` ORDER BY `category` ASC";
    $result = $connection->query($getter);

    if ($result && $result->num_rows > 0) {
        $currentCategory = '';
        while ($row = mysqli_fetch_assoc($result)) {
            //! Show category heading if it's a new category
            if ($row['category'] !== $currentCategory) {
                $currentCategory = $row['category'];
                echo "<h2>Category: " . htmlspecialchars($currentCategory) . "</h2>";
            }

            //^ Display product details
            echo "- " . htmlspecialchars($row['product_code']) . "<br>";
        }
    } else {
        echo "No products found or query failed.";
    }
}

GetProduct();
?>