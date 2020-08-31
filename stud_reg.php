<?php 
  
  define('log', 'https://localhost/CMS/log.php');

  $conn = mysqli_connect('localhost', 'root', '', 'cms');
  
  if (isset($_GET['Submit'])) {

    $fname = $_GET['fname'];
    $usr = $_GET['usr'];
    $pass = $_GET['pass'];
    $email = $_GET['email']; 

    if (empty($fname) || empty($usr) || empty($email) || empty($pass)) {
         echo '<script type="text/javascript">alert("Fill All The Blanks")</script>';
      }else{
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          echo '<script type="text/javascript">alert("Invalid Email")</script>';
        }else{
          $checkmail = "SELECT * FROM student WHERE usr_name = '$usr' ";
          $mailresult = mysqli_query($conn , $checkmail);
          $maillog = mysqli_num_rows($mailresult);
          if ($maillog == 1) {
            echo '<script type="text/javascript">alert("User Name Already Used")</script>';
          }else{
            $checkusr = "SELECT * FROM student WHERE email = '$email' ";
            $usrresult = mysqli_query($conn , $checkusr);
            $usrlog = mysqli_num_rows($usrresult);
            if ($usrlog == 1) {
              echo '<script type="text/javascript">alert("Email Already Registered")</script>';
            }else{
                $query = "INSERT INTO student (name , usr_name , email , pass) VALUES ('$fname' , '$usr' , '$email' ,  '$pass') ";
                if (mysqli_query($conn , $query)) {
                  echo '<script type="text/javascript">alert("Inserted")</script>';
                }
                 $student = 'student';
                 $query2 = "INSERT INTO registry (role , name , usr_name , register_by) VALUES ('$student' , '$fname' , '$usr' ,  '$student') ";
                 if (mysqli_query($conn , $query2)) {
                   header('Location: '.log.'');
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

    <title>Student Registry</title>
  </head>
  <body>
    <div class="container">
      <nav class="navbar bg-dark text-white rounded">
        <h3>Register</h3>
        <form method="GET" action="log.php">
          <input type="submit" class="btn btn-success" value="Already Have Accoount">
        </form>
      </nav>
    </div>
    <div class="container w-50" style="">
      <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group">
          <label>Full Name</label>
          <input type="text" name="fname" class="form-control">
        </div>
        <div class="form-group">
          <label>User Name</label>
          <input type="text" name="usr" class="form-control">
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" class="form-control">
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" name="pass" class="form-control">
        </div>
        <div>
          <input type="submit" name="Submit" value="Sign Up" class="btn btn-success">
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