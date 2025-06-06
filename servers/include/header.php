<?php
session_start();
// session_destroy();
// require_once('//public/src/models/getThumbnail.php');
require_once('../admin/connections/admin_register.php');
require_once('../admin/connections/product_information.php');

if (empty($_SESSION['Admin_id'])) {
    header("Location: http://localhost/ETEC_FINAL/servers/admin/authentication/login.php");
    exit();
}

//~ Handle AJAX route request
if (isset($_GET['ajax'])) {
    $page = $_GET['page'] ?? 'dashboard';
    $whitelist = ['dashboard', 'invoice', 'analytics', 'form', 'home', 'projects', 'about', 'contact', 'invoiceReport', 'updateProduct'];
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
<style>
    .navbar-blur {
        backdrop-filter: blur(12px);
    }

    .search-focus {
        transform: scale(1.02);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    }

    .mobile-menu-enter {
        transform: translateX(-100%);
        transition: transform 0.3s ease-in-out;
    }

    .mobile-menu-enter-active {
        transform: translateX(0);
    }

    .cart-bounce {
        animation: bounce 0.5s;
    }

    @keyframes bounce {

        0%,
        20%,
        60%,
        100% {
            transform: translateY(0);
        }

        40% {
            transform: translateY(-10px);
        }

        80% {
            transform: translateY(-5px);
        }
    }

    .nav-link {
        position: relative;
        transition: all 0.3s ease;
    }

    .nav-link:hover::after {
        content: "";
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, #8b5cf6, #a855f7);
        border-radius: 1px;
    }

    .gradient-text {
        background: linear-gradient(135deg, #8b5cf6, #a855f7, #ec4899);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
</style>

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
        <a href="#" class="sidebar-link hover:bg-gray-700 flex items-center p-3" data-page="updateProduct">
            <i class="bi bi-box-arrow-left me-2"></i><span class="sidebar-text">LogOut</span>
        </a>
    </div>

    <!-- Mobile Toggle Button - Fixed positioning and visibility -->
    <button id="openSidebarBtn" onclick="toggleSidebar()"
        class="fixed text-gray-800 p-2 rounded-md z-80 md:hidden hover:bg-gray-100 transition-colors">
        <i class="bi bi-list text-xl"></i>
    </button>
    <!-- Main Content -->
    <div id="main-content" class="p-4 transition-all duration-300">
        <navigate class="sticky top-0 z-50 navbar-blur border-b border-gray-200/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <!-- Logo and Desktop Navigation -->
                    <div class="flex items-center space-x-8">
                    </div>
                    <?php
                    require_once('../admin/connections/admin_register.php');
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    $UserName = $_SESSION['UserName'] ?? '';
                    $profileImage = $_SESSION['profileImage'] ?? '';
                    ?>
                    <!-- Search and Actions -->
                    <div class="flex items-center space-x-4 align-item-end">
                        <!--profile user -->
                        <figure class="relative inline-block text-left">
                           <div class="flex items-center space-x-2 pr-4 border-gray-300 cursor-pointer"
                                onclick="toggleProfileDropdown()">
                               <!-- Profile Image -->
                               <div class="w-10 h-10 rounded-full overflow-hidden border border-gray-200 shadow-sm">
                                   <img src="/ETEC_FINAL/servers/assets/uploads/<?= htmlspecialchars($profileImage) ?>"
                                      alt="Profile" class="w-full h-full object-cover">
                               </div>
                               <!-- Username -->
                               <span class="text-gray-700 font-medium">
                                   <?= htmlspecialchars($UserName) ?>
                               </span>
                           </div>
                            <!-- Dropdown Menu -->
                            <?php
                            $connection = connection_database();
                            $Admin_id = $_SESSION['Admin_id']??'';
                            // echo $Admin_id;
                            $SelectId = " SELECT Admin_id FROM admin where Admin_id = '$Admin_id'";

                            $QueryId = $connection->query($SelectId);
                            if($QueryId){
                                $row = mysqli_fetch_assoc($QueryId);
                            ?>
                            <div id="profileDropdownMenu"
                                class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md  z-50">
                                <a href="/ETEC_FINAL/servers/admin/lockAccount.php?status=<?php echo $row['Admin_id'] ?>"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-400 fw-bold fst-italic">
                                    <i class="bi bi-lock me-2"></i>Lock Screen
                                </a>
                                <a type="button" onclick="openModal()" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-400 fw-bold fst-italic"><i class="bi bi-shuffle me-2"></i>ChanceProfile</a>
                                <a type="button" onclick="ModalLogOut()" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-100 fw-bold fst-italic">
                                    <i class="bi bi-box-arrow-right text-base"></i> Logout
                                </a>
                            </div>
                            <?php }?>
                        </figure>
                        <!-- Search Bar -->
                        <div class="relative hidden md:block w-80">
                            <input id="searchInput" type="text" placeholder="Search for products, brands..."
                                class="w-full pl-12 pr-4 py-3 bg-gray-100 border-0 rounded-full focus:outline-none focus:ring-2 focus:ring-purple-500 focus:bg-white transition-all duration-300 search-focus" />
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <i class="bi bi-search text-lg"></i>
                            </div>
                            <!-- <button
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 bg-purple-500 hover:bg-purple-600 text-white p-1.5 rounded-full transition-colors">
                                <i class="bi bi-arrow-right text-sm"></i>
                            </button> -->
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center space-x-2">
                            <!-- Mobile Search -->
                            <button class="md:hidden p-2 hover:bg-gray-100 rounded-full transition-colors"
                                onclick="toggleMobileSearch()">
                                <i class="bi bi-search text-lg text-gray-700"></i>
                            </button>

                            <!-- Wishlist -->
                            <button
                                class="sm:flex p-2 hover:bg-gray-100 rounded-full relative transition-colors group">
                                <i
                                    class="bi bi-heart text-lg text-gray-700 group-hover:text-red-500 transition-colors"></i>
                                <span
                                    class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
                            </button>
                            <!-- Shopping Cart -->
                            <button class="p-2 hover:bg-gray-100 rounded-full relative transition-colors group"
                                onclick="toggleCart()">
                                <i
                                    class="bi bi-bag text-lg text-gray-700 group-hover:text-purple-500 transition-colors"></i>
                                <span id="cartCount"
                                    class="absolute -top-1 -right-1 bg-purple-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">2</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Search Bar -->
            <div id="mobileSearch" class="hidden md:hidden px-4 pb-4">
                <div class="relative">
                    <input type="text" placeholder="Search products..."
                        class="w-full pl-12 pr-4 py-3 bg-gray-100 border-0 rounded-full focus:outline-none focus:ring-2 focus:ring-purple-500 focus:bg-white transition-all" />
                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                        <i class="bi bi-search text-lg"></i>
                    </div>
                </div>
            </div>
        </navigate>
        <div id="content" class="p-4">Loading...</div>
    </div>

    <script>
        // for dropdown screen
        function toggleProfileDropdown() {
            const menu = document.getElementById("profileDropdownMenu");
            menu.classList.toggle("hidden");
        }

        // Close the profile dropdown when clicking outside
        document.addEventListener("click", function (e) {
            const profileDropdown = document.getElementById("profileDropdownMenu");
            const isClickInside = e.target.closest("figure");

            if (!isClickInside && !e.target.closest("#profileDropdownMenu")) {
                profileDropdown?.classList.add("hidden");
            }
        });

        function toggleMobileSearch() {
            const mobileSearch = document.getElementById("mobileSearch");
            mobileSearch.classList.toggle("hidden");
        }
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


<!--modal for upload profile-->

<!-- Tailwind Modal -->
<div id="tailwindModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50">
    <!-- Modal Dialog -->
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
        <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
            <i class="bi bi-x-circle-fill text-2xl"></i>
        </button>

        <h2 class="text-lg font-bold mb-4">Change Your Profile</h2>

        <!-- Modal Body -->
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="profileImageUpload" class="block text-sm font-medium text-gray-700 mb-2">
                    Please Upload your profile
                </label>
                <input type="file" name="profileImage" id="profileImageUpload"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm">
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal()"
                    class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 flex items-center">
                    <i class="bi bi-x-circle me-2"></i> Cancel
                </button>
                <button type="submit" name="Confirm"
                    class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 flex items-center">
                    <i class="bi bi-check-circle me-2"></i> Confirm
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Tailwind Modal Script -->
<script>
    function openModal() {
        document.getElementById('tailwindModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('tailwindModal').classList.add('hidden');
    }
</script>

<!-- Modal for log out account admin-->
<div id="ModalLogOut" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50">
    <!-- Modal Dialog -->
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
        <button onclick="shutdownModal()" class="absolute top-0 right-1 text-gray-400 hover:text-gray-600">
            <i class="bi bi-x-circle-fill text-2xl"></i>
        </button>
        <h2 class="text-sm text-center fw-bold fst-italic mb-4 bg-red-100 text-red-300 rounded ">Are you sir ? Do you want to logOut account?</h2>
        <!-- Modal Body -->
            <!-- Modal Footer -->
            <div class="flex justify-center gap-2">
                <button type="button" onclick="shutdownModal()"
                    class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 flex items-center">
                    <i class="bi bi-x-circle me-2"></i> Cancel
                </button>
                <a href="http://localhost/ETEC_FINAL/servers/admin/logOut.php"
                    class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 flex items-center">
                    <i class="bi bi-check-circle me-2"></i> Confirm
                </a>
            </div>
    </div>
</div>

<!-- Tailwind Modal Script -->
<script>
    function ModalLogOut() {
        document.getElementById('ModalLogOut').classList.remove('hidden');
    }

    function shutdownModal() {
        document.getElementById('ModalLogOut').classList.add('hidden');
    }
</script>