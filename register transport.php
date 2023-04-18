
<?php
require_once "config.php";



// check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // retrieve form data
  $username = $password = $agency = $charge= $time1= $location="";

  $username = $_POST["username"]; 
  $password = $_POST["password"];
  $agency = $_POST["agency"];
  $charge = $_POST["charge"];
  $time1 = $_POST["time1"];
  $location = $_POST["location"];


  // prepare SQL statement
  $stmt = $conn->prepare("INSERT INTO transport (username, password, agency,charge,time1,location) VALUES (?, ?, ?,?,?,?)");

  // bind parameters to the statement
  $stmt->bind_param("ssssss", $username, $password, $agency,$charge,$time1,$location);

  // execute the statement
  if ($stmt->execute() === TRUE) {
    header("Location: welcome.html");
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
    <title>Register Transport</title>
    <link rel = "icon" href = 
    "/Heading icon.png" 
           width="500" type = "image/x-icon"> 
    <link rel="stylesheet" href="register transport.css">
</head>
<body>
    <span class="title">Register Transport</span>
    <form class="form" action="" method="post
    ">
        <label for="username" class="label">Username*</label>
        <input type="text" id="username" name="username" required="" class="input" autofocus placeholder="gaurav25">

        <label for="password" class="label">Password*</label>
        <input type="password" id="password" name="password" required="" class="input"  autofocus placeholder="gaurav@25"
        >

        <label for="name of agency" class="label">name of agency*</label>
        <input type="text" id="username" name="agency" required="" class="input" autofocus placeholder="bihar tiger">

        <label for="charge" class="label">charge(per kilometer)*</label>
        <input type="text" id="username" name="charge" required="" class="input" autofocus placeholder="5">

        <label for="location" class="label"> service locations*</label>
        <input type="text" id="username" name="location" required="" class="input" autofocus placeholder="patna rajgir nalanda ">

        <label for="time" class="label">average delivery time(per kilometer in minutes) *</label>
        <input type="text" id="email" name="time1" required="" class="input"  autofocus placeholder="3 ">
       
        <button type="submit" class="submit">Register   &#10140</button>
      </form>
    
</body>
</html>