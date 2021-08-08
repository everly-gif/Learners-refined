<?php 
session_start();
$alert=false;
$erroralert=false;
include "partials/dbconct.php";

if(isset($_SESSION["loggedin"])){
  $user_id=$_SESSION["user_id"];
  $teacher=false;
  $found=false;
  $code=$_GET["code"];
  $sql="SELECT * FROM `classroom` WHERE c_code='$code';";
  $result=mysqli_query($conn,$sql);
  if($row=mysqli_fetch_assoc($result)){
    $teachername=$row['admin'];
    $classcode=$row['c_code'];
    $classname=$row['c_name'];
    $teacher_id=$row['admin_id'];
    $found=true;
  }
  $teachersql='SELECT * FROM `users` WHERE `id`='.$user_id.';';
  $tearesult=mysqli_query($conn,$teachersql);
  $tearow=mysqli_fetch_assoc($tearesult);
  $calendly_link=$tearow['calendly_link'];
  if($tearow["role"]==0){
    $teacher=true;
    $_SESSION["teacher"]=true;
  }
}
else{
  header("location:login.php");
}
if(isset($_POST['feedback'])){
  $content=mysqli_real_escape_string($conn,$_POST['feedback-content']);
  $class_id=$_GET['code'];
  $query=$conn->query("SELECT `admin`,`admin_id` FROM `classroom` WHERE `c_code`='$class_id'");
  $data=$query->fetch_assoc();
  $teacher_name=$data['admin'];
  $teacher_id=$data['admin_id'];
  $result=$conn->query("INSERT INTO `feedback` VALUES('','$content','$teacher_name','$teacher_id','$class_id')");
  if($result){
    $alert=true;
  }
  else{
    $erroralert="Failed , try again later";
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
    <link rel="stylesheet" href="css/classroomm.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="search.css">
    <link href="https://assets.calendly.com/assets/external/widget.css" rel="stylesheet">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>Classroom</title>
  </head>
  <body>
  <?php include "partials/nav.php";
  
  if($alert) {
    
    echo ' <div class="alert alert-success 
        alert-dismissible fade show" role="alert" style="margin-bottom:0px;;border-radius:0px;">
        <strong>Success!</strong> Your feedback has been submitted
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
  
  <?php 
  if($found){
    
    echo "<div class='body'>
    <div class='left'>
      <div style='padding: 20px; box-shadow:0 2px 10px rgb(0, 0, 0, 0.3);' class='heading'>
       <div class='d-flex justify-content-between'> <h1>$classname</h1><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModalLong'>
        Give Feedback
      </button></div>
        <h2>Teacher: <b>$teachername</b></h2>
        <p>Class Code: $classcode</p><p>
        ".$calendly_link."</p>";
        echo '
        
     
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Feedback Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form  method="POST">
                <textarea placeholder="Leave a feedback"  name="feedback-content"class="form-control"></textarea><br>
                <button  class="btn btn-primary" type="submit"name ="feedback">Submit</button>
                </form>
              </div>
            </div>
          </div>
        </div></div>';
    
      

      if($teacher){
        echo "<div class='assign'>
        <a href='addassignment.php?code=".$classcode."'>+</a>
        <p> Add Assignment</p>
        </div>
        ";
      }
      echo "<div class='assignments'>";
      $classsql='SELECT * FROM `assignments` WHERE `c_id`="'.$classcode.'";';
      $classresult=mysqli_query($conn,$classsql);
      while($classrow=mysqli_fetch_assoc($classresult)){
        $title=$classrow['title'];
        $desc=$classrow['description'];
        $a_id=$classrow['a_id'];
        echo '
        
        <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">'.$title.'</h5>';
          if(strlen($desc)<200){
           echo' <p class="card-text">'.$desc.'</p>';
          }
          else{
            echo '<p>'.substr($desc,0,200).'<span>'.'.....'.'</span></p>';
          }
        echo '

          <a style="margin:10px;"href="assignment.php?acode='.$a_id.'" class="btn btn-primary">Submit Assignment</a>';


          if($teacher){echo '<a style="margin:10px;" href="submissions.php?acode='.$a_id.'" class="btn btn-primary">Check Submissions</a>';
          }
          echo'
        </div>
      </div>
        ';

      }
      echo "
      </div>
      </div>";
  }

    else{
      echo "<div class='body'>
      <div class='left'>
        <div style='padding: 20px; box-shadow:0 2px 10px rgb(0, 0, 0, 0.3);' class='heading'>
          No Such Class Found
        </div>
      </div>";
    }
    

  
    ?>
    <ul class='list-group right'>
    <?php echo '<div class="card" style="width: 18rem;margin-left:10px;">
    <div class="card-body">
      <h5 class="card-title">Have Doubts?</h5>
      <h6 class="card-subtitle mb-2 text-muted">We have a doubt forum just for you!</h6>
      <p class="card-text">Discuss with peers and upskill yourself</p>
      <a href="doubt-forum.php?id='.$classcode.'" class="card-link">Forum</a>
    </div>
  </div><br>'; ?>
    <li class='list-group-item active'style="margin-left:10px;" aria-current='true'>Members</li>
    <?php 
   
    if($row["students"]==""){
      echo "<li class='list-group-item' style='margin-left:10px;'>No students Yet!</li>";
    }
    else{
      $studentsArr=json_decode($row['students'],true);
      $s_id=array_column($studentsArr,'userid');
      
      $length=count($studentsArr);
      for($i=0;$i<$length;$i++){
        $key=$s_id[$i];
        $search="SELECT * FROM `users` WHERE id='$key';" ;
        $searchresult=mysqli_query($conn,$search);
        $row=mysqli_fetch_assoc($searchresult);
        $studentName=$row['name'];
        echo "<li class='list-group-item'style='margin-left:10px;'>$studentName</li>";
      }
    }
  
    
    ?>
    </ul>
        </div>
    
  
      <!-- <div class="body">
        <div class="left">
          <div style="padding: 20px; box-shadow:0 2px 10px rgb(0, 0, 0, 0.3);" class="heading">
            <h1>Classname</h1>
            <h2>Teacher: <b>Name</b></h2>
            <p>Class Code</p>
          </div>
          <hr>
        </div>
        <ul class="list-group right">
            <li class="list-group-item active" aria-current="true">Sudents</li>
            <li class="list-group-item">A second item</li>
          </ul>
      </div> -->
      <?php include './partials/footer.php'?>
      <script src="https://assets.calendly.com/assets/external/widget.js" type="text/javascript" async></script>
      
</body>
</html>