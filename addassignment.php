

<?php 
session_start();
include "partials/dbconct.php";
$classcode=$_GET["code"];
$alert=false;
$erroralert=false;
if($_SESSION["teacher"]=true){
  if(isset($_POST["submit"])){
    $title=$_POST["title"];
    $desc=$_POST["desc"];
    $a_id= 'asg'.rand(10,1000).'';
    $sql="INSERT INTO `assignments` (`title`, `description`,`c_id`, `a_id`) VALUES ('$title', '$desc', '$classcode', '$a_id');";
    $result=mysqli_query($conn,$sql);
    if($result){
      $alert="Assignment Posted Successfully";
      mkdir("assignment/$a_id");
    }else{
      $erroralert="Something went wrong";
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
    <link rel="stylesheet" href="css/classroom.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/classroomm.css">
    <link rel="stylesheet" href="search.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>Assignment</title>
  </head>
  <body>
    <?php include "partials/nav.php"; 
    
    if($alert) {
    
      echo ' <div class="alert alert-success 
          alert-dismissible fade show" role="alert" style="margin-bottom:0px;;border-radius:0px;">
          <strong>Success!</strong>'.$alert.' 
          <button type="button" class="close"
              data-dismiss="alert" aria-label="Close"> 
              <span aria-hidden="true">×</span> 
          </button> 
      </div> ';
     
       
     }
     if($erroralert) {
      
      echo ' <div class="alert alert-danger 
          alert-dismissible fade show" role="alert" style="margin-bottom:0px;border-radius:0px;"> 
         <strong>Error!</strong> '. $erroralert.'<button type="button" class="close" 
         data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">×</span> 
         </button> 
          </div> '; 
     }
  
    
    ?>
   
   <h3 class="mt-5 text-center">Add Assignment</h3>

      <div class="ass_form short">
       
          <form action="" method="POST">
              <div id='classform' class='mb-3 '>
                <label class='form-label'>Title</label>
                <input type='text' class='form-control' id='title' name='title' aria-describedby='title'>
                <label class='form-label'>Description</label>
                <textarea name='desc' id=''desc cols='70' rows='10'></textarea>
              </div>
              <button type='submit' class='btn btn-primary' name='submit'>Submit</button>
            </form>

      </div>
      <?php include './partials/footer.php'?>
</body>