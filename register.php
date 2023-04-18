<?php
require_once "config.php";

$username = $password = $confirm_password = $email= $mobile="";
$username_err = $password_err = $confirm_password_err = $email_err= $mobile_err="";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Username cannot be blank";
    }
    else{
        $sql = "SELECT username FROM user WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set the value of param username
            $param_username = trim($_POST['username']);

            // Try to execute this statement
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $username_err = "This username is already taken"; 
                }
                else{
                    $username = trim($_POST['username']);
                }
            }
            else{
                echo "Something went wrong";
            }
        }
    }

    // mysqli_stmt_close($stmt);


// Check for password
if(empty(trim($_POST['password']))){
    $password_err = "Password cannot be blank";
}
elseif(strlen(trim($_POST['password'])) < 5){
    $password_err = "Password cannot be less than 5 characters";
}
else{
    $password = trim($_POST['password']);
}

// Check for confirm password field
if(trim($_POST['password']) !=  trim($_POST['confirm_password'])){
    $password_err = "Passwords should match";
}

    // Check if mobile number is empty
    if(empty(trim($_POST["mobile"]))){
        $mobile_err = "mobile number cannot be blank";
    }
    else{
        $sql = "SELECT username FROM user WHERE mobile = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", $param_mobile);

            // Set the value of param username
            $param_mobile = trim($_POST['mobile']);

            // Try to execute this statement
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $mobile_err = "This mobile number is already taken"; 
                }
                else{
                    $mobile = trim($_POST['mobile']);
                }
            }
            else{
                echo "Something went wrong";
            }
        }
    }

    // mysqli_stmt_close($stmt);



// check for email 

if(empty(trim($_POST["mobile"]))){
    $mobile_err = "email address cannot be blank";
}
else{
    $sql = "SELECT username FROM user WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if($stmt)
    {
        mysqli_stmt_bind_param($stmt, "s", $param_email);

        // Set the value of param username
        $param_email = trim($_POST['email']);

        // Try to execute this statement
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 1)
            {
                $mobile_err = "This email address is already taken"; 
            }
            else{
                $email = trim($_POST['email']);
            }
        }
        else{
            echo "Something went wrong";
        }
    }
}

// mysqli_stmt_close($stmt);


// If there were no errors, go ahead and insert into the database
if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($mobile_err) && empty($email_err))
{
    $sql = "INSERT INTO user (username,email,mobile, password) VALUES (?, ?,?,?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, "ssss" ,$param_username, $param_email,$param_mobile,$param_password);

        // Set these parameters
        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT);
        $param_mobile=$mobile;
        $param_email=$email;

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {
            header("location: /WEB PROJECT/login.php");
        }
        else{
            echo "Something went wrong... cannot redirect!";
        }
    }
}
    mysqli_stmt_close($stmt);


mysqli_close($conn);
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <title>register your Account</title>
    <link rel = "icon" href = 
    "/Heading icon.png" 
     width="500" type = "image/x-icon">  
</head>
<body>
    <div class="container">  
     <form class="form " id="createAccount" action="" method="post"> 
            <h2 class="dukaan">Meri Dukaan</h2>
            <img src="profile icon.png" alt="" class="profile
            ">
            <h3 class="form__title">Create Account</h3>
             <div class="form__message form__message--error"></div>

            <div class="form__input-group">
                <input type="text" id="signupUsername" class="form__input" autofocus placeholder="Username"   name="username">
                <div class="form__input-error-message"></div>
            </div>
            
            <div class="form__input-group">
                <input type="text" class="form__input" autofocus placeholder="Email Address" name="email">
                <div class="form__input-error-message"></div>
            </div>

            <div class="form__input-group">
                <input type="password" class="form__input" autofocus placeholder="mobile number"  name="mobile">
                <div class="form__input-error-message"></div>
            </div>
          
            <div class="form__input-group">
                <input type="password" class="form__input" autofocus placeholder="Password"  name="password">
                <div class="form__input-error-message"></div>
            </div>
              
            <div class="form__input-group">
                <input type="password" class="form__input" autofocus placeholder="confirm password"  name="confirm password">
                <div class="form__input-error-message"></div>
            </div>
            <button type="submit" class="button1"  >Submit</button>
           </form>
           </div>

           <!-- <input type="submit" onClick="myFunction()" value="Submit" class="button1" />
        -->
    <!-- <script>
      function myFunction() {
        window.location.href = "otp.html";
      }
    </script>   -->
</body>
</html>