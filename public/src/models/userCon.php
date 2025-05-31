<?php
class User
{
    private $firstName, $lastName, $email, $phoneNumber, $password, $confirmPassword;

    public function __construct($firstName, $lastName, $email, $phoneNumber, $password, $confirmPassword)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
    }
    //? function for register account for contact for buying production
    public function register()
    {
        if ($this->password !== $this->confirmPassword) {
            echo '<script>alert("Passwords do not match.");</script>';
            return false;
        }

        if (strlen($this->password) < 8) {
            echo '<script>alert("Password must be at least 8 characters.");</script>';
            return false;
        }

        $conn = connection(); // make sure this function is included

        $passwordHash = password_hash($this->password, PASSWORD_DEFAULT); // best practice
        $query = "INSERT INTO `user`(`firstName`, `lastName`, `email`, `phoneNumber`, `password`)
                  VALUES ('$this->firstName','$this->lastName','$this->email','$this->phoneNumber','$passwordHash')";

        if ($conn->query($query)) {
            header('Location: http://localhost/ETEC_FINAL/public/src/views/index.php');
            exit;
        } else {
            echo '<script>alert("Registration failed. Please try again.");</script>';
        }
    }

    //! function for signin account if user have been signup account ready.

    public function signIn()
    {
        $conn = connection();
        if (!empty($this->email) || !empty($this->phoneNumber) || !empty($this->password)) {
            $passwordHash = password_hash($this->password, PASSWORD_DEFAULT); //~ best practice
            $selectQuery = " SELECT u.email,u.phoneNumber,u.password FROM user u
                 where (`email` = '$this->email' AND `phoneNumber` = '$this->phoneNumber' AND `password` = '$passwordHash')";

            if (!empty($conn->query($selectQuery))) {
                header('Location: http://localhost/ETEC_FINAL/public/src/views/index.php');
            }
        } else {
            echo '<script>alert("please fill in field correct!!")</script>';
        }
    }
}

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $phoneNumber = $_POST['phoneNumber'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        $user = new User($firstName, $lastName, $email, $phoneNumber, $password, $confirmPassword);
        if (isset($_POST['SignUp'])) {
            $user->register();
        } else {
            $user->signIn();
        }
    }
} catch (Exception $e) {
    header('Location: header.php');
}

?>