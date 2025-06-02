<style>
    /* Center align all table content */
    .table th,
    .table td {
        text-align: center;
        vertical-align: middle;
    }

    /* Text truncation with ellipsis */
    .text-truncate-custom {
        max-width: 150px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* For very long text in specific columns */
    .col-title {
        max-width: 120px;
    }

    .col-category {
        max-width: 100px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .text-truncate-custom {
            max-width: 80px;
        }
    }
</style>
</head>

<body>
    <div class="container mx-auto px-4 mt-4">
        <div class="col-8">
            <table class="table table-bordered border-primary mx-auto px-4 mt-4">
                <thead>
                    <tr>
                        <th scope="col" class="d-md-table-cell">ID</th>
                        <th scope="col" class="d-md-table-cell">proTitle</th>
                        <th scope="col" class="d-md-table-cell">ProPrice</th>
                        <th scope="col" class="d-md-table-cell">Category</th>
                        <th scope="col" class="d-md-table-cell">ProThumbnail</th>
                        <th scope="col" class="d-md-table-cell">Discount</th>
                        <th scope="col" class="d-md-table-cell">SaleCount</th>
                        <th scope="col" class="d-md-table-cell">Action</th>
                    </tr>
                </thead>
                <?php
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $connection = connection_database();
                $author_id = isset($_SESSION['Admin_id']) ? $_SESSION['Admin_id'] : null;

                $SelectProduct = "SELECT product_code,product_title,product_price,category,product_thumbnail,discount,sale_count FROM goods where author_id = '$author_id'";
                $Query = $connection->query($SelectProduct);
                $BaseUrl = 'http://localhost/ETEC_FINAL/servers/assets/images/';

                while ($row = mysqli_fetch_assoc($Query)) {
                    ?>
                    <tbody>
                        <tr>
                            <td class="d-md-table-cell"><?php echo $row['product_code']; ?></td>
                            <td class="d-md-table-cell">
                                <div class="text-truncate-custom col-title" title="KAKA">
                                    <?php echo $row['product_title'] ?>
                                </div>
                            </td>
                            <td class="d-md-table-cell">
                                <span class="bg-info text-light rounded align-items-center px-2 py-1">$
                                    <?php echo $row['product_price'] ?>
                                </span>
                            </td>
                            <td class="d-md-table-cell">
                                <div class="text-truncate-custom col-category" title="sale">
                                    <?php echo $row['category'] ?>
                                </div>
                            </td>
                            <td class="align-middle">
                                <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
                                    <img src="http://localhost/ETEC_FINAL/servers/assets/images/<?php echo $row['product_thumbnail']; ?>"
                                        alt="Thumbnail" style="width: 40px; height: 40px; object-fit: cover;"
                                        class="rounded shadow-sm">
                                </div>
                            </td>
                            <td class="d-md-table-cell">
                                <span class="bg-warning text-light rounded align-items-center px-2 py-1">
                                    <?php echo $row['discount'] ?>
                                </span>
                            </td>
                            <td class="d-md-table-cell">
                                <span class="bg-success text-light rounded align-items-center px-2 py-1">
                                    <?php echo $row['sale_count'] ?>
                                </span>
                            </td>
                            <td class="text-center align-middle">
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    <button class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i> Update
                                    </button>
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </div>
                            </td>


                        </tr>

                    </tbody>
                    <?php
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>