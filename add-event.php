<?php

session_start();

$table="events";
$alert=false;
$erroralert=false;

include './partials/dbconct.php';

if(isset($_POST['submit'])){
    $name=mysqli_real_escape_string($conn,$_POST['event_name']);
    $details=mysqli_real_escape_string($conn,$_POST['event_details']);
    $location=mysqli_real_escape_string($conn,addslashes($_POST['location']));
    $org=$_SESSION['univ'];
    $author_id=$_SESSION['user_id'];
    $author=$_SESSION['username'];
    $date=date('Y-m-d h:i:s');
    
    $unique=$conn->query("SELECT * FROM $table WHERE `event_name`='$name' AND `org`='$org'");
    if(mysqli_num_rows($unique)==0){
    $query=$conn->query("INSERT INTO $table VALUES('','$name','$details','$location','$org','$author_id','$author','$date')");

    if($query){
        $alert=true;
    }
    else{
        $erroralert="Something went wrong";
    }
  }
  else{
      $erroralert="Event already added";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a Event</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<?php include "partials/nav.php";
if($alert) {
    
    echo ' <div class="alert alert-success 
        alert-dismissible fade show" role="alert" style="margin-bottom:0px;;border-radius:0px;">
        <strong>Success!</strong> Your event is added 
        <button type="button" class="close"
            data-dismiss="alert" aria-label="Close"> 
            <span aria-hidden="true">×</span> 
        </button> 
    </div> ';
    echo '<meta http-equiv="refresh" content="2;url=events.php" />';
    
     
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

<div class="container">
    <form method="POST">
        <h1>Add a Event </h1>
        <input type="text" class="form-control"placeholder="Event Name" name="event_name"><br>
        <textarea class="form-control"  placeholder="Event Details" name="event_details"></textarea><br>
        <input type="text" class="form-control" placeholder="Location" name="location"><br>
        <button type="submit" name="submit">Add Event</button>
        
    </form>
</div>

</body>
</html>