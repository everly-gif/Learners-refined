<?php

session_start();

if($_GET['id']!=$_SESSION['user_id']){
    header('location:index.php');
}
include './partials/dbconct.php';
if(isset($_POST['deleteacc'])){
    $user_id=$_POST['deleteacc'];
    $query="DELETE FROM `post` WHERE `user_id`=$user_id ";
    $query2="DELETE FROM `comments` WHERE `author_id`=$user_id ";
    $query3="DELETE FROM `users` WHERE `id`=$user_id ";
    $query4="DELETE FROM `events` WHERE `author_id`=$user_id ";
    $res=$conn->query($query);
    $res2=$conn->query($query2);
    $res3=$conn->query($query3);
    $res4=$conn->query($query4);
}

if(isset($_POST['calendly'])){
    $calendly=addslashes($_POST['calendly-content']);
    $id=$_SESSION['user_id'];
    $query="UPDATE `users` SET `calendly_link` = '$calendly' WHERE `id`='$id'";
    $result=$conn->query($query);
    if($result){
        echo "<script>alert('Success');</script>";
    }
    else{
        echo "<script>alert('failed');</script>";
    }

}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
     <!-- Latest compiled and minified CSS -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
     <link rel="stylesheet" href="./css/classroom.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <?php include './partials/nav.php'?>
    <h3 class="text-center my-3">Profile</h3>
    <?php if($_SESSION['role']==0){
       echo' <p class="text-center my-3"><a href="" data-toggle="modal" data-target="#exampleModalLong">Update your calendly link here</a></p>';
        }?>
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Calendly Link</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form  method="POST">
                <textarea placeholder="Please copy the embedded code from calendly for inline popup"  name="calendly-content"class="form-control"></textarea><br>
                <button  class="btn btn-primary" type="submit"name ="calendly">Submit</button>
                </form>
              </div>
            </div>
          </div>
        </div></div>
    <div  class="container d-flex justify-content-between  main">

    <div style="width:50%;">
        <h3>Details</h3>
        <?php
        $id=$_SESSION['user_id'];
        $query="SELECT * FROM `users` WHERE `id` = $id";
        $result=$conn->query($query);
        if(mysqli_num_rows($result)>0){
        while($data=$result->fetch_assoc()){
            echo '<p>Name : '.$data['name'].'</p>';
            echo '<p>Email : '.$data['email'].'</p>';
            echo '<p>Organization : '.$data['org'].'</p>';
            echo '<button type="button" class="btn btn-danger my-2" onclick="deleteacc('.$id.')">Delete Account</button>';
        }
        }
        
        
        ?>
    </div>
    <div style="width:50%;">
    <h3>Events</h3>
     <?php
      
     $org=$_SESSION['univ'];
     $id=$_SESSION['user_id'];
     $query="SELECT * FROM `events` WHERE `org` = '$org' AND `author_id`='$id'ORDER BY `date` DESC";
     $result=$conn->query($query);
     if(mysqli_num_rows($result)>0){
     while($data=$result->fetch_assoc()){
         echo '<p class="text-primary"> '.$data['event_name'].'</p>';
     }
     }
     else{
         echo'<p>No Events Posted</p>';
     }
     ?>

    </div>
     </div>
     <div  class="container d-flex justify-content-between main">
    <div style="width:50%;">
     
    <h3>Posts</h3>
        <?php
        $id=$_SESSION['user_id'];
        $query="SELECT * FROM `post` WHERE `user_id` = $id ORDER BY `timestamp` DESC";
        $result=$conn->query($query);
        if(mysqli_num_rows($result)>0){
        while($data=$result->fetch_assoc()){
            echo '<p><a href="post.php?id='.$data['id'].'">'.stripslashes($data['title']).'</a> </p>';
            
        }
        }
        else{
            echo '<br><p>No Posts have been Made.</p>';
        }
        
        
        ?>
    </div>
     

    <div style="width:50%;">
    <h3>Comments</h3>
    <?php 
    $id=$_SESSION['user_id'];
    $query="SELECT * FROM `comments` WHERE `author_id` = '$id' ORDER BY `date` DESC";
    $result=$conn->query($query);
    if(mysqli_num_rows($result)>0){
    while($data=$result->fetch_assoc()){
        echo '<p><a href="post.php?id='.$data['post_id'].'">'.stripslashes($data['comment']).'</a></p>';
    }
    }
    else{
        echo '<br><p>No comments have been Made.</p>';
    }
    ?>
    </div>
    </div>
    <script>
    function deleteacc(deleteid){
  var con=confirm("Are you sure? All your data will be deleted");
  if(con==true){
    $.ajax({
      url:"",
      type:"post",
      data:{deleteacc:deleteid},
      success:function(data,status){
        location.href = "login.php";
         if(data == 'success')
         return false;
      }
    });
  }
}
</script>
</body>
</html>