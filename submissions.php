<?php 
session_start();
include "partials/dbconct.php";
$a_code=$_GET["acode"];
if($_SESSION["teacher"]=true){
 $sql='SELECT * FROM `assignments` WHERE `a_id`="'.$a_code.'";';
 $result=mysqli_query($conn,$sql);
 if($result){
   $row=mysqli_fetch_assoc($result);
   $title=$row["title"];

 }
 else{
  header("location:login.php");
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
    <link rel="stylesheet" href="search.css">
    <link rel="stylesheet" href="css/submissions.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>Submissions</title>
  </head>
  <body>
    <?php include "partials/nav.php"; ?>
      <h1 style="padding: 20px;">Submissions for Assignmt <?php echo $title; ?></h1>
      <div class="container">
      <?php
      if(!$row['submissions']==""){
        $submits=json_decode($row["submissions"],true);
        $length=count($submits);
        for($i=0;$i<$length;$i++){
          $link=$submits[$i];
          echo "<div class='card' style='width: 18rem;margin:20px;'>
          <div class='card-body'>
          </p><a href='#' target='_blank'>PDF</a><p>
            <a href='$link' target='_blank' class='btn btn-primary'>Check PDF</a>
          </div>
          </div>
        ";
        
        }

      }
      else{
          
          echo "<div class='card' style='width: 18rem;margin:20px;'>
          <div class='card-body'>
          </p>No Submissions Yet!!<p>
          </div>
          </div>";
      }
        ?>
        
      </div>
  </body>