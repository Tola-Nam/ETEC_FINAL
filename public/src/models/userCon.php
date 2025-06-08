<?php
session_start();
require_once('../models/connection.php');

function upload_product_thumbnail($source_file): string
{
    if (!isset($source_file['tmp_name']) || empty($source_file['tmp_name'])) {
        return '';
    }

    $filename = rand(0, 999999999) . date('YmdHis') . '.' . pathinfo($source_file['name'], PATHINFO_EXTENSION);
    $destinationDir = realpath(__DIR__ . '/../../assets/images') ?: (__DIR__ . '/../../assets/images');

    if (!file_exists($destinationDir)) {
        mkdir($destinationDir, 0777, true);
    }

    $destination = $destinationDir . DIRECTORY_SEPARATOR . $filename;

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

    // FIXED: Proper password hashing with salt
    private function passwordToHex($password, $salt = null): string
    {
        // Generate a random 32-character hex salt if not provided
        if ($salt === null) {
            $salt = bin2hex(random_bytes(16)); // 16 bytes = 32 hex characters
        }

        // Create salted password
        $saltedPassword = $password . $salt;

        // Hash the salted password using SHA-256
        $hashedPassword = hash('sha256', $saltedPassword);

        // Return salt + hashed password (both in hex format)
        return $salt . $hashedPassword;
    }

    // FIXED: Proper password verification
    private function verifyPassword($inputPassword, $storedHexPassword): bool
    {
        // Extract salt (first 32 hex characters)
        $salt = substr($storedHexPassword, 0, 32);

        // Extract stored hash (remaining characters after salt)
        $storedHash = substr($storedHexPassword, 32);

        // Create salted input password
        $saltedInputPassword = $inputPassword . $salt;

        // Hash the salted input password
        $inputHash = hash('sha256', $saltedInputPassword);

        // Compare hashes using timing-safe comparison
        return hash_equals($storedHash, $inputHash);
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
        $hexPassword = $this->passwordToHex($this->password);

        $checkStmt = $conn->prepare("SELECT user_id FROM `user` WHERE email = ?");
        $checkStmt->bind_param("s", $this->email);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows > 0) {
            echo '<script>alert("Email already exists.");</script>';
            return false;
        }

        $stmt = $conn->prepare("INSERT INTO `user`(`firstName`, `lastName`, `email`, `phoneNumber`, `password`, `gender`) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $this->firstName, $this->lastName, $this->email, $this->phoneNumber, $hexPassword, $this->gender);

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
            echo '<script>alert("Registration failed.");</script>';
            return false;
        }
    }

    public function signIn()
    {
        $conn = connection();

        if (!empty($this->email) && !empty($this->phoneNumber) && !empty($this->password)) {
            $stmt = $conn->prepare("SELECT user_id, email, phoneNumber, password FROM user WHERE email = ? AND phoneNumber = ?");
            $stmt->bind_param("ss", $this->email, $this->phoneNumber);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                $user_data = $result->fetch_assoc();

                if ($this->verifyPassword($this->password, $user_data['password'])) {
                    $_SESSION['user_id'] = $user_data['user_id'];
                    $user_id = $user_data['user_id'];

                    $stmtProfile = $conn->prepare("
                        SELECT user.gender, user.firstName, user.lastName, profile.profileImage
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
                    echo "<script>alert('Incorrect password.');</script>";
                }
            } else {
                echo "<script>alert('User not found.');</script>";
            }
        } else {
            echo '<script>alert("Please fill in all fields.");</script>';
        }
    }
}

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['Register'])) {
            $firstName = $_POST['firstName'] ?? '';
            $lastName = $_POST['lastName'] ?? '';
            $email = $_POST['email'] ?? '';
            $phoneNumber = $_POST['phoneNumber'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirmPassword'] ?? '';
            $gender = $_POST['gender'] ?? '';
            $filename = !empty($_FILES['profileImage']['name']) ? upload_product_thumbnail($_FILES['profileImage']) : '';

            $user = new User($firstName, $lastName, $email, $phoneNumber, $password, $confirmPassword, $filename, $gender);
            $user->register();
        } else {
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

// DEBUGGING FUNCTIONS - Remove these in production
function testPasswordFunctions() {
    echo "<h3>Password Function Tests</h3>";

    $testPassword = "mypassword123";

    // Test password hashing
    $salt = bin2hex(random_bytes(16));
    echo "<p><strong>Test Password:</strong> " . $testPassword . "</p>";
    echo "<p><strong>Generated Salt:</strong> " . $salt . "</p>";

    // Create User instance for testing
    $userTest = new User('', '', '', '', $testPassword);

    // Use reflection to access private methods for testing
    $reflection = new ReflectionClass($userTest);
    $passwordToHexMethod = $reflection->getMethod('passwordToHex');
    $passwordToHexMethod->setAccessible(true);
    $verifyPasswordMethod = $reflection->getMethod('verifyPassword');
    $verifyPasswordMethod->setAccessible(true);

    // Test hashing
    $hashedPassword = $passwordToHexMethod->invoke($userTest, $testPassword);
    echo "<p><strong>Hashed Password (Salt + Hash):</strong> " . $hashedPassword . "</p>";
    echo "<p><strong>Length:</strong> " . strlen($hashedPassword) . " characters</p>";

    // Extract parts
    $extractedSalt = substr($hashedPassword, 0, 32);
    $extractedHash = substr($hashedPassword, 32);
    echo "<p><strong>Extracted Salt:</strong> " . $extractedSalt . "</p>";
    echo "<p><strong>Extracted Hash:</strong> " . $extractedHash . "</p>";

    // Test verification with correct password
    $verificationResult = $verifyPasswordMethod->invoke($userTest, $testPassword, $hashedPassword);
    echo "<p><strong>Verification with correct password:</strong> " . ($verificationResult ? "SUCCESS" : "FAILED") . "</p>";

    // Test verification with wrong password
    $wrongVerification = $verifyPasswordMethod->invoke($userTest, "wrongpassword", $hashedPassword);
    echo "<p><strong>Verification with wrong password:</strong> " . ($wrongVerification ? "FAILED (should be false)" : "SUCCESS (correctly rejected)") . "</p>";
}

// Uncomment the line below to run tests
// testPasswordFunctions();
?>