<?php
  
  define('adminaddcourses', 'https://localhost/CMS/adminaddcourses.php');

  $conn = mysqli_connect('localhost', 'root', '', 'cms');

  $query = "SELECT * FROM courses";
  $result = mysqli_query($conn , $query);
  $output = mysqli_fetch_all($result , MYSQLI_ASSOC);

  $query1 = "SELECT * FROM semester";
  $result1 = mysqli_query($conn , $query1);
  $output1 = mysqli_fetch_all($result1 , MYSQLI_ASSOC);

  if (isset($_GET['submit'])) {
    
    $email = $_GET['email'];
    $course = $_GET['course'];
    $semester = $_GET['semester'];
    $role = $_GET['role'];
    $program = $_GET['program'];

    if (empty($email) || $course == '--Select Course--' || $semester == '--Select Semester--' || $role == '--Select Role--' || $program == '--Select Program--') {
      echo '<script type="text/javascript">alert("Fill Every Requirment")</script>';
    }else{
      if ($role == 'Teacher') {
        
        $checkmail = "SELECT * FROM user WHERE email = '$email' && role = 'Teacher' ";
        $resultmail = mysqli_query($conn , $checkmail);
        $logmail = mysqli_num_rows($resultmail);
        if ($logmail == 1) {
          
          $tquery = "INSERT INTO teacher_course (email , course , program , semester) VALUES ( '$email' , '$course' , '$program' , '$semester' ) ";
          if (mysqli_query($conn , $tquery)) {
            echo '<script type="text/javascript">alert("Entry Successful")</script>';
          }

        }else{
          echo '<script type="text/javascript">alert("No Such Teacher Exist")</script>';
        }
      }

      if ($role == 'Student') {
        
        $checkmail1 = "SELECT * FROM user WHERE email = '$email' && role = 'Student' ";
        $resultmail1 = mysqli_query($conn , $checkmail1);
        $logmail1 = mysqli_num_rows($resultmail1);
        if ($logmail1 == 1) {
          
           $squery = "INSERT INTO student_course (email , course , program , semester) VALUES ( '$email' , '$course' , '$program' , '$semester') ";
          if (mysqli_query($conn , $squery)) {
            echo '<script type="text/javascript">alert("Entry Successful")</script>';
          }

        }else{
          echo '<script type="text/javascript">alert("No Such Student Exist")</script>';
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
          <a class="nav-link" href="https://localhost/CMS/adminhome.php" >Home</a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="https://localhost/CMS/adminaddteacher.php">Add User</a>
          </li>
          <li class="nav-item active">
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
      <form method="GET" action="">
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" class="form-control">
        </div>
        <div class="form-group">
        <select class="form-control" name="course" >
          <option>--Select Course--</option>
          <?php foreach($output as $course) : ?>
          <option  value="<?php echo $course['course'] ; ?>"><?php echo $course['course'] ; ?></option>
          <?php endforeach ?>
        </select>
      </div>
      <div class="form-group">
        <select class="form-control" name="semester" >
          <option>--Select Semester--</option>
          <?php foreach($output1 as $course) : ?>
          <option  value="<?php echo $course['semester'] ; ?>"><?php echo $course['semester'] ; ?></option>
          <?php endforeach ?>
        </select>
      </div>
      <div class="form-group">
        <select class="form-control" name="role" >
          <option>--Select Role--</option>
          <option  value="Teacher">Teacher</option>
          <option  value="Student">Student</option>
        </select>
      </div>
      <div class="form-group">
        <select class="form-control" name="program" >
          <option>--Select Program--</option>
          <option  value="Computer Science">Computer Science</option>
          <option  value="Software Engineering">Software Engineering</option>
          <option  value="Information Technology">Information Technology</option>
        </select>
      </div>
        <div class="form-group">
          <input type="submit" name="submit" class="btn btn-success">
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