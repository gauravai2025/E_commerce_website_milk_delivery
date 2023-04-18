<?php
session_start();

// check if the user is already logged in
if(isset($_SESSION['username']))
{
    header("location: /WEB PROJECT/welcome.php");
    exit;
}
require_once "config.php";

$username = $password = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter username + password";
    }
    else{
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    }


if(empty($err))
{
    $sql = "SELECT username, password FROM user WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_username);
    $param_username = $username;
    
    
    // Try to execute this statement
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(password_verify($password, $hashed_password))
                        {
                            // this means the password is corrct. Allow user to login
                            session_start();
                            $_SESSION["username"] = $username;
                            $_SESSION["loggedin"] = true;

                            //Redirect user to welcome page
                            header("location: /WEB PROJECT/welcome.php");
                            
                        }
                    }

                }

    }
}    


}


?>

<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Login </title>
    <link rel="shortcut icon" href="/assets/favicon.ico">
    <link rel="stylesheet" href="login.css">
    <link rel = "icon" href = 
          "/Heading icon.png" 
                 width="500" type = "image/x-icon">
</head>
<body>
    
    <div class="container">
        <form class="form" id="login" action="" method="post">
            <h2 class="dukaan">Meri Dukaan</h2>
            <img src="profile icon.png" alt="" class="profile
        ">
        <h3 class="form__title">Login</h3>

            <div class="form__message form__message--error"></div>
            <div class="form__input-group">
                <input type="text" class="form__input" autofocus placeholder="username" name="username">
                <div class="form__input-error-message"></div>
            </div>

            <div class="form__input-group">
                <input type="password" class="form__input" autofocus placeholder="Password" name="password">
                <div class="form__input-error-message"></div>
            </div>
            <button class="form__button" type="submit">Continue</button>
            <p class="form__text">
                <a href="#" class="form__link">Forgot your password?</a>
                </p>
            
            <!-- <p class="form__text">
                 <a class="form__link" href="/register.html" id="linkCreateAccount">Don't have an account? Create account</a> -->
                 <a href="/WEB PROJECT/register.php" class="account">Don't have an account? Create account</a>
            
        </form> 
    </div>
    <script src="login.js"></script>
</body>