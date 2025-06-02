<?php
session_start();
// session_destroy();
// require_once('//public/src/models/getthumbnail.php');
require_once('../admin/connections/admin_register.php');
require_once('../admin/connections/product_information.php');

if (empty($_SESSION['Admin_id'])) {
    header("Location: http://localhost/ETEC_FINAL/servers/admin/authentication/login.php");
    exit();
}

//~ Handle AJAX route request
if (isset($_GET['ajax'])) {
    $page = $_GET['page'] ?? 'dashboard';
    $whitelist = ['dashboard', 'invoice', 'analytics', 'form', 'home', 'projects', 'about', 'contact', 'invoiceReport'];
    if (in_array($page, $whitelist)) {
        //? Start output buffering to capture all output including any JavaScript
        ob_start();
        include(__DIR__ . "/../admin/{$page}.php");
        $content = ob_get_clean();
        echo $content;
    } else {
        http_response_code(404);
        echo "<p class='text-red-600'>404 - Page Not Found</p>";
    }
    exit(); //! stop full HTML from rendering on AJAX
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <!-- Root favicon -->
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <!-- Linux + modern browsers -->
    <link rel="icon" type="image/png" sizes="32x32" href="/icons/favicon-32x32.png">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="This is a sample website for showcasing metadata usage.">
    <meta name="keywords" content="HTML, metadata, SEO, web development">
    <meta name="author" content="Online sale">

    <!-- Open Graph for social sharing -->
    <meta property="og:title" content="Your Website Title">
    <meta property="og:description" content="Description shown when your link is shared on social media.">
    <meta property="og:image" content="https://example.com/image.jpg">
    <meta property="og:url" content="https://example.com">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Your Website Title">
    <meta name="twitter:description" content="Twitter description of your website">
    <meta name="twitter:image" content="https://example.com/image.jpg">
    <!-- Bootstrap & Tailwind -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- @link sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- @ link css -->
    <link rel="stylesheet" href="./Tailwind.css">
    <!-- Add Chart.js for dashboard charts if needed -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>


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

    <!-- Overlay for closing sidebar on mobile -->
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
        <a href="#" class="sidebar-link hover:bg-gray-700 flex items-center p-3" data-page="invoiceReport">
            <i class="bi bi-receipt-cutoff me-2"></i><span class="sidebar-text">InvoiceReport</span>
        </a>
        <a href="#" class="sidebar-link hover:bg-gray-700 flex items-center p-3" data-page="analytics">
            <i class="bi bi-grid me-2"></i><span class="sidebar-text">Product</span>
        </a>
        <a href="#" class="sidebar-link hover:bg-gray-700 flex items-center p-3" data-page="form">
            <i class="bi bi-ui-checks me-2"></i><span class="sidebar-text">Form</span>
        </a>
    </div>

    <!-- Mobile Toggle Button - Fixed positioning and visibility -->
    <button id="openSidebarBtn" onclick="toggleSidebar()"
        class="fixed text-gray-800 p-2 rounded-md z-80 md:hidden hover:bg-gray-100 transition-colors">
        <i class="bi bi-list text-xl"></i>
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
                document.body.style.overflow = "auto"; // Re-enable scrolling
            } else {
                sidebar.classList.add("show");
                overlay.style.display = "block";
                document.body.style.overflow = "hidden"; // Prevent background scrolling
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

            //~ Then execute each script with proper error handling
            scripts.forEach(script => {
                try {
                    //^ Skip external scripts to avoid conflicts
                    if (script.src) {
                        return;
                    }

                    //& Wrap script content in IIFE to avoid variable conflicts
                    const scriptContent = script.textContent;
                    if (scriptContent.trim()) {
                        // Create isolated scope for script execution
                        const wrappedScript = `
                            (function() {
                                try {
                                    ${scriptContent}
                                } catch(e) {
                                    console.warn('Script execution error:', e);
                                }
                            })();
                        `;
                        //! Execute in global scope but with error handling
                        const newScript = document.createElement('script');
                        newScript.textContent = wrappedScript;
                        document.body.appendChild(newScript);
                        // Clean up script element after execution
                        setTimeout(() => {
                            if (newScript.parentNode) {
                                newScript.parentNode.removeChild(newScript);
                            }
                        }, 100);
                    }
                } catch (e) {
                    console.warn('Error processing script:', e);
                }
            });
        }

        // Navigate pages without reload
        function navigate(page, push = true) {
            // Show loading indicator
            document.getElementById("content").innerHTML = '<div class="text-center"><i class="bi bi-hourglass-split text-4xl animate-spin text-gray-800"></i><p class="text-gray-800">Loading...</p></div>';

            //^ Make sure we're using the correct path
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

                        //~ Update active state in sidebar
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

        //? Close sidebar when clicking outside of it (mobile only)
        document.addEventListener("click", function (event) {
            const sidebar = document.getElementById("sidebar");
            const overlay = document.getElementById("overlay");
            const sidebarToggleBtn = document.getElementById("openSidebarBtn");
            const isMobile = window.innerWidth <= 767;

            if (
                isMobile &&
                sidebar.classList.contains("show") &&
                !sidebar.contains(event.target) &&
                (!sidebarToggleBtn || !sidebarToggleBtn.contains(event.target))
            ) {
                toggleSidebar();
            }
        });

        //? Handle window resize
        window.addEventListener('resize', function () {
            const sidebar = document.getElementById("sidebar");
            const overlay = document.getElementById("overlay");
            if (window.innerWidth >= 768) {
                // Desktop: always show sidebar, hide overlay
                sidebar.classList.remove("show");
                overlay.style.display = "none";
                document.body.style.overflow = "auto";
            } else {
                //! Mobile: hide sidebar unless explicitly shown
                if (!sidebar.classList.contains("show")) {
                    overlay.style.display = "none";
                }
            }
        });

        // Initial load
        document.addEventListener("DOMContentLoaded", () => {
            const params = new URLSearchParams(window.location.search);
            const page = params.get("page") || "dashboard";
            navigate(page, false);

            //& Add click event listeners to all sidebar links
            document.querySelectorAll('.sidebar-link').forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    const page = this.getAttribute('data-page');
                    navigate(page);

                    // On mobile, also close the sidebar
                    if (window.innerWidth <= 767) {
                        toggleSidebar();
                    }
                });
            });
        });

        //! Handle browser back/forward buttons
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