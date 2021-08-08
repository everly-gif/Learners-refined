<?php
session_start();
include './partials/dbconct.php';
$table="post";
if(!$_GET['id']){
  header('Location:doubt-forum.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="./css/doubt_forum.css?v=<?php echo time();?>">
        <link rel="stylesheet" href="./css/classroom.css?v=<?php echo time();?>">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


        
</head>
<body>
    <?php include './partials/nav.php';?>
    <div class="container short">
        <?php
        if(isset($_GET['id']) && $_GET['id']>0){
            $id=mysqli_real_escape_string($conn,$_GET['id']);
            $query=$conn->query("SELECT * FROM $table WHERE id=$id");
            if(mysqli_num_rows($query)){
                $data=$query->fetch_assoc();
                echo "<div class='mt-5'><h1>".$data['title']."</h1>";
                if(isset($_SESSION['loggedin'])){
                    if(isset($_SESSION['user_id']) && $_SESSION['user_id']==$data['user_id']){
                      echo '<div><span><button type="button" class="btn btn-danger del mt-2" onclick="deletePost('.$id.');">Delete</button></span></div>';
                    }
                  }
                echo "<p class='content'>".$data['content']."</p></div>";
            }
        }
        
        
        ?>
    </div>
    <div class="container replies">
    <form method="POST" id="mainform" class="reply">
        <textarea  class="form-control" id="reply_content" placeholder="Leave a Reply"></textarea><br>
        <?php  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
          echo '<a class="btn btn-success" href="login.php" >Login to Reply</a>';
        }
        else{
          echo '<button class="btn btn-success" type="button" onclick="addReply()" id="submit" name="submit">Post</button>';
        }
        ?>
    </form>
    <div id="display-reply"></div>
    </div>
    <?php include './partials/footer.php';?>
    <script>
    $(document).ready(function(){
    displayReplies();
    
    })
        
        function displayReplies(){
        var post_id=<?php echo $_GET['id'];?>;
        var displayreply="displayreply";
          $.ajax({
             url:"backend.php",
             type:'post',
             data:{ displayreply:displayreply,
             post_id:post_id},
             success:function(data,status){
               $('#display-reply').html(data);
               
             }
          });
        

}
function addReply(){
  var content=$('#reply_content').val();
  var author= '<?php echo $_SESSION['username'];?>';
  var author_id=<?php echo $_SESSION['user_id'];?>;
  var post_id=<?php echo $_GET['id'];?>;
  $.ajax({
     
     url:"backend.php",
     type:'post',
     data:{content:content,
     author:author,
     author_id:author_id,
     post_id:post_id
     
     
     
     },
     success:function(data,status){
        document.getElementById("mainform").reset();
        
        displayReplies();
        if(data == 'success')
           return false
     },
     

  });
}

function deleteReply(id){
    var conf=confirm("Are you sure?");
    if(conf==true){
    $.ajax({
      url:"backend.php",
      type:"post",
      data:{deleteid:id},
      success:function(data,status){
         displayReplies();
         if(data == 'success')
         return false;
      }
    });
  }
}
function deletePost(id){
    var conf=confirm("Are you sure?");
    if(conf==true){
    $.ajax({
      url:"backend.php",
      type:"post",
      data:{id:id},
      success:function(data,status){
         location.href="doubt-forum.php";
         if(data == 'success')
         return false;
      }
    });
  }
}


</script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>