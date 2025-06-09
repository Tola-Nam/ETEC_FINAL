<?php
 require_once __DIR__ . '/../include/header.php';
 ?>
    <!-- You May Also Like -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <?php
        require_once('../models/connection.php');
        $connection = connection();
        // Change this to your desired category
        $targetCategory = $_GET['status'];

        // Get products only from the specified category
        $orderSelect = "SELECT product_code, product_title, product_price, product_description, product_thumbnail, category 
                    FROM goods 
                    WHERE category = ? 
                    ORDER BY product_title";

        // Prepare and execute the query securely
        $stmt = $connection->prepare($orderSelect);
        $stmt->bind_param("s", $targetCategory);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && mysqli_num_rows($result) > 0) {
            echo '<h2 class="text-2xl font-bold text-gray-800 mb-6">' . htmlspecialchars($targetCategory) . '</h2>';
            echo '<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">';
            while ($product = mysqli_fetch_assoc($result)) {
                if ($targetCategory == "NewFashion" || $targetCategory == "Shoes" || $targetCategory == "SkinCare" || $targetCategory == "Electronics") {
                    ?>
                    <div class="group">
                        <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden mb-4">
                            <img src="http://localhost/ETEC_FINAL/servers/assets/images/<?php echo htmlspecialchars($product['product_thumbnail']); ?>"
                                alt="<?php echo htmlspecialchars($product['product_title']); ?>"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform" />
                        </div>
                        <h3 class="font-semibold text-gray-900"><?php echo htmlspecialchars($product['product_title']); ?></h3>
                        <p class="text-gray-600">$<?php echo htmlspecialchars($product['product_price']); ?></p>
                    </div>
                    <?php
                }
            }
            echo '</div>';
        } else {
            echo "<p class='text-gray-600'>No products found in category: " . htmlspecialchars($targetCategory) . "</p>";
        }
        ?>
    </section>

    </body>

</html>