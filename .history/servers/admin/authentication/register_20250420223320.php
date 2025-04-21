<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="http://localhost/ETEC_FINAL/servers/admin/theam.css">
</head>

<body>

    <!-- From Uiverse.io by ahmed150up -->
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
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input required class="form-control" placeholder="Enter your password" name="Password" id="password"
                        type="password">
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirm Password:</label>
                    <input required class="form-control" placeholder="Enter your confirm password"
                        name="ConfirmPassword" id="confirm-password" type="password">
                </div>

                <div class="form-check mb-2">
                    <label for="gender">Gender</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="Gender" id="male" value="Male" required>Male
                        <input class="form-check-input" type="radio" name="Gender" id="female" value="Female">Female
                    </div>
                </div>
                <input type="submit" name="signup" class="btn" value="Singup">
                <p class="signup-link">
                    No account?
                    <a class="text" href="login.php" class="up">Sign in!</a>
                </p>
            </form>
        </div>
    </div>
</body>

</html>