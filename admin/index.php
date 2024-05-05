<?php
session_start();
if (isset($_SESSION['Admin'])) {
    header('Location: dashboard.php'); // Redirect To Dashboard Page
}

include 'init.php';

// Check If User Coming From HTTP Post Request

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['user'];
    $password = $_POST['pass'];
    $hashedPass = sha1($password);

    // Check If The User Exist In Database

    $stmt = $con->prepare("SELECT 
									UserID, Username, Password 
								FROM 
									users 
								WHERE 
									Username = ? 
								AND 
									Password = ? 
								AND 
									GroupID = 1
								LIMIT 1");

    $stmt->execute(array($username, $hashedPass));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();

    // If Count > 0 This Mean The Database Contain Record About This Username

    if ($count > 0) {
        $_SESSION['Admin'] = $username; // Register Session Name
        $_SESSION['ID'] = $row['UserID']; // Register Session ID
        header('Location: dashboard.php'); // Redirect To Dashboard Page
        exit();
    }

}
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Sign up / Login Form</title>
  <link rel="stylesheet" href="layout/css/login.css">

</head>
<body>
<!-- partial:index.partial.html -->
<!DOCTYPE html>
<html>
<head>
	<title>Slide Navbar</title>
	<link rel="stylesheet" type="text/css" href="slide navbar style.css">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body>
	<div class="main">

			<div class="login">
				<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
					<label style="color:  #302b63; font-family:serif;" aria-hidden="true">Admin Login</label>
					<input type="text" name="user" placeholder="Username" required="">
					<input type="password" name="pass" placeholder="Password" required="">
					<button >Login</button>
				</form>
			</div>
	</div>
</body>
</html>
<!-- partial -->

</body>
</html>
