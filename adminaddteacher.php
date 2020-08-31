<?php

error_reporting(0);
session_start();
$admin_name = $_SESSION['admin_name'];

define('admin', 'https://localhost/CMS/admin.php');

$conn = mysqli_connect('localhost', 'root', '', 'cms');

if (isset($_GET['Submit'])) {
    
   
    $email = $_GET['email'];
    $pass = $_GET['pass'];
    $option = $_GET['options'];
    

    if (empty($email) || empty($pass) || empty($option)) {
      echo '<script type="text/javascript">alert("Fill Every Requirment")</script>';
    }else{
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          echo '<script type="text/javascript">alert("Invalid Email")</script>';
        }else{
          $checkmail = "SELECT * FROM user WHERE email = '$email' ";
          $resultmail = mysqli_query($conn , $checkmail);
          $logmail = mysqli_num_rows($resultmail);
          if ($logmail == 1) {
            echo '<script type="text/javascript">alert("Email Already Registered")</script>';
          }else{
              
              $query = "INSERT INTO user (role , email , pass) VALUES ( '$option' ,'$email' , '$pass') ";
              if (mysqli_query($conn , $query)) {
                  echo '<script type="text/javascript">alert("Entry Successful")</script>';
              }

              $to_email = $email;
              $subject = "Log In Credentials";
              $body = "Hi, this email have your Log In Credentials. Email : " .$email. " Password : " .$pass. ".Thank You." ;
              $headers = "From: bcsf16m538@pucit.edu.pk";
              mail($to_email, $subject, $body, $headers);
              
            
          }
        }
      } 
    }

    

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Admin Panel</title>
  </head>
  <body>
    <div class="container text-white">
     <nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded">
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item ">
          <a class="nav-link" href="https://localhost/CMS/adminhome.php" >Home</a>
          </li>
          <li class="nav-item active">
          <a class="nav-link" href="https://localhost/CMS/tprofileupdate.php">Add User</a>
          </li>
          <li class="nav-item ">
          <a class="nav-link" href="https://localhost/CMS/adminaddcourses.php">Add Courses</a>
          </li>
          </ul>
      </div> 
      <form method="GET" action="https://localhost/CMS/log.php">
        <input type="submit" name="log" class="btn btn-danger" value="Log Out">
      </form>
     </nav>
    </div>
    <div class="container w-50">
      <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" class="form-control">
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" name="pass" class="form-control">
        </div>
        <div class="form-group">
        <select class="form-control" name="options" >
          <option>--Select Role--</option>
          <option  value="Teacher">Teacher</option>
          <option  value="Student">Student</option>
        </select>
      </div>
        <div class="form-group">
          <input type="submit" name="Submit" value="Create" class="btn btn-success">
        </div>
      </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>