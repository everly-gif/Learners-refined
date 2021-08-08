<!doctype html>
<html lang="en">
  <?php 
  session_start();
  if(isset($_SESSION["loggedin"]) && $_SESSION["teacher"]==true){
    include "partials/dbconct.php";
    if(isset($_POST['submit'])){
      $admin_id=$_SESSION['user_id'];
      echo "inside";
      $c_id= 'clw'.rand(10,1000).'';
      $c_name=$_POST["c_name"];
      $admin=$_SESSION['username'];
      $sql="INSERT INTO `classroom` (`admin`, `c_code`, `students`, `assignment`, `announcement`, `c_name`, `admin_id`) VALUES ('$admin', '$c_id', '', '', '', '$c_name', '$admin_id');";
      $result=mysqli_query($conn,$sql);
      if($result){
        echo"success";
        header('location:classroom.php?code='.$c_id.'');
      }
      else{
        echo"failed";
      }
    }
  }
  else{
    header("location:login.php");
  }
  
  ?>
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/classroom.css?v=<?php echo time(); ?>">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>Create Classroom</title>
  </head>
  <body>
    <?php include "partials/nav.php"; ?>
    <div class="form">

    
    <form action="" method="POST">
      <div class="mb-3">
        <label for="c_name" class="form-label">Class Name</label>
        <input type="text" class="c_name" id="c_name" name="c_name" aria-describedby="emailHelp">
      </div>
      <button type="submit" name="submit" class="btn btn-primary">Create</button>
    </form>
  </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <?php include './partials/footer.php'?>
  </body>
</html>