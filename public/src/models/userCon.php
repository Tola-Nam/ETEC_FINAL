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
            header('http://localhost/ETEC_FINAL/public/src/views/header.php');
            exit;
        } else {
            echo '<script>alert("Registration failed. Please try again.");</script>';
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
        $user->register();
    }
} catch (Exception $e) {
    header('Location: header.php');
}

?>