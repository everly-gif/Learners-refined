
<nav class="navbar navbar-default navbar-expand-sm navbar-dark bg-dark">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <ul class="nav navbar-nav navbar-right navbar-expand-sm">
      <li class="active nav-item"><a href="index.php" class="nav-link">Classroom</a></li>
      <li class="nav-item"><a href="events.php" class="nav-link">Events</a></li>
      <?php 
            if(isset($_SESSION["loggedin"])){
              if($_SESSION["teacher"]){
                echo '<a style="margin:0 10px; border:3px solid white; color:white;border-radius:50%;font-size: 15px;" class="btn btn-outline-success" href="createclassroom.php">+</a>';
              }
            }
            ?>
     
    </ul>
    <form class="form-inline my-2 my-lg-0"  action="search.php" method="GET">
    <?php  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
            echo '
            <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>';}
            else{
              if(!$_SESSION['teacher']){
              
              echo '<li class="nav-item drop"> <div class="dropdown" ><button class="dropbtn notranslate">'.$_SESSION['username'].'▼</button>
              <div class="dropdown-content"><a class="nav-link" href="user-profile.php?id='.$_SESSION['user_id'].'">Profile</a><a class="nav-link" href="logout.php">Logout</a></div>
              </div></li>';
              }
              else{

                echo '<li class="nav-item drop"> <div class="dropdown" ><button class="dropbtn notranslate">'.$_SESSION['username'].'▼</button>
                <div class="dropdown-content"><a class="nav-link" href="user-profile.php?id='.$_SESSION['user_id'].'">Profile</a><a class="nav-link" href="feedback.php">Feedback</a><a class="nav-link" href="logout.php">Logout</a></div>
                </div></li>';

              }
            }
            ?>
      <input class="form-control mr-sm-2"  name="code" type="search" placeholder="Type classroom code" aria-label="Search">
      <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
      
     
    </form>
   
  </div>
</nav>