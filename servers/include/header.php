<?php
session_start();
// session_destroy();
require_once('../admin/connections/admin_register.php');
require_once('../admin/connections/product_information.php');

if (empty($_SESSION['Admin_id'])) {
    header("Location: http://localhost/ETEC_FINAL/servers/admin/authentication/login.php");
    exit();
}

// Handle AJAX route request
if (isset($_GET['ajax'])) {
    $page = $_GET['page'] ?? 'dashboard';
    $whitelist = ['dashboard', 'invoice', 'analytics', 'form'];
    if (in_array($page, $whitelist)) {
        // Start output buffering to capture all output including any JavaScript
        ob_start();
        include(__DIR__ . "/../admin/{$page}.php");
        $content = ob_get_clean();
        echo $content;
    } else {
        http_response_code(404);
        echo "<p class='text-red-600'>404 - Page Not Found</p>";
    }
    exit(); // stop full HTML from rendering on AJAX
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap & Tailwind -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- @link sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Add Chart.js for dashboard charts if needed -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

    <style>
        /* Default sidebar width */
        #sidebar {
            width: 250px;
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        /* Mobile: hide sidebar off-screen */
        @media (max-width: 768px) {
            #sidebar {
                position: fixed;
                top: 0;
                left: 0;
                height: 100%;
                transform: translateX(-100%);
                z-index: 1001;
            }

            #sidebar.show {
                transform: translateX(0);
            }

            #overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 1000;
            }

            #main-content {
                margin-left: 0 !important;
            }
        }

        /* Desktop: normal fixed sidebar */
        @media (min-width: 769px) {
            #sidebar {
                position: fixed;
                top: 0;
                left: 0;
                height: 100%;
                overflow-y: auto;
            }

            #main-content {
                margin-left: 250px;
            }
        }
    </style>
</head>

<body class="bg-gray-100 text-white">
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
    <!-- Overlay for closing sidebar -->
    <div id="overlay" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <div id="sidebar" class="bg-dark text-white h-full flex flex-col">
        <h3 id="sidebar-title" class="text-center text-lg font-semibold my-4">Dashboard</h3>
        <a href="#" class="sidebar-link hover:bg-gray-700 flex items-center p-3" data-page="dashboard">
            <i class="bi bi-house-door me-2"></i><span class="sidebar-text">Dashboard</span>
        </a>
        <a href="#" class="sidebar-link hover:bg-gray-700 flex items-center p-3" data-page="invoice">
            <i class="bi bi-receipt-cutoff me-2"></i><span class="sidebar-text">Invoice</span>
        </a>
        <a href="#" class="sidebar-link hover:bg-gray-700 flex items-center p-3" data-page="analytics">
            <i class="bi bi-graph-up me-2"></i><span class="sidebar-text">Analytics</span>
        </a>
        <a href="#" class="sidebar-link hover:bg-gray-700 flex items-center p-3" data-page="form">
            <i class="bi bi-ui-checks me-2"></i><span class="sidebar-text">Form</span>
        </a>
    </div>

    <!-- Mobile Toggle Button -->
    <!-- bg-gray-100  -->
    <button id="openSidebarBtn" onclick="toggleSidebar()" class="fixed top-4 left-4 text-gray-800 p-3 z-50 md:hidden">
        <i class="bi bi-list text-2xl"></i>
    </button>

    <!-- Main Content -->
    <div id="main-content" class="p-4 transition-all duration-300">
        <?php include(__DIR__ . '/navbar.php'); ?>
        <div id="content" class="p-4">Loading...</div>
    </div>

    <script>
        // Toggle sidebar open/closed
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const overlay = document.getElementById("overlay");
            const isOpen = sidebar.classList.contains("show");

            if (isOpen) {
                sidebar.classList.remove("show");
                overlay.style.display = "none";
            } else {
                sidebar.classList.add("show");
                overlay.style.display = "block";
            }
        }

        // Helper function to extract and run scripts
        function runScriptsInContent(html) {
            // Create a temporary container
            const temp = document.createElement('div');
            temp.innerHTML = html;

            // Extract scripts
            const scripts = temp.querySelectorAll('script');

            // First append the HTML without scripts
            scripts.forEach(script => {
                script.remove();
            });

            // Then execute each script
            scripts.forEach(script => {
                const newScript = document.createElement('script');

                // Copy attributes
                Array.from(script.attributes).forEach(attr => {
                    newScript.setAttribute(attr.name, attr.value);
                });

                // Copy content
                newScript.textContent = script.textContent;

                // Add to document
                document.body.appendChild(newScript);
            });
        }

        // Navigate pages without reload
        function navigate(page, push = true) {
            // Show loading indicator
            document.getElementById("content").innerHTML = '<div class="text-center"><i class="bi bi-hourglass-split text-4xl animate-spin text-gray-800"></i><p class="text-gray-800">Loading...</p></div>';

            // Make sure we're using the correct path
            const basePath = '/ETEC_FINAL/servers';

            fetch(`${basePath}/include/header.php?ajax=1&page=${page}`)
                .then((res) => {
                    if (!res.ok) throw new Error(`Page not found (Status: ${res.status})`);
                    return res.text();
                })
                .then((html) => {
                    // Update the content
                    document.getElementById("content").innerHTML = html;

                    // Execute any scripts in the content
                    setTimeout(() => {
                        runScriptsInContent(html);

                        // Update URL if needed
                        if (push) {
                            history.pushState({ page }, "", `?page=${page}`);
                        }

                        // Update active state in sidebar
                        updateSidebarActiveState(page);
                    }, 100);
                })
                .catch((err) => {
                    document.getElementById("content").innerHTML =
                        `<div class="alert alert-danger">
                            <p>Failed to load page: ${page}</p>
                            <p>Error: ${err.message}</p>
                            <p>Please try refreshing the page or contact support.</p>
                        </div>`;
                    console.error(err);
                });
        }

        // Update sidebar active state
        function updateSidebarActiveState(activePage) {
            // Remove active class from all links
            document.querySelectorAll('.sidebar-link').forEach(link => {
                link.classList.remove('bg-gray-700');
            });

            // Add active class to current page link
            const activeLink = document.querySelector(`.sidebar-link[data-page="${activePage}"]`);
            if (activeLink) {
                activeLink.classList.add('bg-gray-700');
            }
        }

        // Close sidebar when clicking outside of it (mobile only)
        document.addEventListener("click", function (event) {
            const sidebar = document.getElementById("sidebar");
            const overlay = document.getElementById("overlay");
            const sidebarToggleBtn = document.getElementById("openSidebarBtn");
            const isMobile = window.innerWidth <= 768;

            if (
                isMobile &&
                sidebar.classList.contains("show") &&
                !sidebar.contains(event.target) &&
                (!sidebarToggleBtn || !sidebarToggleBtn.contains(event.target))
            ) {
                sidebar.classList.remove("show");
                overlay.style.display = "none";
            }
        });

        // Initial load
        document.addEventListener("DOMContentLoaded", () => {
            const params = new URLSearchParams(window.location.search);
            const page = params.get("page") || "dashboard";
            navigate(page, false);

            // Add click event listeners to all sidebar links
            document.querySelectorAll('.sidebar-link').forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    const page = this.getAttribute('data-page');
                    navigate(page);

                    // On mobile, also close the sidebar
                    if (window.innerWidth <= 768) {
                        toggleSidebar();
                    }
                });
            });
        });

        // Handle browser back/forward buttons
        window.addEventListener('popstate', function (event) {
            if (event.state && event.state.page) {
                navigate(event.state.page, false);
            } else {
                navigate('dashboard', false);
            }
        });
    </script>

</body>

</html>