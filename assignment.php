<?php 
session_start();
include "partials/dbconct.php";
$a_code=$_GET["acode"];
$sql="SELECT * FROM `assignments` WHERE `a_id`='".$a_code."';";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);

if(isset($_POST['submit'])){
            
  if (isset($_FILES['file']['name']) && $_FILES['file']['name']!=""){
      
          
          $filename="assignment/$a_code/".$_FILES['file']['name'];
          $FileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
          ;
          if($FileType != "pdf"){
              $validpic=false;
          }
          else{
              move_uploaded_file ($_FILES['file']['tmp_name'],$filename);
              if($row['submissions']==""){
                $submit[]="$filename";
                $submit=json_encode($submit);
                $insert="UPDATE `assignments` SET `submissions` = '$submit' WHERE `a_id` = '$a_code';";
                $resultins=mysqli_query($conn,$insert);
                if($resultins){
                  echo "done";
                }
                else{
                  echo "failed";
                }
              }
              else{
                $submit=json_decode($row['submissions'],true);
                $newsubmit="$filename";
                $submit[]=$newsubmit;
                $submit=json_encode($submit);
                $insert="UPDATE `assignments` SET `submissions` = '$submit' WHERE `a_id` = '$a_code';";
                $resultins=mysqli_query($conn,$insert);
                if($resultins){
                  echo "done";
                }
                else{
                  echo "failed";
                }
              }
              
          }

  }
  
}
?>
<html>
<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/classroom.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/classroomm.css">
    <link rel="stylesheet" href="search.css">
    <link rel="stylesheet" href="css/assignment.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>Assignment</title>
  </head>
  <body>
    <?php include "partials/nav.php"; ?>
      <div class="container ">
          <div class="assignment">
              <h1><?php echo $row['title']; ?></h1>
              <p><?php echo $row['description']; ?></p>
              <form action="" method="post" enctype="multipart/form-data">
                  <input type="file" name="file" id="file" accept="application/pdf">
                  <input style="background-color:green; color:white;padding:5px;" class="upload-btn" type="submit" id="submit" name="submit" value="UPLOAD"> 
              </form>
          </div>

      </div>
    </body>
    <?php include './partials/footer.php'?>
    </html>