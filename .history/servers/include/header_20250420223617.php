<?php
include('../admin/connections/admin_register.php');
session_start();
if (empty($_SESSION['id'])) {
    header("Location: http://localhost/ETEC_FINAL/servers/admin/authentication/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
</head>

<body class="bg-gray-100">
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
    <div id="sidebar">
        <h3 class="text-center text-lg font-semibold mb-4">Dashboard</h3>
        <a href="#" onclick="loadPage('../admin/dashboard.php')" class="hover:bg-gray-700"><i
                class="bi bi-house-door me-2"></i> Dashboard</a>
        <a href="#" onclick="loadPage('../admin/invoice.php')" class="hover:bg-gray-700"><i
                class="bi bi-receipt-cutoff me-2"></i> Invoice</a>
        <a href="#" onclick="loadPage('analytics.php')" class="hover:bg-gray-700"><i class="bi bi-graph-up me-2"></i>
            Analytics</a>
        <a href="#" onclick="loadPage('settings.php')" class="hover:bg-gray-700"><i class="bi bi-gear me-2"></i>
            Settings</a>
        <a href="#" onclick="loadPage('../admin/form.php')" class="hover:bg-gray-700"><i
                class="bi bi-ui-checks me-2"></i> Form</a>

        <div class="relative mt-2">
            <button id="dropdownButton" class="w-full text-left py-2 px-4 hover:bg-gray-700">
                <i class="bi bi-person"></i> Account ▼
            </button>
            <div id="dropdownMenu"
                class="absolute left-0 w-full bg-white text-gray-900 border-0 rounded-md shadow-lg hidden">
                <a href="#" class="block px-4 py-2 hover:bg-green-200">Login</a>
                <a href="#" class="block px-4 py-2 hover:bg-blue-200">Register</a>
                <a href="#" class=" btn block px-4 py-2 hover:bg-red-200">Logout <i class="bi bi-box-arrow-left"></i></a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div id="main-content">
        <div id="content">
            <h2 class="text-2xl font-bold">Welcome to Dashboard</h2>
            <p>Select a section from the sidebar.</p>
        </div>
    </div>

    <!-- JS -->
    <script>
        const dropdownButton = document.getElementById("dropdownButton");
        const dropdownMenu = document.getElementById("dropdownMenu");

        dropdownButton.addEventListener("click", () => {
            dropdownMenu.classList.toggle("hidden");
        });

        document.addEventListener("click", (event) => {
            if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add("hidden");
            }
        });

        function loadPage(page) {
            document.getElementById('content').innerHTML = 'Loading...';
            fetch(page)
                .then(response => {
                    if (!response.ok) throw new Error("Page not found");
                    return response.text();
                })
                .then(data => {
                    document.getElementById('content').innerHTML = data;
                    // Uncomment the next line to update the URL in the address bar:
                    // window.history.pushState(null, '', page);
                })
                .catch(error => {
                    document.getElementById('content').innerHTML = '<p class="text-red-500">Error loading page.</p>';
                    console.error("Error loading page:", error);
                });
        }

        // On refresh: Load correct content based on URL path
        window.addEventListener("DOMContentLoaded", () => {
            const path = window.location.pathname.split("/").pop();
            const validPages = ["dashboard.php", "invoice.php", "analytics.php", "settings.php", "form.php"];
            if (validPages.includes(path)) {
                loadPage(path);
            }
        });
    </script>

</body>

</html>