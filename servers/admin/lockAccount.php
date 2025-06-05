<?php
session_start();
require_once('../admin/connections/connection_database.php');
$connection = connection_database();

$status = $_GET['status'] ?? $_POST['status'] ?? '';
$displayName = 'Admin';
$displayImage = 'profileMale.png';

// Initialize profile data when page loads (before form submission)
if (!empty($status)) {
    // Fetch profile info for display
    $stmt = $connection->prepare("
        SELECT admin.UserName, admin.Gender, profile.profileImage, admin.Admin_id
        FROM admin
        LEFT JOIN profile ON admin.Admin_id = profile.Admin_id
        WHERE admin.Admin_id = ?
        ORDER BY profile.upload_at DESC
        LIMIT 1");
    $stmt->bind_param("s", $status);
    $stmt->execute();
    $profileResult = $stmt->get_result();

    if ($profileResult && $profileResult->num_rows > 0) {
        $profileData = $profileResult->fetch_assoc();
        $displayName = $profileData['UserName'] ?? 'Admin';

        // Check if user has uploaded profile image
        if (!empty($profileData['profileImage'])) {
            $displayImage = $profileData['profileImage'];
        } else {
            // Use default image based on gender
            $displayImage = ($profileData['Gender'] === 'Female') ? 'profileFemale.png' : 'profileMale.png';
        }
    }
    $stmt->close();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['Password'];

    // Check user credentials
    $stmt = $connection->prepare("SELECT Admin_id, UserName, Password, Gender FROM admin WHERE Admin_id = ?");
    $stmt->bind_param("s", $status);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password (assuming plain text comparison for now)
        // For better security, use password_verify() with hashed passwords
        if ($password == $user['Password']) {

            // Get the latest profile image for this user
            $stmt2 = $connection->prepare("
                SELECT profileImage
                FROM profile
                WHERE Admin_id = ?
                ORDER BY upload_at DESC
                LIMIT 1");
            $stmt2->bind_param("s", $status);
            $stmt2->execute();
            $profileResult = $stmt2->get_result();

            $userProfileImage = '';
            if ($profileResult && $profileResult->num_rows > 0) {
                $profileRow = $profileResult->fetch_assoc();
                $userProfileImage = $profileRow['profileImage'];
            }

            // Set session variables
            $_SESSION['Admin_id'] = $user['Admin_id'];
            $_SESSION['UserName'] = $user['UserName'];
            $_SESSION['Gender'] = $user['Gender'];

            // Set profile image in session
            if (!empty($userProfileImage)) {
                $_SESSION['profileImage'] = $userProfileImage;
            } else {
                $_SESSION['profileImage'] = ($user['Gender'] === 'Female') ? 'profileFemale.png' : 'profileMale.png';
            }

            $stmt2->close();

            // Redirect to dashboard
            header("Location: /ETEC_FINAL/servers/include/header.php");
            exit;
        } else {
            echo "<script>alert('Incorrect password!');</script>";
        }
    } else {
        echo "<script>alert('User not found!');</script>";
    }
    $stmt->close();
} else {
    echo '<script>alert("no session for sign up!!");</script>';
}

$connection->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Apsara Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        .gradient-text {
            background: linear-gradient(135deg, #8b5cf6, #a855f7, #ec4899);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .profile-avatar {
            transition: transform 0.3s ease;
        }

        .profile-avatar:hover {
            transform: scale(1.05);
        }

        .login-form {
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="h-screen bg-gray-50 flex">
    <!-- Left Side -->
    <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 lg:px-16">
        <div class="max-w-md mx-auto w-full login-form">
            <!-- Logo -->
            <div class="flex items-center space-x-2 mb-6">
                <div
                    class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center">
                    <i class="bi bi-bag-fill text-white text-sm"></i>
                </div>
                <div class="text-2xl font-bold gradient-text">Apsara Style</div>
            </div>

            <!-- Avatar & Greeting -->
            <div class="text-center mb-8">
                <div
                    class="w-20 h-20 mx-auto mb-4 rounded-full overflow-hidden border-4 border-gray-200 profile-avatar">
                    <img src="/ETEC_FINAL/servers/assets/uploads/<?php echo htmlspecialchars($displayImage); ?>"
                        alt="Avatar" class="w-full h-full object-cover"
                        onerror="this.src='/ETEC_FINAL/servers/assets/uploads/profileMale.png'">
                </div>
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">Hi! <?php echo htmlspecialchars($displayName); ?>
                </h2>
                <p class="text-gray-600">Enter your password to access the admin panel.</p>
            </div>

            <!-- Form -->
            <form method="post" class="space-y-6">
                <input type="hidden" value="<?php echo htmlspecialchars($status); ?>">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <input type="password" name="Password" id="password" placeholder="Enter your password" required
                            class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                        <button type="button" onclick="togglePassword()"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                            <i id="toggleIcon" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" name="lockScreen"
                    class="w-full bg-blue-500 text-white py-3 rounded-lg font-medium hover:bg-blue-600 transition duration-200 flex items-center justify-center space-x-2 transform hover:scale-[1.02]">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Log In</span>
                </button>
            </form>

            <!-- Optional Social Login -->
            <div class="mt-8">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-gray-50 text-gray-500">Or sign in with</span>
                    </div>
                </div>

                <div class="mt-6 flex justify-center space-x-4">
                    <button
                        class="w-12 h-12 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition duration-200 hover:scale-110">
                        <i class="fab fa-facebook-f"></i>
                    </button>
                    <button
                        class="w-12 h-12 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition duration-200 hover:scale-110">
                        <i class="fab fa-google"></i>
                    </button>
                    <button
                        class="w-12 h-12 bg-blue-100 text-blue-400 rounded-lg hover:bg-blue-200 transition duration-200 hover:scale-110">
                        <i class="fab fa-twitter"></i>
                    </button>
                    <button
                        class="w-12 h-12 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition duration-200 hover:scale-110">
                        <i class="fab fa-github"></i>
                    </button>
                </div>
            </div>

            <div class="mt-8 text-center">
                <p class="text-gray-600">
                    Don't have an account?
                    <a href="/ETEC_FINAL/servers/admin/authentication/register.php"
                        class="text-blue-500 hover:text-blue-600 font-medium transition duration-200">Sign up</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Right Side -->
    <div class="hidden lg:block lg:w-1/2 relative">
        <div class="h-full bg-gradient-to-br from-blue-900 via-blue-800 to-purple-900 relative overflow-hidden">
            <div class="absolute inset-0 bg-cover bg-center opacity-90"
                style="background-image: url('https://thumbs.wbm.im/pw/small/45f46927857a31d4413c3f3e933cf4b9.png');">
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-black/20"></div>
            <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-black/50 to-transparent"></div>

            <!-- Floating Elements -->
            <div class="absolute top-20 right-20 w-32 h-32 rounded-full bg-white/5 backdrop-blur-sm animate-pulse"></div>
            <div class="absolute bottom-40 left-20 w-24 h-24 rounded-full bg-white/5 backdrop-blur-sm animate-pulse delay-1000"></div>
            <div class="absolute top-1/2 left-10 w-16 h-16 rounded-full bg-white/5 backdrop-blur-sm animate-pulse delay-500"></div>

            <!-- Content Overlay -->
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="text-center text-white">
                    <h3 class="text-4xl font-bold mb-4">Welcome Back!</h3>
                    <p class="text-xl opacity-90">Manage your Apsara Style admin panel</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Add loading state to login button
        document.querySelector('form').addEventListener('submit', function () {
            const button = document.querySelector('button[name="lockScreen"]');
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>Logging in...</span>';
            button.disabled = true;
        });
    </script>
</body>

</html>