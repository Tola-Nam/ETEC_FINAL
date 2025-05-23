<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="http://localhost/ETEC_FINAL/servers/admin/theam.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>

    <!-- From Universe.io by ahmed150up -->
    <div class="card">
        <div class="card-header">
            <div class="text-header">Register</div>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <?php include('../connections/admin_register.php') ?>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input required class="form-control" name="UserName" placeholder="Enter your username" id="username"
                        type="text">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-container">
                        <i class="fa fa-envelope icon"></i>
                        <input required class="form-control" name="Email" id="Email" type="email"
                            placeholder="Enter your email">
                    </div>
                </div>
                <!-- @input password -->
                <div class="form-group">
                    <label for="password">Password:</label>
                    <div class="input-container" style="position: relative;">
                        <input required class="form-control" pattern="[A-Za-z]{6,}" placeholder="Enter your password"
                            name="Password" id="password" type="password" style="padding-right: 40px;">
                        <i id="togglePassword" class="bi bi-eye-slash"
                            style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirm_pass">Confirm Password:</label>
                    <div class="input-container" style="position: relative;">
                        <input required class="form-control" pattern="[A-Za-z]{6,}" placeholder="Confirm your password"
                            name="ConfirmPassword" id="confirm_pass" type="password" style="padding-right: 40px;">
                        <i id="toggleConfirmPassword" class="bi bi-eye-slash"
                            style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;"></i>
                    </div>
                </div>



                <div class="form-check mb-2">
                    <label for="gender">Gender</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="Gender" id="male" value="Male" required>
                        <label class="form-check-label" for="male">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="Gender" id="female" value="Female">
                        <label class="form-check-label" for="female">Female</label>
                    </div>
                </div>

                <input type="submit" name="signup" class="btn" value="Signup">
                <p class="signup-link">
                    No account?
                    <a class="text" href="login.php" class="up">Sign in!</a>
                </p>
            </form>
        </div>
    </div>
</body>
<script src="http://localhost/ETEC_FINAL/servers/javascript/show_password.js"></script>

</html>