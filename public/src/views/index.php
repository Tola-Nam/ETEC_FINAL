<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <!-- Bootstrap & Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <link rel="stylesheet" href="../style/style.css">

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
</style>

<body>
    
    <div class="container mt-4">
        <div class="swiper mySwiper">
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




</body>

<script src="../controllers/main.js"></script>

</html>