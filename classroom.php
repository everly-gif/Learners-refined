<?php 
session_start();
include "partials/dbconct.php";
$found=false;
$code=$_GET["code"];
$sql="SELECT * FROM `classroom` WHERE c_code='$code';";
$result=mysqli_query($conn,$sql);
if($row=mysqli_fetch_assoc($result)){
  $teachername=$row['admin'];
  $classcode=$row['c_code'];
  $classname=$row['c_name'];
  $found=true;
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

    <title>Classroom</title>
  </head>
  <body>
  <?php include "partials/nav.php"; ?>
  <?php 
  if($found){
    echo "<div class='body'>
    <div class='left'>
      <div style='padding: 20px; box-shadow:0 2px 10px rgb(0, 0, 0, 0.3);' class='heading'>
        <h1>$classname</h1>
        <h2>Teacher: <b>$teachername</b></h2>
        <p>Class Code: $classcode</p>
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
    <li class='list-group-item active' aria-current='true'>Sudents</li>
    <?php 
    if($row["students"]==""){
      echo "<li class='list-group-item'>No students Yet!</li>";
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
        echo "<li class='list-group-item'>$studentName</li>";
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
   

</body>