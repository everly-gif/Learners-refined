<?php

include './partials/dbconct.php';
$alert=false;
$erroralert=false;
$table="users";
if(isset($_POST['submit'])){
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
    $result=$conn->query("SELECT * FROM $table WHERE `email`='$email'");
    $details=$conn->query("SELECT `name`,`id`,`password` FROM $table WHERE email='$email'");
    if(mysqli_num_rows($result) == 1){
        $data=mysqli_fetch_assoc($details);
        $verify=password_verify($password,$data['password']);
        if($verify){
            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['email']=$email;
            $_SESSION['username']=$data['name'];
            $_SESSION['user_id'] = $data['id'];
            if($_SESSION["role"]==0){
                $_SESSION["teacher"]=true;
            }
            $alert=true;
            header('location:index.php');
        }
        else{
            $erroralert="Wrong Credentials, try again!";
          }

    }
    else{
        $erroralert="Account doesn't exist, sign up!";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Education</title>
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
<!-- Nav bar  -->
<?php include './partials/nav.php'; ?>
<?php if($alert) {

    
    echo ' <div class="alert alert-success 
        alert-dismissible fade show" role="alert" style="margin-bottom:0px;;border-radius:0px;">
        <strong>Success!</strong> You are now logged in! 
        <button type="button" class="close"
            data-dismiss="alert" aria-label="Close"> 
            <span aria-hidden="true">×</span> 
        </button> 
    </div> ';
    // echo '<meta http-equiv="refresh" content="2;url=login.php" />';
     
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
<!-- form -->
<div class="container">
<form method="POST">
    <h1>Login</h1>
    <input type="email" class="form-control" placeholder="Enter your email" id="email" name="email"><br>
    <input type="password" class="form-control" placeholder="Enter your password" id="password" name="password"><br>
    <button class="btn btn-primary" type="submit"  name="submit">Login</button><br><br>
    <p>Don't have an account ? <a href="sign-up.php">Create an account</a></p>
    <a href="logout.php">logout</a>
</form>
</div>
</body>
</html>