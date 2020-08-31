<?php

session_start();

define('adminhome', 'https://localhost/CMS/adminhome.php');  
define('teacher', 'https://localhost/CMS/teacher.php');
define('student', 'https://localhost/CMS/student.php');  

$conn = mysqli_connect('localhost', 'root', '', 'cms');

if (isset($_GET['Sub_teacher'])) {

  $email_teacher = $_GET['email_teacher'];
  $pass_teacher = $_GET['pass_teacher'];

  if (empty($email_teacher) || empty($pass_teacher)) {
    echo '<script type="text/javascript">alert("Fill All The Blanks")</script>';
  }else{

    $_SESSION['email'] = $email_teacher ;

    $tquery = "SELECT * FROM user WHERE email = '$email_teacher' && pass = '$pass_teacher' && role = 'Teacher' ";
    $tresult = mysqli_query($conn , $tquery);
    $tlog = mysqli_num_rows($tresult);
    if ($tlog == 1) {
      header('Location: '.teacher.'');
    }else{
      echo '<script type="text/javascript">alert("User Name or Password Incoorect !")</script>';
    }
  }

}

if (isset($_GET['Sub_admin'])) {

  $usr_admin = $_GET['usr_admin'];
  $pass_admin = $_GET['pass_admin'];

  if (empty($usr_admin) || empty($pass_admin)) {
    echo '<script type="text/javascript">alert("Fill All The Blanks")</script>';
  }else{
    $aquery = "SELECT * FROM admin WHERE usr_name = '$usr_admin' && pass = '$pass_admin' ";
    $aresult = mysqli_query($conn , $aquery);
    $alog = mysqli_num_rows($aresult);
    $fetchall = mysqli_fetch_assoc($aresult);
    $name = $fetchall['name'];
    $_SESSION['admin_name'] = $name ; 
    if ($alog == 1) {
      header('Location: '.adminhome.'');
    }else{
      echo '<script type="text/javascript">alert("User Name or Password Incoorect !")</script>';
    }
  }

}

if (isset($_GET['Sub_student'])) {

  $email_student = $_GET['email_student'];
  $pass_student = $_GET['pass_student'];

  if (empty($email_student) || empty($pass_student)) {
    echo '<script type="text/javascript">alert("Fill All The Blanks")</script>';
  }else{
    $_SESSION['semail'] = $email_student ;
    $squery = "SELECT * FROM user WHERE email = '$email_student' && pass = '$pass_student' && role = 'Student' ";
    $sresult = mysqli_query($conn , $squery);
    $slog = mysqli_num_rows($sresult);
    if ($slog == 1) {
      header('Location: '.student.'');
    }else{
      echo '<script type="text/javascript">alert("User Name or Password Incoorect !")</script>';
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

    <title>Log In</title>
  </head>
  <body>
   <div class="container">
      <nav class="navbar bg-dark text-white rounded">
        <h3>Log In</h3>
        <form method="GET" action="stud_reg.php">
          <input type="submit" class="btn btn-success" value="Sign Up">
        </form>
      </nav>
    </div>
    <div class="container">
        <form method="GET" action="#">
          <div class="row">
            <div class="container col-4">
            <h3>Teacher Log In</h3>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email_teacher" class="form-control">
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" name="pass_teacher" class="form-control">
            </div>
            <div class="form-group">
              <input type="submit" name="Sub_teacher" value="Log In" class="btn btn-success">
            </div>
          </div>
          <div class="container col-4">
            <h3>Admin Log In</h3>
            <div class="form-group">
              <label>User Name</label>
              <input type="text" name="usr_admin" class="form-control">
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" name="pass_admin" class="form-control">
            </div>
            <div class="form-group">
              <input type="submit" name="Sub_admin" value="Log In" class="btn btn-success">
            </div>
          </div>
          <div class="container col-4">
            <h3>Student Log In</h3>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email_student" class="form-control">
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" name="pass_student" class="form-control">
            </div>
            <div class="form-group">
              <input type="submit" name="Sub_student" value="Log In" class="btn btn-success">
            </div>
          </div>
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