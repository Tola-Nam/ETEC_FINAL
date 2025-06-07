<?php
include(__DIR__ . '/connection_database.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class Admin_register
{
    protected $UserName;
    protected $Email;
    protected $Password;
    protected $ConfirmPassword;
    protected $Gender;

    public function __construct($UserName, $Email, $Password, $ConfirmPassword, $Gender)
    {
        $this->UserName = $UserName;
        $this->Email = $Email;
        $this->Password = $Password;
        $this->ConfirmPassword = $ConfirmPassword;
        $this->Gender = $Gender;
    }

    public function register_account_admin()
    {
        try {
            if (empty($this->UserName) || empty($this->Email) || empty($this->Password) || empty($this->ConfirmPassword) || empty($this->Gender)) {
                throw new Exception("All fields must be filled out.");
            }

            if ($this->Password !== $this->ConfirmPassword || strlen($this->Password) < 8) {
                throw new Exception("Password does not match or is too short.");
            }

            $conn = connection_database();
            $insert_query = "INSERT INTO `admin` (`UserName`,`Email`,`Password`,`Gender`) 
                             VALUES ('$this->UserName','$this->Email','$this->Password','$this->Gender')";
            $result = $conn->query($insert_query);

            if (!$result) {
                throw new Exception("Failed to register. Possibly duplicate email.");
            }

            header('Location: http://localhost/ETEC_FINAL/servers/include/header.php?message=success');
            exit;
        } catch (Exception $e) {
            header('Location: register.php?status=fail&error=' . urlencode($e->getMessage()));
            exit;
        }
    }
}

class admin_signin_account extends Admin_register
{
    private $UserName_Email;
    private $filename;
    private $Admin_id;

    public function __construct($UserName, $Email, $Password, $ConfirmPassword, $Gender, $UserName_Email, $filename = null, $Admin_id = null)
    {
        parent::__construct($UserName, $Email, $Password, $ConfirmPassword, $Gender);
        $this->UserName_Email = $UserName_Email;
        $this->filename = $filename;
        $this->Admin_id = $Admin_id;
    }

    public function file_uploader($sourcefile): string
    {
        $filename = rand(0, 999999999) . date('YmdHis') . '.' . pathinfo($sourcefile['name'], PATHINFO_EXTENSION);
        $destination = __DIR__ . '/../assets/uploads/' . $filename;

        if (move_uploaded_file(from: $sourcefile['tmp_name'], to: $destination)) {
            return $filename;
        } else {
            throw new Exception("Upload failed!");
        }
    }

    public function upload_profile(): void
    {
        if ($this->filename && $this->Admin_id) {
            $conn = connection_database();
            $insertDB = "INSERT INTO `profile` (`profileImage`, `Admin_id`) 
                         VALUES ('$this->filename', '$this->Admin_id')";
            $result = $conn->query($insertDB);

            if (isset($result)) {
                // $data = mysqli_fetch_assoc($result);
                header('Location: http://localhost/ETEC_FINAL/servers/include/header.php');
            }
        } else {
            echo '<script>alert("Upload fail!!"); window.location.href="upload.php";</script>';
        }
    }

    public function login_admin_account()
    {
        try {
            if (empty($this->UserName_Email) || empty($this->Password)) {
                throw new Exception("Username/email and password are required.");
            }

            $conn = connection_database();
            $selectQuery = "SELECT * FROM `admin` 
                            WHERE (`UserName` = '$this->UserName_Email' OR `Email` = '$this->UserName_Email') 
                            AND `Password` = '$this->Password'";
            $result = $conn->query($selectQuery);

            if ($result && $result->num_rows > 0) {
                $admin_data = mysqli_fetch_assoc($result);
                $_SESSION['Admin_id'] = $admin_data['Admin_id'];
                $this->Admin_id = $admin_data['Admin_id'];

                // Load profile image if exists
                $UserIcons = "SELECT admin.Gender, admin.UserName, profile.profileImage
                              FROM admin 
                              LEFT JOIN profile ON admin.Admin_id = profile.Admin_id 
                              WHERE admin.Admin_id = '{$this->Admin_id}'  
                              ORDER BY profile.upload_at DESC 
                              LIMIT 1";

                $QueryImage = $conn->query($UserIcons);
                if ($QueryImage && $QueryImage->num_rows > 0) {
                    $row = mysqli_fetch_assoc($QueryImage);
                    $profile = $row['profileImage'] ?? ($row['Gender'] === 'Male' ? "profileMale.png" : "profileFemale.png");
                    // ✅ Store these in session
                    $_SESSION['UserName'] = $row['UserName'];
                    $_SESSION['profileImage'] = $profile;
                } else {
                    $_SESSION['profileImage'] = "profileMale.png";
                }
                header("Location: http://localhost/ETEC_FINAL/servers/include/header.php?message=success");
                exit;
            } else {
                throw new Exception("Sign in not found!");
            }

        } catch (Exception $e) {
            error_log("Login error: " . $e->getMessage());
            header("Location: login.php?status=fail");
            exit;
        }
    }
}

// ---------- PROCESSING FORM SUBMISSION ----------

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $UserName = $_POST['UserName'] ?? '';
        $Email = $_POST['Email'] ?? '';
        $Password = $_POST['Password'] ?? '';
        $ConfirmPassword = $_POST['ConfirmPassword'] ?? '';
        $Gender = $_POST['Gender'] ?? '';
        $UserName_Email = $_POST['UserName_Email'] ?? '';
        $Admin_id = $_SESSION['Admin_id'] ?? null;

        $filename = null;
        if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] === UPLOAD_ERR_OK) {
            $temp = new admin_signin_account($UserName, $Email, $Password, $ConfirmPassword, $Gender, $UserName_Email);
            $filename = $temp->file_uploader($_FILES['profileImage']);
        }

        $admin_register = new admin_signin_account($UserName, $Email, $Password, $ConfirmPassword, $Gender, $UserName_Email, $filename, $Admin_id);

        if (isset($_POST['signup'])) {
            $admin_register->register_account_admin();
        } elseif (isset($_POST['signin'])) {
            $admin_register->login_admin_account();
        } elseif (isset($_POST['Confirm'])) {
            $admin_register->upload_profile();
        }
    }
} catch (Exception $e) {
    header('Location: register.php?status=fail&error=' . urlencode($e->getMessage()));
    exit;
}
?>