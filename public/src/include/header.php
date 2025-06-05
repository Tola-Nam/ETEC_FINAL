<?php require_once('../models/userCon.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zalando - Fashion Store</title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- link icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <!-- Swiper CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css">
</head>
<style>
  @import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap");

  body {
    font-family: "Inter", sans-serif;
  }

  .navbar-blur {
    backdrop-filter: blur(12px);
    background: rgba(255, 255, 255, 0.95);
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
  @keyframes fadeIn {
    from { opacity: 0; transform: scale(0.95); }
    to { opacity: 1; transform: scale(1); }
  }

  .animate-fadeIn {
    animation: fadeIn 0.3s ease-out;
  }

</style>

<body>
  <!-- Navbar -->
  <header class="sticky top-0 z-50 navbar-blur border-b border-gray-200/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <!-- Logo and Desktop Navigation -->
        <div class="flex items-center space-x-8">
          <!-- Logo -->
          <div class="flex items-center space-x-2">
            <div
              class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center">
              <i class="bi bi-bag-fill text-white text-sm"></i>
            </div>
            <div class="text-SM fw-bold fst-italic gradient-text">Apsara Style</div>
          </div>
          <!-- Desktop Navigation -->
          <nav class="hidden lg:flex space-x-8">
            <a href="#" data-list="orderCategory"
              class="nav-link text-gray-900 hover:text-purple-600 font-medium">Men</a>
            <a href="#" data-list="orderCategory"
              class="nav-link text-gray-900 hover:text-purple-600 font-medium">Women</a>
            <a href="#" data-list="orderCategory"
              class="nav-link text-gray-900 hover:text-purple-600 font-medium">Collections</a>
            <a href="#" data-list="orderCategory"
              class="nav-link text-gray-900 hover:text-purple-600 font-medium">Sale</a>
            <a href="#" data-list="orderCategory"
              class="nav-link text-gray-900 hover:text-purple-600 font-medium">Brands</a>
          </nav>
        </div>
        <!-- Search and Actions -->
        <div class="flex items-center space-x-4">
          <!-- Search Bar -->
          <div class="relative hidden md:block w-80">
            <input id="searchInput" type="text" placeholder="Search for products, brands..." onkeyup="search()"
              class="w-full pl-12 pr-4 py-3 bg-gray-100 border-0 rounded-full focus:outline-none focus:ring-2 focus:ring-purple-500 focus:bg-white transition-all duration-300 search-focus" />
            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
              <i class="bi bi-search text-lg"></i>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="flex items-center space-x-2">
            <!-- Mobile Search -->
            <button class="md:hidden p-2 hover:bg-gray-100 rounded-full transition-colors"
              onclick="toggleMobileSearch()">
              <i class="bi bi-search text-lg text-gray-700"></i>
            </button>

            <!-- Wishlist -->
            <button class=" sm:flex p-2 hover:bg-gray-100 rounded-full relative transition-colors group">
              <i class="bi bi-heart text-lg text-gray-700 group-hover:text-red-500 transition-colors"></i>
              <span
                class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
            </button>

            <!-- User Account -->
            <button class="p-2 hover:bg-gray-100 rounded-full transition-colors group" onclick="openModal()">
              <i class="bi bi-person text-lg text-gray-700 group-hover:text-purple-500 transition-colors"></i>
            </button>

            <!-- Shopping Cart -->
            <button class="p-2 hover:bg-gray-100 rounded-full relative transition-colors group" onclick="toggleCart()">
              <i class="bi bi-bag text-lg text-gray-700 group-hover:text-purple-500 transition-colors"></i>
              <span id="cartCount"
                class="absolute -top-1 -right-1 bg-purple-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">2</span>
            </button>
            <!-- Mobile Menu Button -->
            <button class="lg:hidden p-2 hover:bg-gray-100 rounded-full transition-colors" onclick="toggleMobileMenu()">
              <i id="menuIcon" class="bi bi-list text-lg text-gray-700"></i>
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
  </header>
  <!-- Mobile Menu Overlay -->
  <div id="mobileMenuOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"
    onclick="toggleMobileMenu()"></div>
  <!-- Mobile Menu -->
  <div id="mobileMenu"
    class="fixed top-0 left-0 w-80 h-full bg-white z-50 transform -translate-x-full transition-transform duration-300 lg:hidden shadow-2xl">
    <div class="flex flex-col h-full">
      <!-- Mobile Menu Header -->
      <div class="flex items-center justify-between p-6 border-b">
        <div class="flex items-center space-x-2">
          <div
            class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center">
            <i class="bi bi-bag-fill text-white text-sm"></i>
          </div>
          <div class="text-sm fw-bold fst-italic gradient-text">Apsara Style</div>
        </div>
        <button onclick="toggleMobileMenu()" class="p-2 hover:bg-gray-100 rounded-full">
          <i class="bi bi-x text-xl"></i>
        </button>
      </div>
      <!-- Mobile Navigation -->
      <nav class="flex-1 px-6 py-4">
        <div class="space-y-1">
          <a href="#"
            class="flex items-center px-4 py-3 text-gray-900 hover:bg-purple-50 hover:text-purple-600 rounded-lg transition-colors">
            <i class="bi bi-person-fill-gear mr-3"></i>Men's Fashion</a>
          <a href="#"
            class="flex items-center px-4 py-3 text-gray-900 hover:bg-purple-50 hover:text-purple-600 rounded-lg transition-colors">
            <i class="bi bi-heart-fill mr-3"></i>Women's Fashion</a>
          <a href="#"
            class="flex items-center px-4 py-3 text-gray-900 hover:bg-purple-50 hover:text-purple-600 rounded-lg transition-colors">
            <i class="bi bi-star-fill mr-3"></i>Collections</a>
          <a href="#"
            class="flex items-center px-4 py-3 text-gray-900 hover:bg-purple-50 hover:text-purple-600 rounded-lg transition-colors">
            <i class="bi bi-tag-fill mr-3"></i>Sale</a>
          <a href="#"
            class="flex items-center px-4 py-3 text-gray-900 hover:bg-purple-50 hover:text-purple-600 rounded-lg transition-colors">
            <i class="bi bi-award-fill mr-3"></i>Brands</a>
        </div>
      </nav>
    </div>
  </div>
  <!-- modal for sing up account user for contact our team work -->
  <div id="modal-signUp" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50">
    <!-- Modal Dialog -->
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
      <button id="close" onclick="closeModal()" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
        <i class="bi bi-x-circle-fill text-2xl"></i>
      </button>
      <!-- button for chance form sign in or sign up  -->
      <div class="flex justify-center gap-4 mb-6">
        <button id="btnLogin" class="font-semibold text-blue-600 hover:underline">Login</button>
        <button id="btnRegister" class="font-semibold text-gray-500 hover:underline">Register</button>
      </div>

      <!-- Sign In Form -->
      <form action="#" id="signIn" class="hidden" method="post" enctype="multipart/form-data">
        <h2 class="text-lg font-bold mb-4 text-gray-700">Login account</h2>
        <div class="mb-4">
          <!-- Email input -->
          <div class="mb-3">
            <label for="login-email" class="block text-sm font-medium text-gray-700 mb-2">
              Please enter your email
            </label>
            <input type="email" name="email" id="login-email" placeholder="Enter your email" required
              class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-purple-500">
          </div>
          <!-- phone number input -->
          <div class="mb-3">
            <label for="login-phone" class="block text-sm font-medium text-gray-700 mb-2">
              Please enter your phone number
            </label>
            <input type="tel" name="phoneNumber" id="login-phone" placeholder="Enter your phone number"
              class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-purple-500">
          </div>
          <!-- Password Input with Toggle -->
          <div class="relative w-full">
            <label for="login-password" class="block text-sm font-medium text-gray-700 mb-2">
              Please enter your password
            </label>
            <input type="password" name="password" id="login-password" placeholder="Enter your password"
              class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-purple-500" />
            <!-- Toggle Icon -->
            <button type="button" id="toggleLoginPassword"
              class="absolute top-[38px] right-3 text-gray-500 hover:text-gray-700">
              <i id="iconLoginPassword" class="bi bi-eye-slash"></i>
            </button>
          </div>
        </div>
        <!-- Modal Footer -->
        <div class="flex justify-end gap-2">
          <button type="button" onclick="closeModal()"
            class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 flex items-center">
            <i class="bi bi-x-circle me-2"></i> Cancel
          </button>
          <button type="submit" name="SignIn"
            class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 flex items-center">
            <i class="bi bi-check-circle me-2"></i> Login
          </button>
        </div>
      </form>

      <!-- Sign Up Form -->
      <form action="#" id="signUp" method="post" enctype="multipart/form-data">
        <h2 class="text-lg font-bold mb-4 text-gray-700">Register account</h2>
        <div class="mb-4">
          <!-- First name input -->
          <div class="flex gap-4 mb-3">
            <!-- First name input -->
            <div class="w-1/2">
              <label for="first-name" class="block text-sm font-medium text-gray-700 mb-2">Please enter your first
                name</label>
              <input type="text" name="firstName" id="first-name" placeholder="Enter your first name" required
                class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Last name input -->
            <div class="w-1/2">
              <label for="last-name" class="block text-sm font-medium text-gray-700 mb-2">Please enter your last
                name</label>
              <input type="text" name="lastName" id="last-name" placeholder="Enter your last name" required
                class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>
          </div>

          <!-- Email input -->
          <div class="mb-3">
            <label for="register-email" class="block text-sm font-medium text-gray-700 mb-2">
              Please enter your email
            </label>
            <input type="email" name="email" id="register-email" placeholder="Enter your email" required
              class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-purple-500">
          </div>

          <!-- phone number input -->
          <div class="mb-3">
            <label for="register-phone" class="block text-sm font-medium text-gray-700 mb-2">
              Please enter your phone number
            </label>
            <input type="tel" name="phoneNumber" id="register-phone" placeholder="Enter your phone number"
              class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-purple-500">
          </div>

          <!-- Password Input with Toggle -->
          <div class="relative w-full">
            <label for="register-password" class="block text-sm font-medium text-gray-700 mb-2">
              Please enter your password
            </label>
            <input type="password" name="password" id="register-password" placeholder="Enter your password"
              autocomplete="current-password"
              class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-purple-500" />

            <!-- Toggle Icon -->
            <button type="button" id="toggleRegisterPassword"
              class="absolute top-[38px] right-3 text-gray-500 hover:text-gray-700">
              <i id="iconRegisterPassword" class="bi bi-eye-slash"></i>
            </button>
          </div>
          <!--confirm Password Input with Toggle -->
          <div class="relative w-full">
            <label for="register-password" class="block text-sm font-medium text-gray-700 mb-2">
              Please enter your password
            </label>
            <input type="password" name="confirmPassword" id="register-password" placeholder="Enter your password"
              autocomplete="current-password"
              class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-purple-500" />

            <!-- Toggle Icon -->
            <button type="button" id="toggleRegisterPassword"
              class="absolute top-[38px] right-3 text-gray-500 hover:text-gray-700">
              <i id="iconRegisterPassword" class="bi bi-eye-slash"></i>
            </button>
          </div>
        </div>

        <!-- Modal Footer -->
        <div class="flex justify-end gap-2">
          <button type="button" onclick="closeModal()"
            class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 flex items-center">
            <i class="bi bi-x-circle me-2"></i> Cancel
          </button>
          <button type="submit" name="SignUp"
            class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 flex items-center">
            <i class="bi bi-check-circle me-2"></i> Register
          </button>
        </div>
      </form>
    </div>
  </div>
 <script>
        function search(){
            let fitter = document.getElementById('searchInput').values.toUppercase();
            let items = document.querySelectorAll('.product-card');
            let l = document.getElementsByTagName('h5');

            for( var i=0; i<= l.length; i++){
                let a=items[i].getElementsByTagName('h5')[0];
                let value = a.innHTML || a.innerText || a.textContent;

                if(value.toUppercase().indexOf(filter)>-1){
                    items[i].style.display = "";
                }else{
                    items['i'].style.display = "none";
                }
            }
        }
    </script>
  <script>
    // Mobile menu toggle
    function toggleMobileMenu() {
      const mobileMenu = document.getElementById("mobileMenu");
      const overlay = document.getElementById("mobileMenuOverlay");
      const menuIcon = document.getElementById("menuIcon");

      if (mobileMenu.classList.contains("-translate-x-full")) {
        mobileMenu.classList.remove("-translate-x-full");
        overlay.classList.remove("hidden");
        menuIcon.className = "bi bi-x text-lg text-gray-700";
        document.body.style.overflow = "hidden";
      } else {
        mobileMenu.classList.add("-translate-x-full");
        overlay.classList.add("hidden");
        menuIcon.className = "bi bi-list text-lg text-gray-700";
        document.body.style.overflow = "auto";
      }
    }
    // Mobile search toggle
    function toggleMobileSearch() {
      const mobileSearch = document.getElementById("mobileSearch");
      mobileSearch.classList.toggle("hidden");
    }
  </script>
  <script src="../controllers/headerFun.js"></script>