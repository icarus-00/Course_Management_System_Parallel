<?php
ob_start();
session_start();
$sessionUser = '';
if (isset($_SESSION['user'])) {

    header('Location: index.php');
}
include 'admin/init.php';
// Check If User Coming From HTTP Post Request

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['login'])) {

        $user = $_POST['username'];
        $pass = $_POST['password'];
        $hashedPass = sha1($pass);

        // Check If The User Exist In Database

        $stmt = $con->prepare("SELECT 
										UserID, Username, Password 
									FROM 
										users 
									WHERE 
										Username = ? 
									AND 
										Password = ?");

        $stmt->execute(array($user, $hashedPass));

        $get = $stmt->fetch();

        $count = $stmt->rowCount();

        // If Count > 0 This Mean The Database Contain Record About This Username

        if ($count > 0) {
            if ($get['Profile_pic'] =='') {
                $_SESSION['profilePic'] = "./assets/userImages/DefaultUser.png";
            }
            else 
            {
                $_SESSION['profilePic'] = $get['Profile_pic'];
            }

            $_SESSION['username'] = $user; // Register Session Name

            $_SESSION['user'] = $get['UserID']; // Register User ID in Session
            setcookie('user', $get['UserID'], time() + 60*60*24*30, '/');

            header('Location: index.php'); // Redirect To Dashboard Page

            exit();
        }

    } else {

        $formErrors = array();

        $username 	= $_POST['username'];
        $password 	= $_POST['password'];
        $email 		= $_POST['email'];

        if (isset($username)) {

            $filterdUser = filter_var($username, FILTER_SANITIZE_STRING);

            if (strlen($filterdUser) < 4) {

                $formErrors[] = 'Username Must Be Larger Than 4 Characters';

            }

        }

        if (isset($password) ) {

            if (empty($password)) {

                $formErrors[] = 'Sorry Password Cant Be Empty';

            }

        }

        if (isset($email)) {

            $filterdEmail = filter_var($email, FILTER_SANITIZE_EMAIL);

            if (filter_var($filterdEmail, FILTER_VALIDATE_EMAIL) != true) {

                $formErrors[] = 'This Email Is Not Valid';

            }

        }

        // Check If There's No Error Proceed The User Add

        if (empty($formErrors)) {

            // Check If User Exist in Database

            $check = checkItem("Username", "users", $username);

            if ($check == 1) {

                $formErrors[] = 'Sorry This User Is Exists';

            } else {

                // Insert Userinfo In Database

                $stmt = $con->prepare("INSERT INTO 
											users(Username, Password, Email, GroupID)
										VALUES(:zuser, :zpass, :zmail, 0)");
                $stmt->execute(array(

                    'zuser' => $username,
                    'zpass' => sha1($password),
                    'zmail' => $email
                ));

                // Echo Success Message

                $succesMsg = 'Congrats You Are Now Registerd User';
                header('location :index.php');

            }

        }

    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animated Login & Registration Form | Codehal</title>
    <link rel="stylesheet" type="text/css" href="layout/css/login.css">
</head>
<body>
<div class="wrapper">
    
    <div class="form-wrapper sign-in">
        <form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <div >
        <a href="index.php" style="font-family: monospace; text-decoration:none;  position: relative; top: 10px; left: 10px; font-family: monospace; background-color: antiquewhite; text-decoration: none; padding: 2px; border-radius: 10px; display: inline-block; width: 2em; height: 2em; font-size: 1em; text-justify: auto; text-align: center; align-content: center"  >x</a>
        </div>
        
            <h2>Login</h2>
            <div class="input-group">
                <input type="text" name="username" required>
                <label for="">Username</label>
            </div>
            <div class="input-group">
                <input type="password" name="password" required>
                <label for="">Password</label>
            </div>
            <div class="remember">
                <label><input type="checkbox"> Remember me</label>
            </div>
            <button type="submit" name="login">Login</button>
            <div class="signUp-link">
                <p>Don't have an account? <a href="Sign-up.php" class="signUpBtn-link">Sign Up</a></p>
            </div>
        </form>
    </div>

</div>
</div>
<script src="layout/js/login.js"></script>
</body>
</html>