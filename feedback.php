<?php
session_start();
include './partials/dbconct.php';
if( !$_SESSION['loggedin'] && $_SESSION['role']!=0){
    header('location:login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <link rel="stylesheet" href="css/classroom.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/classroomm.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="search.css">
    <link href="https://assets.calendly.com/assets/external/widget.css" rel="stylesheet">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <?php include './partials/nav.php';?>
    <div class="container feedback pt-5">
    <h3>Here's your student's feedbacks</h3>
    <table class="table mt-5">
  <thead class='bg-primary' style="color:white;">
    <tr>
      <th scope="col">Class ID</th>
      <th scope="col">Class feedback</th>
    </tr>
  </thead>
  <tbody>
      <?php
      $id=$_SESSION['user_id'];
      $query="SELECT * FROM `feedback` WHERE `teacher_id`='$id'";
      $result=$conn->query($query);
      if(mysqli_num_rows($result)>0){
      while($data=$result->fetch_assoc()){
        echo '<tr>
      
        <td>'.$data['class_id'].'</td>
        <td>'.$data['content'].'</td>
        
        </tr>';
      }
      }
      else{
          echo '<td>No feedback yet</td>';
      }
      
      ?>
   
  </tbody>
</table>
    </div>
    <?php include './partials/footer.php';?>
</body>
</html>