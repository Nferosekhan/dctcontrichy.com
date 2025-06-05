<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
session_start();
include '../connection.php';
if (isset($_POST['submit'])) {
	$username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
	$password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
	$query = $db->prepare("SELECT id FROM admins WHERE username = ? AND password = ?");
	$query->bind_param("ss", $username, $password);
	$query->execute();
	$results = $query->get_result();
	if($results->num_rows==1){
        $_SESSION['uname'] = $username;
		header("Location: dashboard.php");
	}
	else{
		header("Location: index.php?error=Invalid Login Credentials!");
	}
}
$response="";
if (isset($_GET['error'])) {
	$response='<div class="alert alert-danger" role="alert">'.$_GET['error'].'</div>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Arial', sans-serif;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 10px;
        }

        .login-card {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .login-card h2 {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
        }

        .form-control {
            border-radius: 5px;
            height: 45px;
            font-size: 16px;
        }

        .btn-login {
            width: 100%;
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
            font-weight: bold;
        }

        .alert {
            font-size: 14px;
        }

        .footer-text {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .footer-text a {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-card">
        <h2 class="text-center">Admin Login</h2>

        <!-- Displaying any errors -->
        <div><?=$response?></div>

        <form action="" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <button type="submit" name="submit" class="btn btn-info btn-login">Login</button>
        </form>
    </div>
</div>

<div class="footer-text">
    <p>&copy; <script>document.write(new Date().getFullYear())</script> DCTCON All rights reserved.</p>
</div>

</body>
</html>