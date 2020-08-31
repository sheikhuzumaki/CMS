<?php

  session_start();

  $email = $_SESSION['email'];

  $conn = mysqli_connect('localhost', 'root', '', 'cms');
  
  if (isset($_GET['submit'])) {
    
    $name = $_GET['name'];
    $adress = $_GET['adress'];
    $cnic = $_GET['cnic'];
    $phone = $_GET['phone'];

    if (empty($name) || empty($adress) || empty($cnic) || empty($phone)) {
      echo '<script type="text/javascript">alert("Fill Every Requirment")</script>';
    }else{
      $tquery = "SELECT * FROM teacher WHERE email = '$email'";
      $tresult = mysqli_query($conn , $tquery);
      $tlog = mysqli_num_rows($tresult);
      if ($tlog == 1) {
        echo '<script type="text/javascript">alert("You Have Already Updated Your Profile")</script>';
      }else{
        $query = "INSERT INTO teacher (name , adress , email , phone , cnic) VALUES ( '$name' ,'$adress' , '$email' , '$phone' , '$cnic' ) ";
        if (mysqli_query($conn , $query)) {
          echo '<script type="text/javascript">alert("Updated")</script>';
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

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container text-white">
     <nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded">
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item ">
          <a class="nav-link" href="https://localhost/CMS/teacher.php" >Home</a>
          </li>
          <li class="nav-item active ">
          <a class="nav-link" href="https://localhost/CMS/tprofileupdate.php">Update Profile</a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="https://localhost/CMS/tchangepass.php">Change Password</a>
          </li>
          </ul>
      </div>
      <form method="GET" action="https://localhost/CMS/log.php">
        <input type="submit" name="log" class="btn btn-danger" value="Log Out">
      </form>
    </nav>
    </div>
    <br>
    <div class="container w-50">
      <form method="GET" action="">
        <div class="form-group">
          <label>Full Name</label>
          <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
          <label>Adress</label>
          <input type="text" name="adress" class="form-control">
        </div>
        <div class="form-group">
          <label>CNIC</label>
          <input type="text"  data-inputmask="'mask': '99999-9999999-9'"  placeholder="XXXXX-XXXXXXX-X"  name="cnic" required="" class="form-control" >
        </div>
        <div class="form-group">
          <label>Mobile Number</label>
           <input type="text" class="form-control item" name="phone" placeholder="Phone Number">
        </div>
        <div class="form-group">
          <input type="submit" name="submit" class="btn btn-success" value="Update">
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