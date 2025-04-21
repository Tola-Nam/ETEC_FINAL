<?php
include(__DIR__ . '/connectiondatabase.php');

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
                throw new ('All fields must be filled out.');
            }

            if ($this->Password != $this->ConfirmPassword || strlen($this->Password) < 8) {
                throw new ('Password does not match it');
            } else {
                $insert_query = "INSERT INTO `admin` (`UserName`,`Email`,`Password`,`Gender`)
                                    VALUES ('$this->UserName','$this->Email','$this->Password','$this->Gender');";

                try {
                    $Query = connectiondatabase()->query($insert_query);
                    if (!$Query) {
                        throw new Exception("Email already used!!! Please try another email");
                    }
                    header('Location: http://localhost/ETEC_FINAL/servers/include/header.php');
                } catch (Exception $e) {
                    header('Location: register.php?status=fail&error=Something went wrong.');
                }
            }
        } catch (Exception $e) {
            header('Location: register.php?status=fail&error=Something went wrong.');
            exit;
        }
    }

}
class admin_signin_account extends Admin_register
{
    private $UserName_Email;
    public function __construct($UserName, $Email, $Password, $ConfirmPassword, $Gender, $UserName_Email)
    {
        parent::__construct($UserName, $Email, $Password, $ConfirmPassword, $Gender);
        $this->UserName_Email = $UserName_Email;
    }

    public function login_admin_account()
    {
        session_start();
        // if (!empty($_SESSION['id'])) {
        //     header("Location: http://localhost/ETEC_FINAL/servers/include/header.php");
        // }
        try {
            if (empty($this->UserName_Email) || empty($this->Password)) {
                throw new Exception("Nothing: Username, email, and password are required.");
            } else {

                // if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $selectQuery = "SELECT * FROM `admin` WHERE(( `UserName` = '$this->UserName_Email' OR `Email` = '$this->UserName_Email' )
                            AND( `Password` = '$this->Password'));";
                try {
                    $result = connectiondatabase()->query($selectQuery);
                    if (empty($result)) {
                        throw new Exception("singin not found!!!");
                    } else {
                        $admin_id = mysqli_fetch_assoc($result);
                        if (!empty($admin_id)) {
                            $_SESSION['id'] = $admin_id['Admin_id'];
                            header("Location: http://localhost/ETEC_FINAL/servers/include/header.php?message=success");
                        } else {
                            header("Location: login.php?message=fail");
                        }
                    }

                } catch (Exception $e) {
                    header("Location: login.php?status=fail");
                    exit;
                }
            }
        } catch (Exception $E) {
            header('Location: login.php?status=fail');
            exit;
        }
    }
}

// }

try {

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $UserName = $_POST['UserName'] ?? '';
        $Email = $_POST['Email'] ?? '';
        $Password = $_POST['Password'] ?? '';
        $ConfirmPassword = $_POST['ConfirmPassword'] ?? '';
        $Gender = $_POST['Gender'] ?? '';
        $UserName_Email = $_POST['UserName_Email'] ?? '';
        if (!empty($_POST)) {

            $admin_register = new admin_singinaccount($UserName, $Email, $Password, $ConfirmPassword, $Gender, $UserName_Email);
        }
        if (isset($_POST['signup'])) {

            $admin_register->register_account_admin();
        } else {
            $admin_register->login_admin_account();
        }
    }
} catch (Exception $e) {
    // Catch any other general exceptions
    header('Location: register.php?status=fail');
    exit;
}
?>