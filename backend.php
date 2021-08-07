<?php
include './partials/db.php';
session_start();

$table="comments";

if(isset($_POST['displayreply']) && isset ($_POST['post_id'])){
    $post_id= $mysqli -> real_escape_string($_POST['post_id']);
    $display=$mysqli->query("SELECT * FROM $table WHERE `post_id` = '$post_id'  ORDER BY `id` DESC ");
    if(mysqli_num_rows($display)>0){
        echo "<h3 style='margin-top:40px;margin-bottom:30px;'>Comments</h3>";
    while($data=$display->fetch_assoc())
    {   
        echo "<div class=' reply'  >
        <div class=' d-flex '>
         <div style='margin-right:10px;'>". $data['comment_author']." "."says </div> <div>".  $data['date']."</div>
        </div><br>
        <div >
          <p >". stripslashes($data['comment'])." </p>
          <div style='text-align:left;' >";
         
          if(isset($_SESSION['loggedin']) || $_SESSION['loggedin']==true){
              if(isset($_SESSION['user_id']) && $_SESSION['user_id']==$data['author_id']){
                  echo "<button class='btn btn-danger' onclick='deleteReply(".$data['id'].");' style='background:none; color:red;margin-bottom:10px;' >Delete</button>";
              }
          }
          echo "</div>
        </div>
      </div>";
     }
    
}
}
if (isset($_POST['content']) && isset($_POST['author']) && isset($_POST['author_id']) && isset ($_POST['post_id'])){
    
    $content=$mysqli -> real_escape_string(addslashes($_POST['content']));
    $author=$_POST['author'];
    $author_id=$_POST['author_id'];
    $date=date('Y-m-d h:i:s');
    $post_id=$_POST['post_id'];
    $query="INSERT INTO $table VALUES('','$content','$author','$post_id','$date','$author_id')";
    $result=$mysqli->query($query);
  
  }
  if(isset($_POST['deleteid'])){
    $id=$_POST['deleteid'];
    $query="DELETE FROM $table WHERE `id`=$id";
    $res=$mysqli->query($query);
}
if(isset($_POST['deleteid'])){
    $post_id=$_POST['deleteid'];
    $query="DELETE FROM `post` WHERE `id`=$post_id ";
    $query2="DELETE FROM `comments` WHERE `post_id`=$post_id ";
    $res=$mysqli->query($query);
    $res2=$mysqli->query($query2);
}
?>
    