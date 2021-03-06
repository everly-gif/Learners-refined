<?php 
include './partials/dbconct.php';
session_start();
if(!$_GET['id']){
    header('location:index.php');
}
$alert=false;
$erroralert=false;
$class=$_GET['id'];
$table="post";
if (isset($_POST['thread_submit'])){
    $title=mysqli_real_escape_string($conn,$_POST['title']);
    $content=mysqli_real_escape_string($conn,$_POST['editor']);
    
    $user_id=$_SESSION['user_id'];
    $date=date('Y-m-d h:i:s');
    $query=$conn->query("INSERT INTO $table VALUES ('','$title','$content','$class','$user_id','$date')");
    if($query){
        $alert=true;

    }
    else{
        $erroralert="something went wrong";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doubt Forum</title>
    <script src="ckeditor/ckeditor.js"></script>
     <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


<link rel="stylesheet" href="./css/classroom.css?v=<?php echo time();?>">
<link rel="stylesheet" href="./css/doubt_forum.css?v=<?php echo time();?>">
</head>
<body>
    <?php include './partials/nav.php'?>
    <?php if($alert) {
    
    echo ' <div class="alert alert-success 
        alert-dismissible fade show" role="alert" style="margin-bottom:0px;;border-radius:0px;">
        <strong>Success!</strong> Your doubt has been posted
        <button type="button" class="close"
            data-dismiss="alert" aria-label="Close"> 
            <span aria-hidden="true">×</span> 
        </button> 
    </div> ';
    echo '<meta http-equiv="refresh" content="2" />';
     
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
    <h3 class="m-3 mt-5">Welcome to your class's forum!</h3>
    <div class="container search-bar">
    <form style="margin-top:30px; " method="POST" class="d-flex">
        <input type="search" name="search" id="search" class="form-control mt-3 mb-3" placeholder="Search discussions" aria-label="Search">
        <button class="btn btn-primary search mt-3 mb-3"  type="submit" name="submit" >Search</button>
       
    </form>
</div>
<br>
   <div class="container">
    <?php if(!isset($_POST['submit'])):?>
    <form method="POST" id="mainform" class="threadpost">
        <input type="text" placeholder="title" id="title" class="form-control"name="title" required><br>
        <textarea   id="editor" name="editor"  required></textarea><br>
        <?php  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
          echo '<a class="btn btn-primary" href="login.php" >Login to Continue</a>';
        }
        else{
          echo '<button class="btn btn-primary" type="submit" name="thread_submit"  >Post thread</button>';
        }
        ?>
    </form>
    <?php endif;?>
   </div>

   <div class="container recent-posts">
       <br>
       
       <div class="container" id="display-thread">
       <?php
        if(isset($_POST['submit']) && !empty($_POST['search'])){
            $search=mysqli_real_escape_string($conn,$_POST['search']);
            if($search){
                $result=$conn->query("SELECT * FROM $table where (`title` like ('%$search%') OR `content` like ('%$search%')) AND `class_id`='$class'");
                if(mysqli_num_rows($result)==0){
                    echo "<h2 class='container' style='padding:0px; margin:30px 0px;'>Looks Like there's not a lot of discussions , <a href='doubt-forum.php'>start your own!</a> </h2>";
                    $result=$conn -> query("SELECT * FROM $table WHERE `class_id`='$class' ORDER BY `id` DESC ") or die($conn->error);
                    while($data=$result->fetch_assoc()){
                        $id=$data['user_id'];
                        $query2="SELECT `id`,`name` FROM `users` WHERE `id`= '$id'";
                        $username=$conn->query($query2);
                        $res=$username->fetch_assoc();
                        echo '<div class="containers"><p class="name">'.$res['name'].' shared </p>';
                        echo '<p>'.$data['title'].'  </p>';
                        echo '<p>'.substr($data['content'],0,200).'.....'.' </p>'.'<a href="post.php?id='.$data['id'].'">Help Out</a></div>';
                    }
                  }
                  else{
                    echo "<p class='container' style='padding:0px; margin:30px 0px;'>Search Results </p>";
                    while($data=$result->fetch_assoc()){
                        $id=$data['user_id'];
                        $query2="SELECT `id`,`name` FROM `users` WHERE `id`= '$id'";
                        $username=$conn->query($query2);
                        $res=$username->fetch_assoc();
                        echo '<div class="containers"><p class="name">'.$res['name'].' shared </p>';
                        echo '<p>'.$data['title'].'  </p>';
                        echo '<p>'.substr($data['content'],0,200).'.......'.'</p>'.'<a href="post.php?id='.$data['id'].'">Help Out</a></div>';
                    }
                  }
            }
            
        }
        else{
        $query="SELECT * FROM $table WHERE `class_id`='$class' ORDER BY `timestamp` DESC";
        $result=$conn->query($query);
        if(mysqli_num_rows($result)){
        while($data=$result->fetch_assoc()){
        echo '<h2 class="container">Recently added</h2>';
        $id=$data['user_id'];
        $query2="SELECT `id`,`name` FROM `users` WHERE `id`= '$id'";
        $username=$conn->query($query2);
        $res=$username->fetch_assoc();
        echo '<div class="containers"><p class="name">'.$res['name'].' shared </p>';
        echo '<p>'.$data['title'].'  </p>';
        if (strlen($data['content'])<200){
            echo '<p>'.$data['content'].'</p>'.'<a href="post.php?id='.$data['id'].'">Help Out</a></div>';
        }
        else{
        echo '<p>'.substr($data['content'],0,200).'<span>'.'.....'.'</span></p>'.'<a href="post.php?id='.$data['id'].'">Help Out</a></div>';
        }
        }
    }else{
        echo '<h2 class="container">No Recent Discussions</h2>';
    }
    }

?>
       </div>
   </div>


</div>
<?php include './partials/footer.php'?>
<script>
  CKEDITOR.replace( 'editor', {
        height: 100
    } ); 

</script>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>