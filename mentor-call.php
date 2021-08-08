<?php

session_start();

$user_id=$_GET['id'];
$role=$_GET['role'];

include './partials/dbconct.php';




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentorship Call booking</title>
    <!-- Calendly badge widget begin -->
<link href="https://assets.calendly.com/assets/external/widget.css" rel="stylesheet">
<script src="https://assets.calendly.com/assets/external/widget.js" type="text/javascript" async></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/classroomm.css">
    <link rel="stylesheet" href="search.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</head>
<body>
<!-- <a href="user-profile.php?id=<?php echo $_SESSION['user_id'];?>&role=<?php echo $_SESSION['role'];?>">link</a> -->
<?php
include './partials/nav.php';
if($role==0){
echo '<h1 class="text-center">Book a call, details will be sent over mail</h1><div class="calendly-inline-widget" data-url="https://calendly.com/yashmalho1999" style="min-width:100vw;height:100vh;position:fixed;"></div>
<script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async></script>';
}?>

</body>
</html>
