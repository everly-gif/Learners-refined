<?php 
session_start();
include "partials/dbconct.php";
$found=false;
$c_code=$_GET["code"];
if($_SERVER['REQUEST_METHOD']="GET"){

  $sql="SELECT * FROM `classroom` WHERE c_code='$c_code';";
  
  $result=mysqli_query($conn,$sql);
  
  if($row=mysqli_fetch_assoc($result)){
    $found=true;
    $classname=$row["c_name"];
    $admin=$row["admin"];
    $classcode=$row["c_code"];
  }
}

?>
<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/classroom.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="search.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

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
    <?php 
    
    if($found){
      echo "<div class='card' style='width: 30rem; margin:50px'>
    <img src='https://source.unsplash.com/1600x900/?classroom,study' class='card-img-top' alt='...'>
    <div class='card-body'>
      <h5 class='card-title'>$classname</h5>
      <p class='card-text'>Teacher Name: <b>$admin</b></p>
      <a href='joinclass.php?code=$classcode' class='btn btn-primary'>Join Class</a>
    </div>";
    }
    else{
      echo "<div class='card' style='width: 18rem; margin:50px'>
    <div class='card-body'>
      <h5 class='card-title'>No Classroom Found</h5>
    </div>";
    }
    
    ?>

  </div>
  </body>