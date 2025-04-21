<?php
include('../admin/connections/adminregister.php');
session_start();
if (empty($_SESSION['id'])) {
    header("Location: http://localhost/ETEC_FINAL/servers/admin/authentication/login.php");
}

?>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- @link css -->
    <!-- <link rel="stylesheet" href="http://localhost/ETEC_FINAL/public/src/style/style.css"> -->
    <!-- @link tailwencss -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- @fontout some -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- @cdn tailwencss -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"> -->
    <!-- <script src="https://cdn.tailwindcss.com" data-hide="true"></script> -->
    <!-- <script src="https://cdn.tailwindcss.com"></script>
</head> -->
    <style>
        body {
            display: flex;
        }

        #sidebar {
            width: 250px;
            height: 100vh;
            background: #343a40;
            color: white;
            padding-top: 20px;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
        }

        #sidebar a {
            color: white;
            text-decoration: none;
            padding: 15px;
            display: block;
        }

        #sidebar a:hover {
            background: #495057;
        }

        #main-content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
        }
    </style>
    <!-- 
<body>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sidebar with Dropdown</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    </head> -->

<body class="bg-gray-100 flex">
    <?php
    // include('../admin/connections/adminregister.php');
    if (!empty($_GET['message'])) {
        $message = $_GET['message'];
        if (isset($message) == "success") {
            echo "
                    <script>
                   Swal.fire({
                        title: 'Loading...',
                        text: 'Please wait...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                            setTimeout(() => {
                            Swal.close();
                            }, 3000); // 3 seconds
                        }
                        });
                    </script>
                    ";
        }
    }
    ?>

    <!-- Sidebar -->
    <div class="w-64 bg-gray-800 text-white min-h-screen p-4 ">
        <h3 class="text-center text-lg font-semibold">Dashboard</h3>

        <a href="#" onclick="loadPage('../admin/dashboard.php')" class="block py-2 px-4 hover:bg-gray-700 mt-2">
            <i class="bi bi-house-door me-2"></i> Dashboard
        </a>
        <a href="#" onclick="loadPage('../admin/invoice.php')" class="block py-2 px-4 hover:bg-gray-700 mt-2">
            <i class="bi bi-receipt-cutoff me-2"></i> Invoice
        </a>
        <a href="#" onclick="loadPage('analytics.php')" class="block py-2 px-4 hover:bg-gray-700 mt-2">
            <i class="bi bi-graph-up me-2"></i> Analytics
        </a>
        <a href="#" onclick="loadPage('settings.php')" class="block py-2 px-4 hover:bg-gray-700 mt-2">
            <i class="bi bi-gear me-2"></i> Settings
        </a>
        <a href="#" onclick="loadPage('../admin/form.php')" class="block py-2 px-4 hover:bg-gray-700 mt-2">
            <i class="bi bi-ui-checks me-2"></i>Form
        </a>

        <!-- Dropdown Menu -->
        <div class="relative mt-2">
            <button id="dropdownButton" class="w-full text-left py-2 px-4 hover:bg-gray-700">
                <i class="bi bi-person"></i> Account ▼
            </button>

            <div id="dropdownMenu" class="absolute left-0 w-full text-gray-900 border-0 rounded-md shadow-lg hidden">
                <a href="#" name="signin"
                    class="block px-4 py-2 hover:bg-green-200 btn btn-outline-success mb-2">login</a>
                <a href="#" name="signup"
                    class="block px-4 py-2 hover:bg-blue-200 btn btn-outline-primary mb-2">Register</a>
                <a href="#" name="Logout" class="block px-4 py-2 hover:bg-red-200 btn btn-outline-danger">Logout<i
                        class="bi bi-box-arrow-left"></i></a>
            </div>
        </div>

    </div>

    <!-- Main Content Area -->
    <div class="flex-1 p-6">
        <div id="content">
            <h2 class="text-2xl font-bold">Welcome to Dashboard</h2>
            <p>Select a section from the sidebar.</p>
        </div>
    </div>
</body>
<!-- javascript for routers -->
<script>
    const dropdownButton = document.getElementById("dropdownButton");
    const dropdownMenu = document.getElementById("dropdownMenu");

    dropdownButton.addEventListener("click", () => {
        dropdownMenu.classList.toggle("hidden");
    });

    // Close dropdown when clicking outside
    document.addEventListener("click", (event) => {
        if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add("hidden");
        }
    });

    function loadPage(page) {
        // Check if the page is different from the current one
        if (window.location.pathname === page) {
            // Optionally, you can force the page to reload the content manually
            document.getElementById('content').innerHTML = 'Loading...'; // Display a loading message
            fetch(page)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('content').innerHTML = data;
                })
                .catch(error => console.error("Error loading page:", error));
        } else {
            // For different pages, just update the content
            fetch(page)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('content').innerHTML = data;
                    window.history.pushState(null, '', page); // Update URL
                })
                .catch(error => console.error("Error loading page:", error));
        }
    }

</script>

</html>