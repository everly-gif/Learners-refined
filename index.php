<?php session_start();
include "partials/dbconct.php";
if(isset($_SESSION["loggedin"])){
  $classexists=false;
  $userid=$_SESSION["user_id"];
  $sql="SELECT * FROM `users` WHERE `id`=$userid";
  $result=mysqli_query($conn,$sql);
  $row=mysqli_fetch_assoc($result);
  if(!$row["classes"]==""){
    $classexists=true;
    $classes=json_decode($row["classes"],true);
    $length=count($classes);
  }
}
else{
  header("location:login.php");
}
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" href="css/classroom.css"> -->
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="css/classroomm.css">
  <link rel="stylesheet" href="css/search.css"> -->
  <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <title>Classrooms</title>
</head>
<?php include "partials/nav.php"; ?>
<h3 class="container">My Classes</h3>
<div class="container">
<?php 
if($classexists){
  for($i=0;$i<$length;$i++){
    $classcode=$classes[$i];
    $classql="SELECT * FROM `classroom` WHERE `c_code`='$classcode'";
    $resultclass=mysqli_query($conn,$classql);
    $rowclss=mysqli_fetch_assoc($resultclass);
    
    echo "<div class='card' style='width: 18rem;'>
    <div class='card-body'>
      <h5 class='card-title'>".$rowclss['c_name']."</h5>
      <p class='card-text'>Teacher : <b>".$rowclss['admin']."</b></p>
      <a href='classroom.php?code=".$classcode."' class='btn btn-primary'>Go to class</a>
    </div>
  </div>";
  }
  
}
if(!$classexists){
  echo "<div class='card' style='width: 18rem;'>
  <div class='card-body'>
    <h5 class='card-title'>No class found</h5>
    <p class='card-text'>Join Classes</p>
  </div>
</div>";
}

?>

  
</div>
<body>
</body>