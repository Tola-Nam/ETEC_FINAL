<?php require_once('../models/userCon.php'); ?>
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

<body>
    <header class="border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center space-x-8">
                    <div class="text-2xl font-bold text-gray-900">STORE</div>
                    <nav class="hidden md:flex space-x-8">
                        <a href="#" class="text-gray-900 hover:text-gray-600">Men</a>
                        <a href="#" class="text-gray-900 hover:text-gray-600">Women</a>
                        <a href="#" class="text-gray-900 hover:text-gray-600">Collections</a>
                        <a href="#" class="text-gray-900 hover:text-gray-600">Sale</a>
                    </nav>
                </div>
                <div class="flex items-center space-x-4 ">
                    <div class="relative w-full max-w-sm mx-auto mt-4">
                        <input id="searchInput" type="text" placeholder="Search..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500" />
                        <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                    <button id="modal-signup" onclick="openModal()" class="p-2 hover:bg-gray-100 rounded-full mt-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </button>
                    <button class="p-2 hover:bg-gray-100 rounded-full relative mt-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4m.6 5h10M7 13L5.4 5H3m4 8l-2.172 5.197a.25.25 0 00.172.303h12" />
                        </svg>
                        <span
                            class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">2</span>
                    </button>
                </div>
            </div>
        </div>
    </header>

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
                        <input type="tel" name="phone-number" id="login-phone" placeholder="Enter your phone number"
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
                    <button type="submit" name="Confirm"
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
                            <label for="first-name" class="block text-sm font-medium text-gray-700 mb-2">
                                Please enter your first name
                            </label>
                            <input type="text" name="firstName" id="first-name" placeholder="Enter your first name"
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-purple-500">
                        </div>

                        <!-- Last name input -->
                        <div class="w-1/2">
                            <label for="last-name" class="block text-sm font-medium text-gray-700 mb-2">
                                Please enter your last name
                            </label>
                            <input type="text" name="lastName" id="last-name" placeholder="Enter your last name"
                                required
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
                        <input type="password" name="confirmPassword" id="register-password"
                            placeholder="Enter your password" autocomplete="current-password"
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
                    <button type="submit" name="Confirm"
                        class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 flex items-center">
                        <i class="bi bi-check-circle me-2"></i> Register
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="../controllers/headerFun.js"></script>