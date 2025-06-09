<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
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
            cursor: pointer;
        }

        /* For very long text in specific columns */
        .col-title {
            max-width: 120px;
        }

        .col-category {
            max-width: 100px;
        }

        /* Badge styling */
        .price-badge {
            background: linear-gradient(45deg, #17a2b8, #20c997);
            font-weight: 600;
        }

        .discount-badge {
            background: linear-gradient(45deg, #ffc107, #fd7e14);
            font-weight: 600;
        }

        .sale-badge {
            background: linear-gradient(45deg, #28a745, #20c997);
            font-weight: 600;
        }

        /* Button hover effects */
        .btn-group .btn {
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .text-truncate-custom {
                max-width: 80px;
            }

            .table-responsive {
                font-size: 0.875rem;
            }

            .btn-sm {
                font-size: 0.75rem;
                padding: 0.25rem 0.5rem;
            }
        }

        /* Modal enhancements */
        .modal-header {
            background: linear-gradient(45deg, #007bff, #0056b3);
            color: white;
        }

        .modal-header .btn-close {
            filter: invert(1);
        }

        /* Loading state */
        .loading {
            opacity: 0.6;
            pointer-events: none;
        }

        /* Tooltip styling */
        .tooltip-inner {
            max-width: 300px;
        }
    </style>
</head>

<body>
    <div class="container-fluid px-4 mt-4">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-10">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fas fa-box me-2"></i>Product Management</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col"><i class="fas fa-hashtag me-1"></i>ID</th>
                                        <th scope="col"><i class="fas fa-tag me-1"></i>Title</th>
                                        <th scope="col"><i class="fas fa-dollar-sign me-1"></i>Price</th>
                                        <th scope="col"><i class="fas fa-list me-1"></i>Category</th>
                                        <th scope="col"><i class="fas fa-image me-1"></i>Image</th>
                                        <th scope="col"><i class="fas fa-percent me-1"></i>Discount</th>
                                        <th scope="col"><i class="fas fa-chart-line me-1"></i>Sales</th>
                                        <th scope="col"><i class="fas fa-cogs me-1"></i>Actions</th>
                                    </tr>
                                </thead>
                                <?Php
                                require_once('../admin/connections/connection_database.php');
                                $connection = connection_database();
                                $Admin_id = $_SESSION['Admin_id'];
                                $getProduct = " SELECT product_code,product_title,product_price,category,product_thumbnail,discount,sale_count FROM goods WHERE author_id ='$Admin_id' ORDER BY category DESC";
                                $Query = $connection->query($getProduct);
                                if (isset($Query)) {
                                    while ($row = mysqli_fetch_assoc($Query)) {
                                        ?>
                                        <tbody id="productTableBody">
                                            <!-- Sample data for demonstration -->
                                            <tr>
                                                <td class="fw-bold"><?php echo $row['product_code'] ?></td>
                                                <td>
                                                    <div class="text-truncate-custom col-title fw-semibold"
                                                        title="Premium Wireless Headphones with Noise Cancellation"
                                                        data-bs-toggle="tooltip" data-bs-placement="top">
                                                        <?php echo $row['product_title'] ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge price-badge px-3 py-2 fs-6">$<?php echo $row['product_price'] ?></span>
                                                </td>
                                                <td>
                                                    <div class="text-truncate-custom col-category fw-semibold"
                                                        title="Electronics">
                                                        <?php echo $row['category'] ?>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="d-flex justify-content-center">
                                                        <img src="/ETEC_FINAL/servers/assets/images/<?php echo $row['product_thumbnail'] ?>"
                                                            alt="Product Thumbnail" class="rounded shadow-sm"
                                                            style="width: 50px; height: 50px; object-fit: cover;">
                                                    </div>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge discount-badge px-3 py-2 fs-6"><?php echo $row['discount'] ?>%</span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge sale-badge px-3 py-2 fs-6"><?php echo $row['sale_count'] ?></span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group" role="group">
                                                        <a href="/ETEC_FINAL/servers/admin/updateProduct.php?page=updateProduct&product_code=<?php echo $row['product_code']; ?>"
                                                            class="btn btn-sm btn-primary me-1">
                                                            <i class="fas fa-edit me-1"></i>Edit
                                                        </a>
                                                        <button type="button" class="btn btn-sm btn-danger">
                                                            <i class="fas fa-trash-alt me-1"></i>Delete
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <?php
                                    }
                                } else {
                                    echo '<script>alert("System is not found!!!");</script>';
                                    ?>
                                    <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.6/js/bootstrap.bundle.min.js"></script>

</body>

</html>