<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- @linkbootrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!-- @link icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <!-- Bootstrap & Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- @link css -->
    <!-- <link rel="stylesheet" href="http://localhost/ETEC_FINAL/public/src/style/style.css"> -->
    <!-- @link tailwencss -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">


</head>
<style>
    .swiper {
        width: 100%;
        padding: 20px 0;
    }

    .swiper-slide {
        display: flex;
        justify-content: center;
    }

    .card {
        width: 100%;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .loader {
        border: 4px solid rgba(255, 255, 255, 0.3);
        border-top: 4px solid #ffffff;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
    }

    .footer {
        background: #222;
        color: white;
        padding: 40px 0;
    }

    .footer .text-title span {
        font-size: 18px;
        font-weight: bold;
        color: #f8a100;
        display: block;
        margin-bottom: 10px;
    }

    .footer p {
        font-size: 14px;
        color: #ddd;
    }

    .footer form .form-control {
        border-radius: 5px;
    }

    .footer form .btn {
        background: #f8a100;
        border: none;
        color: white;
        transition: 0.3s;
    }

    .footer form .btn:hover {
        background: #e69500;
    }

    .footer ul {
        list-style: none;
        padding: 0;
    }

    .footer ul li {
        margin-bottom: 8px;
    }

    .footer ul li a {
        color: #ddd;
        text-decoration: none;
        font-size: 14px;
    }

    .footer ul li a:hover {
        text-decoration: underline;
    }

    .footer .container {
        background: #333;
        padding: 30px;
        border-radius: 10px;
    }

    .icons {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
    }

    /* For small screens, keep the icons in a row */
    @media (max-width: 768px) {
        .icons {
            flex-direction: row !important;
            justify-content: center;
        }

        .icons .btn {
            margin-right: 10px;
            margin-bottom: 10px;
        }
    }
</style>

<script>
    window.onload = function () {
        setTimeout(function () {
            document.getElementById("loading-screen").style.display = "none";
            document.getElementById("main-content").style.display = "block";
        }, 2000); // Display loading screen for 3 seconds
    };
</script>

<body class="bg-gray-900">
    <!-- Loading  -->
    <div id="loading-screen" class="flex flex-col items-center justify-center h-screen text-white">
        <div class="loader mb-4"></div>
        <p class="text-lg">Loading, please wait...</p>
    </div>
    <!-- card -->
    <div id="main-content" style="display: none;" class="container mt-4">
        <!-- navbar -->
        <nav>
            <div class="col-12">
                <div class="row">
                    <div class="col-4 col-md-4 d-flex flex-wrap justify-content-center gap-2">
                        <form action="">
                            <button class="btn btn-outline-success  w-md-auto">WOMEN</button>
                            <button class="btn btn-outline-success  w-md-auto">MEN</button>
                            <button class="btn btn-outline-success  w-md-auto">KIDS</button>
                        </form>
                    </div>

                    <div class="col-3 d-flex align-items-center justify-content-center text-center">
                        <img src="../assets/logo01.png" alt="Logo" class="rounded img-fluid"
                            style="width: 40px; height: 40px; object-fit: cover;">
                        <p class="text-white ms-2 mb-0 fw-bold">ZALANDO</p>
                    </div>

                    <div class="col-5">
                        <div class="icons">
                            <button class="btn btn-outline-success me-1"><i class="bi bi-person-circle"></i></button>
                            <button class="btn btn-outline-success me-1"><i class="bi bi-box-seam"></i></button>
                            <button class="btn btn-outline-success"><i class="bi bi-box-arrow-left"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="swiper mySwiper mt-2">
            <div class="swiper-wrapper">

                <!-- Block 1 -->
                <div class="swiper-slide">
                    <div class="block">
                        <h4>Category 1</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="https://via.placeholder.com/300" class="card-img-top" alt="Image 1">
                                    <div class="card-body">
                                        <h5 class="card-title">Card 1</h5>
                                        <p class="card-text">Description 1.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="https://via.placeholder.com/300" class="card-img-top" alt="Image 2">
                                    <div class="card-body">
                                        <h5 class="card-title">Card 2</h5>
                                        <p class="card-text">Description 2.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="https://via.placeholder.com/300" class="card-img-top" alt="Image 3">
                                    <div class="card-body">
                                        <h5 class="card-title">Card 3</h5>
                                        <p class="card-text">Description 3.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Block 2 -->
                <div class="swiper-slide">
                    <div class="block">
                        <h4>Category 2</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="https://via.placeholder.com/300" class="card-img-top" alt="Image 4">
                                    <div class="card-body">
                                        <h5 class="card-title">Card 4</h5>
                                        <p class="card-text">Description 4.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="https://via.placeholder.com/300" class="card-img-top" alt="Image 5">
                                    <div class="card-body">
                                        <h5 class="card-title">Card 5</h5>
                                        <p class="card-text">Description 5.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="https://gratisography.com/wp-content/uploads/2024/11/gratisography-augmented-reality-800x525.jpg"
                                        class="card-img-top" alt="Image 6">
                                    <div class="card-body">
                                        <h5 class="card-title">Card 6</h5>
                                        <p class="card-text">Description 6.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add more blocks as needed -->

            </div>

            <!-- Navigation Buttons -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>

            <!-- Pagination (Optional) -->
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <script src="../controllers/main.js"></script>

    <?php include('./footer.php') ?>