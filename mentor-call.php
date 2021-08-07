<?php

session_start();

$user_id=$_GET['id'];
$role=$_GET['role'];

include './partials/dbconct.php';

if($role==0){
echo '<h1>Book a call, details will be sent over mail</h1><div class="calendly-inline-widget" data-url="https://calendly.com/" style="min-width:100vw;height:100vh;position:fixed;"></div>
<script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async></script>';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Calendly badge widget begin -->
<link href="https://assets.calendly.com/assets/external/widget.css" rel="stylesheet">
<script src="https://assets.calendly.com/assets/external/widget.js" type="text/javascript" async></script>


</head>
<body>
<!-- <a href="user-profile.php?id=<?php echo $_SESSION['user_id'];?>&role=<?php echo $_SESSION['role'];?>">link</a> -->

</body>
</html>
