
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Education</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Classroom</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="events.php">Events</a>
          </li>
     </ul>
          
        <div class="navbar-right navbar-expand">
          <form action="search.php" method="GET" class="d-flex navbar-expand-sm">
            <input class="form-control me-2" type="search" name="code" placeholder="Class Code" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
            <?php 
            if(isset($_SESSION["loggedin"])){
              echo '<a style="margin:0 10px" class="btn btn-outline-success" href="logout.php">Logout</a>';
            }
            else{
              echo'<a style="margin:0 10px" class="btn btn-outline-success" href="login.php">Login</a>';
            }
            ?>
            
            
          </form>

        </div>
      </div>
    </div>
  </nav>