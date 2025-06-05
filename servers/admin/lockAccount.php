<?php
session_start();
require_once('../admin/connections/connection_database.php');
$connection = connection_database();

$status = $_GET['status'] ?? $_POST['status'] ?? '';
$displayName = 'Admin';
$displayImage = 'profileMale.png';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lockScreen'])) {
  $password = $_POST['password'];

  // Check user credentials
  $stmt = $connection->prepare("SELECT * FROM admin WHERE Admin_id = ? AND Password = ?");
  $stmt->bind_param("ss", $status, $password);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
    // if (password_verify($password, $user['Password'])) {
    // Fetch profile info
    $stmt2 = $connection->prepare("
        SELECT admin.UserName, admin.Gender, profile.profileImage
        FROM admin
        LEFT JOIN profile ON admin.Admin_id = profile.Admin_id
        WHERE admin.Admin_id = ?
        ORDER BY profile.upload_at DESC
        LIMIT 1");
    $stmt2->bind_param("s", $status);
    $stmt2->execute();
    $profileResult = $stmt2->get_result();

    if ($profileResult && $profileResult->num_rows > 0) {
      $row = $profileResult->fetch_assoc();
      $displayName = $row['UserName'] ?? 'Admin';
      $displayImage = $row['profileImage'] ?? ($row['Gender'] === 'Female' ? 'profileFemale.png' : 'profileMale.png');
    }

    // $displayName = $_SESSION['UserName'];
    $displayName = $row['UserName'] ?? 'Admin';

    $displayImage = $_SESSION['profileImage'];

    header("Location: /ETEC_FINAL/servers/include/header.php");
    exit;
  } else {
    echo "<script>alert('Incorrect password!');</script>";
  }
}
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Apsara Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    .gradient-text {
      background: linear-gradient(135deg, #8b5cf6, #a855f7, #ec4899);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
  </style>
</head>

<body class="h-screen bg-gray-50 flex">
  <!-- Left Side -->
  <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 lg:px-16">
    <div class="max-w-md mx-auto w-full">
      <!-- Logo -->
      <div class="flex items-center space-x-2 mb-6">
        <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center">
          <i class="bi bi-bag-fill text-white text-sm"></i>
        </div>
        <div class="text-2xl font-bold gradient-text">Apsara Style</div>
      </div>

      <!-- Avatar & Greeting -->
      <div class="text-center mb-8">
        <div class="w-20 h-20 mx-auto mb-4 rounded-full overflow-hidden border-4 border-gray-200">
          <img src="/ETEC_FINAL/servers/assets/uploads/<?php echo htmlspecialchars($displayImage); ?>" alt="Avatar"
            class="w-full h-full object-cover">
        </div>
        <h2 class="text-2xl font-semibold text-gray-800 mb-2">Hi ! <?php echo htmlspecialchars($displayName); ?></h2>
        <p class="text-gray-600">Enter your password to access the admin panel.</p>
      </div>

      <!-- Form -->
      <form method="POST" class="space-y-6">
        <input type="hidden" name="status" value="<?php echo htmlspecialchars($status); ?>">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
          <input type="password" name="password" placeholder="Enter your password" required
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>
        <button type="submit" name="lockScreen"
          class="w-full bg-blue-500 text-white py-3 rounded-lg font-medium hover:bg-blue-600 flex items-center justify-center space-x-2">
          <i class="fas fa-sign-in-alt"></i><span>Log In</span>
        </button>
      </form>

      <!-- Optional Social Login -->
      <div class="mt-8">
        <p class="text-center text-gray-600 mb-4">Sign in with</p>
        <div class="flex justify-center space-x-4">
          <button class="w-12 h-12 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200"><i
              class="fab fa-facebook-f"></i></button>
          <button class="w-12 h-12 bg-red-100 text-red-600 rounded-lg hover:bg-red-200"><i
              class="fab fa-google"></i></button>
          <button class="w-12 h-12 bg-blue-100 text-blue-400 rounded-lg hover:bg-blue-200"><i
              class="fab fa-twitter"></i></button>
          <button class="w-12 h-12 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200"><i
              class="fab fa-github"></i></button>
        </div>
      </div>

      <div class="mt-8 text-center">
        <p class="text-gray-600">
          Don't have an account?
          <a href="/ETEC_FINAL/servers/admin/authentication/register.php"
            class="text-blue-500 hover:text-blue-600 font-medium">Sign up</a>
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
      <div class="absolute top-20 right-20 w-32 h-32 rounded-full bg-white/5 backdrop-blur-sm"></div>
      <div class="absolute bottom-40 left-20 w-24 h-24 rounded-full bg-white/5 backdrop-blur-sm"></div>
    </div>
  </div>
</body>

</html>