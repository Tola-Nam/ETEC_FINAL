<?php
require_once('../admin/connections/admin_register.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$UserName = $_SESSION['UserName'] ?? 'Guest';
$profileImage = $_SESSION['profileImage'] ?? 'defaultMale.png';
?>

<!-- Responsive Icon-Only Navbar -->
<navigate>
    <div class="container mx-auto px-4 flex flex-wrap items-center justify-between sticky-top">

        <!-- Right: Profile + Nav Links -->
        <div class="flex w-full justify-end lg:w-auto">
            <div class="flex items-center space-x-4 w-full lg:w-auto justify-end mt-2 lg:mt-0">

                <!-- Profile Section -->
                <figure>
                    <div class="flex items-center space-x-2 border-r pr-4 border-gray-300">
                        <!-- Profile Image -->
                        <a href="#" onclick="openModal()" class="cursor-pointer">
                            <img src="/ETEC_FINAL/servers/assets/uploads/<?= htmlspecialchars($profileImage) ?>"
                                alt="Profile" width="30" height="30"
                                class="rounded-full shadow-sm border border-gray-200">
                        </a>

                        <!-- Username - Hidden on mobile -->
                        <span class="font-semibold text-blue-600 sm:inline">
                            <?= htmlspecialchars($UserName) ?>
                    </div>
                </figure>
                <!-- Navigation Links -->
                <ul class="flex items-center space-x-4">
                    <!-- Home -->
                    <li>
                        <a href="#" class="flex flex-col items-center text-gray-700 hover:text-blue-600"
                            data-page="home">
                            <i class="bi bi-house-door-fill text-xl"></i>
                            <span class="text-xs mt-1 hidden md:inline">Home</span>
                        </a>
                    </li>
                    <!-- Projects -->
                    <li>
                        <a href="#" class="flex flex-col items-center text-gray-700 hover:text-blue-600"
                            data-page="projects">
                            <i class="bi bi-folder2-open text-xl"></i>
                            <span class="text-xs mt-1 hidden md:inline">Projects</span>
                        </a>
                    </li>
                    <!-- About -->
                    <li>
                        <a href="#" class="flex flex-col items-center text-gray-700 hover:text-blue-600"
                            data-page="about">
                            <i class="bi bi-person-lines-fill text-xl"></i>
                            <span class="text-xs mt-1 hidden md:inline">About</span>
                        </a>
                    </li>
                    <!-- Contact -->
                    <li>
                        <a href="#" class="flex flex-col items-center text-gray-700 hover:text-blue-600"
                            data-page="contact">
                            <i class="bi bi-envelope-fill text-xl"></i>
                            <span class="text-xs mt-1 hidden md:inline">Contact</span>
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</navigate>

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