<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login with Loader</title>
    <!-- @link bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
        crossorigin="anonymous"></script>
    <!-- @link css -->
    <link rel="stylesheet" href="http://localhost/ETEC_FINAL/servers/admin/theam.css">
    <!-- @link sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <style>
        #loader-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #fff;
            z-index: 1000;
            display: none;
            justify-content: center;
            align-items: center;
        }

        #loader {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #3498db;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style> -->
</head>

<body>
    <!-- Loader Overlay (Hidden by Default) -->
    <!-- <div id="loader-wrapper">
        <div id="loader"></div>
    </div> -->

    <div class="container mt-3">
        <div class="col">
            <div class="row justify-content-center">
                <form class="form" method="post">
                    <?php include('../connections/admin_register.php');

                    if (!empty($_GET['status'])) {
                        $status = $_GET['status'];
                        if (isset($status) == "fail") {
                            echo "
                            <script>
                            Swal.fire({
                              color: 'red',
                              title: 'invalid data',
                              text: 'Please fill in your information',
                              icon: 'warning'
                            });
                            </script>
                            ";
                        }
                    }
                    ?>
                    <div class="form-title"><span>sign in to your</span></div>
                    <div class="title-2"><span>SPACE</span></div>
                    <div class="input-container">
                        <input class="input-mail" name="UserName_Email" type="text"
                            placeholder="Enter email or UserName">
                        <span> </span>
                    </div>

                    <section class="bg-stars">
                        <span class="star"></span>
                        <span class="star"></span>
                        <span class="star"></span>
                        <span class="star"></span>
                    </section>

                    <div class="input-container">
                        <input class="input-pwd" name="Password" type="password" placeholder="Enter password">
                    </div>
                    <button type="submit" name="signin" class="submit">
                        <span class="sign-text">Sign in</span>
                    </button>

                    <p class="signup-link">
                        No account?
                        <a href="register.php" class="up">Sign up!</a>
                    </p>
                </form>
            </div>
        </div>
    </div>

    <!-- <script>
        // Show loader when the form is submitted
        const form = document.querySelector("form");
        form.addEventListener("submit", function () {
            document.getElementById("loader-wrapper").style.display = "flex";
        }, 3000);

        // Optional: prevent loader from flashing when using browser back
        if (performance.navigation.type === 2) {
            document.getElementById("loader-wrapper").style.display = "none";
        }
    </script> -->
</body>

</html>