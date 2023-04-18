<?php
require_once "config.php";


// check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // retrieve form data
  $username = $password = $quantity = $location= $category="";

  $username = $_POST["username"]; 
  $password = $_POST["password"];
  $quantity = $_POST["quantity"];
  $location = $_POST["location"];
  $category = $_POST["category"];
  
  // INSERT INTO customer_profile (username, password, quantity, location, category) VALUES (?, ?, ?, ?, ?)


  // prepare SQL statement
  $stmt = $conn->prepare("INSERT INTO customer  (username, password, quantity,location,category) VALUES (?, ?, ?,?,?)");

  // bind parameters to the statement
  $stmt->bind_param("sssss", $username, $password, $quantity,$location,$category);

  // execute the statement
  if ($stmt->execute() === TRUE) {
    header("Location:  payment proceed.html");
    exit;
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  // close statement
  $stmt->close();
}

// close database connection
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Product</title>
    <link rel = "icon" href = 
    "/Heading icon.png" 
           width="500" type = "image/x-icon"> 
    <link rel="stylesheet" href="register product .css">
</head>
<body>
    <span class="title">Book Product</span>

    <form class="form" action="" method="post">
        <label for="username" class="label">Username*</label>
        <input type="text" id="username" name="username" required="" class="input" autofocus placeholder="gaurav25
        ">

        <label for="password" class="label">Password*</label>
        <input type="password" id="password" name="password" required="" class="input"  autofocus placeholder="gaurav@25" 
        >

        <label for="quantity" class="label">quantity in litre*</label>
        <input type="text" id="username"  required="" class="input" autofocus placeholder="5" name="quantity">

        <label for="location" class="label">location/address*</label>
        <input type="text" id="username" required="" class="input" autofocus placeholder="gaurav25" name="location">

        <label for="category" class="label">category*</label>
        <input type="text" id="username" required="" class="input" autofocus placeholder="cow / buffalo" name="category">
       

        <button type="submit" class="submit">Register   &#10140</button>
      </form>
    
</body>
</html>