<?php
include './partials/dbconct.php';
session_start();

$table="comments";

if(isset($_POST['displayreply']) && isset ($_POST['post_id'])){
    $post_id= $conn -> real_escape_string($_POST['post_id']);
    $display=$conn->query("SELECT * FROM $table WHERE `post_id` = '$post_id'  ORDER BY `id` DESC ");
    if(mysqli_num_rows($display)>0){
        echo "<h3 style='margin-top:40px;margin-bottom:30px;'>Comments</h3>";
    while($data=$display->fetch_assoc())
    {   
        echo "<div style='margin-right:10px;box-shadow:0 2px 10px rgb(0, 0, 0, 0.4);padding:20px; margin:12px;' class=' reply'  >
        <div  class=' d-flex '>
         <div><b>". $data['comment_author'] ."</b> "."says </div> <div class='mx-2'> ". $data['date']."</div>
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
    
    $content=$conn -> real_escape_string(addslashes($_POST['content']));
    $author=$_POST['author'];
    $author_id=$_POST['author_id'];
    $date=date('Y-m-d h:i:s');
    $post_id=$_POST['post_id'];
    $query="INSERT INTO $table VALUES('','$content','$author','$post_id','$date','$author_id')";
    $result=$conn->query($query);
  
  }
  if(isset($_POST['deleteid'])){
    $id=$_POST['deleteid'];
    $query="DELETE FROM $table WHERE `id`=$id";
    $res=$conn->query($query);
}
if(isset($_POST['id'])){
    $post_id=$_POST['id'];
    $query="DELETE FROM `post` WHERE `id`=$post_id ";
    $query2="DELETE FROM `comments` WHERE `post_id`=$post_id ";
    $res=$conn->query($query);
    $res2=$conn->query($query2);
}
if(isset($_POST['view_id'])){
    $eventid=$_POST['view_id'];
    $query=$conn->query("SELECT `event_details` FROM `events` WHERE `event_id`='$eventid'");
    if(mysqli_num_rows($query)){
        $data=$query->fetch_assoc();

        echo '<div>'.$data['event_details'].'</div>';

        
    }
}
if(isset($_POST['search']) && isset($_POST['univ'])){
    $search=$_POST['search'];
    $univ=$_POST['univ'];
    $query=$conn->query("SELECT * FROM `events` where (`event_name` like ('%$search%') OR `event_details` like ('%$search%')) AND `org`='$univ'");
    if(mysqli_num_rows($query)){

       while( $data=$query->fetch_assoc()){
        echo '<div class="card" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">'.$data['event_name'].'</h5>';
          if (strlen($data['event_details'])<200){
           echo '<p class="card-text">'.$data['event_details'].'</p>';
          }
          else{
           echo '<p class="card-text">'.substr($data['event_details'],0,200).'<span>'.'.....'.'</span></p>'.'<button class="btn btn-primary" data-toggle="modal" data-target="#Modal"  id='.$data['event_id']. ' onclick="view(this.id)">Read more</button>';
           }
         echo '
          <p  class="text-danger">'.$data['location'].'</p>
        </div>
      </div>';
       }

        

        
    }
    else{
        echo "<p>Nothing to display</p>";
    }
}
if(isset($_POST['event_id'])){
    $event_id=$_POST['event_id'];
    $query="DELETE FROM `events` WHERE `event_id`=$event_id ";
    $res=$conn->query($query);
}
?>
    