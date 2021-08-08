<?php

session_start();

include './partials/dbconct.php';
$table="events";

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header('location:login.php');

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/event.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>
    <?php
    include './partials/nav.php';
    ?>
    <div class="main container">
        <h1>Events</h1>
        <small class="text-danger">Are you hosting an event? Add your event<a href="add-event.php"> here</a></small>
        <div class="search-bar">
    <form style="margin-top:30px; "  class="d-flex">
        <input type="search" name="search" id="search" class="form-control" placeholder="Search events" aria-label="Search">
        
      
    </form>
   
</div><br>
        <div class="card-columns" id="results">
        <?php
         if(isset($_SESSION['univ']) || $_SESSION['univ']==true)
         $univ=$_SESSION['univ'];
         $query=$conn->query("SELECT * FROM $table WHERE `org`='$univ' ORDER BY `event_id` DESC");

         if(mysqli_num_rows($query)){
             while($data=$query->fetch_assoc()){
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
                   <p  class="text-primary">'.$data['location'].'</p>';
                   if(isset($_SESSION['loggedin'])){
                    if(isset($_SESSION['user_id']) && $_SESSION['user_id']==$data['author_id']){
                      echo '<div><span><button type="button" class="btn btn-danger del " onclick="deleteEvent('.$data['event_id'].');">Delete</button></span></div>';
                    }
                  }

                echo' </div>
               </div>';
             }
         }else{
             echo 'No events listed';
         }
        ?>
        </div>
        <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Read More</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal_body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
        
      </div>
    </div>
  </div>
</div>
    </div>
<script>
    function view(id){
       console.log(id);
          $.ajax({
             url:"backend.php",
             type:'post',
             data:{ view_id:id},
             success:function(data,status){
                 
                $('.modal-body').html(data);
               
             }
          });
        
        
        
        
        
        
        
    }
    $(document).ready(function(){
        $('#search').keyup(function(){
            var search=$(this).val();
            var univ='<?php echo $_SESSION['univ']?>';
            if(search!=''){
            $.ajax({
             url:"backend.php",
             type:'post',
             data:{ search:search,
             univ:univ},
             success:function(data,status){
                 
                $('#results').html(data);
               
             }
          });
        
            }
        })
    });
    
    function deleteEvent(id){
    var conf=confirm("Are you sure?");
    if(conf==true){
    $.ajax({
      url:"backend.php",
      type:"post",
      data:{event_id:id},
      success:function(data,status){
         location.href="events.php";
         if(data == 'success')
         return false;
      }
    });
  }
}

    
</script>
</body>
</html>