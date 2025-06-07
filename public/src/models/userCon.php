<?php
session_start();
require_once('../models/connection.php');

// Upload image function
function upload_product_thumbnail($source_file): string
{
    if (!isset($source_file['tmp_name']) || empty($source_file['tmp_name'])) {
        return ''; // No file uploaded
    }

    $filename = rand(0, 999999999) . date('YmdHis') . '.' . pathinfo($source_file['name'], PATHINFO_EXTENSION);
    $destination = __DIR__ . '/../../assets/images/' . $filename;

    if (move_uploaded_file($source_file['tmp_name'], $destination)) {
        return $filename;
    } else {
        throw new Exception("Image upload failed!");
    }
}

class User
{
    private $firstName, $lastName, $email, $phoneNumber, $password, $confirmPassword, $filename, $gender;

    public function __construct($firstName, $lastName, $email, $phoneNumber, $password, $confirmPassword = '', $filename = '', $gender = '')
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
        $this->filename = $filename;
        $this->gender = $gender;
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

        $conn = connection();
        $passwordHash = password_hash($this->password, PASSWORD_DEFAULT);
        // Check if email already exists
        $checkStmt = $conn->prepare("SELECT user_id FROM `user` WHERE email = ?");
        $checkStmt->bind_param("s", $this->email);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows > 0) {
            echo '<script>alert("Email already exists. Please use a different email.");</script>';
            return false;
        }

        $stmt = $conn->prepare("INSERT INTO `user`(`firstName`, `lastName`, `email`, `phoneNumber`, `password`, `gender`) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $this->firstName, $this->lastName, $this->email, $this->phoneNumber, $passwordHash, $this->gender);

        if ($stmt->execute()) {
            $user_id = $stmt->insert_id;
            if (!empty($this->filename)) {
                $stmtImg = $conn->prepare("INSERT INTO `profile`(`user_id`, `profileImage`) VALUES (?, ?)");
                $stmtImg->bind_param("is", $user_id, $this->filename);
                $stmtImg->execute();
            }

            header('Location: http://localhost/ETEC_FINAL/public/src/views/index.php');
            exit;
        } else {
            echo '<script>alert("Registration failed. Please try again.");</script>';
            return false;
        }
    }

public function signIn()
{
    $conn = connection();

    if (!empty($this->email) && !empty($this->phoneNumber) && !empty($this->password)) {
        // Fetch user by email and phone only
        $stmt = $conn->prepare("SELECT user_id, email, phoneNumber, password FROM user WHERE email = ? AND phoneNumber = ?");
        $stmt->bind_param("ss", $this->email, $this->phoneNumber);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $user_data = $result->fetch_assoc();

            // ✅ Correct password check
            if (password_verify($this->password, $user_data['password'])) {
                $_SESSION['user_id'] = $user_data['user_id'];
                $user_id = $user_data['user_id'];

                // Get profile and user info
                $stmtProfile = $conn->prepare("
                    SELECT user.gender,user.firstName,user.lastName,profile.profileImage
                    FROM user
                    LEFT JOIN profile ON user.user_id = profile.user_id
                    WHERE user.user_id = ?
                    ORDER BY profile.upload_at DESC
                    LIMIT 1
                ");
                $stmtProfile->bind_param("i", $user_id);
                $stmtProfile->execute();
                $resultProfile = $stmtProfile->get_result();

                if ($resultProfile && $resultProfile->num_rows > 0) {
                    $row = $resultProfile->fetch_assoc();
                    $profile = $row['profileImage'] ?? ($row['gender'] === 'Male' ? "profileMale.png" : "profileFemale.png");

                    $_SESSION['firstName'] = $row['firstName'];
                    $_SESSION['lastName'] = $row['lastName'];
                    $_SESSION['profileImage'] = $profile;
                } else {
                    // Fallback if profile image is missing
                    $stmtUser = $conn->prepare("SELECT firstName, lastName, gender FROM user WHERE user_id = ?");
                    $stmtUser->bind_param("i", $user_id);
                    $stmtUser->execute();
                    $resultUser = $stmtUser->get_result();

                    if ($resultUser && $resultUser->num_rows > 0) {
                        $userData = $resultUser->fetch_assoc();
                        $_SESSION['firstName'] = $userData['firstName'];
                        $_SESSION['lastName'] = $userData['lastName'];
                        $_SESSION['profileImage'] = ($userData['gender'] === 'Male' ? "profileMale.png" : "profileFemale.png");
                    }
                }
                header("Location: http://localhost/ETEC_FINAL/public/src/views/index.php");
                exit;
            } else {
                echo "<script>alert('Incorrect password!');</script>";
            }
        } else {
            echo "<script>alert('User not found!');</script>";
        }
    } else {
        echo '<script>alert("Please fill in all fields!");</script>';
    }
}
}

// Handle POST request
try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['Register'])) {
            // Registration logic
            $firstName = $_POST['firstName'] ?? '';
            $lastName = $_POST['lastName'] ?? '';
            $email = $_POST['email'] ?? '';
            $phoneNumber = $_POST['phoneNumber'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirmPassword'] ?? '';
            $gender = $_POST['gender'] ?? '';
            $filename = '';

            if (!empty($_FILES['profileImage']['name'])) {
                $filename = upload_product_thumbnail($_FILES['profileImage']);
            }

            $user = new User($firstName, $lastName, $email, $phoneNumber, $password, $confirmPassword, $filename, $gender);
            $user->register();
        } else {
            // Sign-in logic
            $email = $_POST['email'] ?? '';
            $phoneNumber = $_POST['phoneNumber'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = new User('', '', $email, $phoneNumber, $password);
            $user->signIn();
        }
    }
} catch (Exception $e) {
    echo "<script>alert('An error occurred: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "');</script>";
}
?>