<?php
session_start();
include('../admin/connections/admin_register.php');
if (empty($_SESSION['Admin_id'])) {
    header("Location: http://localhost/ETEC_FINAL/servers/admin/authentication/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
        crossorigin="anonymous"></script>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* Normal sidebar style */
        #sidebar {
            width: 250px;
        }

        /* When collapsed */
        #sidebar.collapsed {
            width: 80px;
        }

        #sidebar.collapsed .sidebar-text,
        #sidebar.collapsed #sidebar-title {
            display: none;
        }

        #sidebar.collapsed i {
            margin-right: 0;
            text-align: center;
            width: 100%;
        }

        #main-content.collapsed {
            margin-left: 80px;
            width: calc(100% - 80px);
        }

        /* Mobile: hide sidebar by default */
        @media (max-width: 768px) {
            #sidebar {
                transform: translateX(-100%);
            }

            #sidebar.show {
                transform: translateX(0);
            }
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
    if (!empty($_GET['message'])) {
        $message = $_GET['message'];
        if ($message == "success") {
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
                            }, 3000);
                        }
                    });
                </script>
            ";
        }
    }
    ?>

    <!-- Sidebar -->
    <!-- Sidebar -->
    <div id="sidebar" class="bg-dark text-white flex flex-col fixed h-full transition-all duration-300 z-40"
        style="width: 250px;">
        <h3 id="sidebar-title" class="text-center text-lg font-semibold mb-4">Dashboard</h3>

        <a href="#" onclick="loadPage('../admin/dashboard.php')" class="hover:bg-gray-700 flex items-center p-3">
            <i class="bi bi-house-door me-2"></i>
            <span class="sidebar-text">Dashboard</span>
        </a>
        <a href="#" onclick="loadPage('../admin/invoice.php')" class="hover:bg-gray-700 flex items-center p-3">
            <i class="bi bi-receipt-cutoff me-2"></i>
            <span class="sidebar-text">Invoice</span>
        </a>
        <a href="#" onclick="loadPage('../admin/analytics.php')" class="hover:bg-gray-700 flex items-center p-3">
            <i class="bi bi-graph-up me-2"></i>
            <span class="sidebar-text">Analytics</span>
        </a>
        <a href="#" onclick="loadPage('../admin/form.php')" class="hover:bg-gray-700 flex items-center p-3">
            <i class="bi bi-ui-checks me-2"></i>
            <span class="sidebar-text">Form</span>
        </a>

        <button onclick="toggleSidebar()" class="mt-auto bg-gray-700 hover:bg-gray-600 text-white p-2">
            <i class="bi bi-list"></i>
        </button>
    </div>

    <!-- Floating button to open sidebar on small screens -->
    <button id="openSidebarBtn" onclick="toggleSidebar()"
        class="fixed top-4 left-4 bg-gray-100 text-gray-800 p-3 border-0 z-50 md:hidden">
        <i class="bi bi-list text-2xl"></i>
    </button>




    <!-- Main Content -->
    <div id="main-content">
        <?php include('./navbar.php'); ?> <!-- Navbar always fixed -->

        <div id="content" class="mt-4">
            <h2 class="text-2xl font-bold">Welcome to Dashboard</h2>
            <p>Select a section from the sidebar.</p>
        </div>
    </div>

    <!-- JS Scripts -->
    <script src="../javascript/main.js"></script>
</body>

</html>