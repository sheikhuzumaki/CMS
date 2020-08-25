<?php

session_start();
$admin_name = $_SESSION['admin_name'];

define('admin', 'https://localhost/CMS/admin.php');

$conn = mysqli_connect('localhost', 'root', '', 'cms');

if (isset($_GET['Submit'])) {
    
    $name = $_GET['name'];
    $usr_name = $_GET['usr'];
    $adress = $_GET['adress'];
    $email = $_GET['email'];
    $pass = $_GET['pass'];

    if (empty($name) || empty($usr_name) || empty($adress) || empty($email) || empty($pass)) {
      echo '<script type="text/javascript">alert("Fill All The Blanks")</script>';
    }else{
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          echo '<script type="text/javascript">alert("Invalid Email")</script>';
        }else{
          $checkmail = "SELECT * FROM teacher WHERE email = '$email' ";
          $resultmail = mysqli_query($conn , $checkmail);
          $logmail = mysqli_num_rows($resultmail);
          if ($logmail == 1) {
            echo '<script type="text/javascript">alert("Email Already Registered")</script>';
          }else{
              $checkusr = "SELECT * FROM teacher WHERE usr_name = '$usr_name' ";
              $resultusr = mysqli_query($conn , $checkusr);
              $logusr = mysqli_num_rows($resultusr);
              if ($logusr == 1) {
                echo '<script type="text/javascript">alert("User Name Already Used")</script>';
            }else{
              $query = "INSERT INTO teacher (name , usr_name , adress , email , pass) VALUES ('$name' , '$usr_name'  , '$adress' ,  '$email' , '$pass') ";
              if (mysqli_query($conn , $query)) {
                header('Location: '.admin.'');
              }
              $admin = 'admin';
              $teacher = 'teacher';
              $query2 = "INSERT INTO registry (role , name , usr_name , register_by) VALUES ('$teacher' , '$name' ,   '$usr_name' ,  '$admin') ";
              if (mysqli_query($conn , $query2)) {
                header('Location: '.admin.'');
              }
            }
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
    <div class="container">
      <nav class="navbar bg-dark text-white rounded">
        <h3> <?php echo $admin_name; ?></h3>
        <form method="GET" action="log.php">
          <input type="submit" class="btn btn-danger" value="Log Out">
        </form>
      </nav>
    </div>
    <div class="container w-50">
      <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group">
          <label>Name</label>
          <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
          <label>User Name</label>
          <input type="text" name="usr" class="form-control">
        </div>
        <div class="form-group">
          <label>Address</label>
          <input type="text" name="adress" class="form-control">
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" class="form-control">
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" name="pass" class="form-control">
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