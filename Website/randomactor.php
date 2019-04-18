<?php
session_start();
ob_start();

$mysql_host = 'localhost';
$mysql_user = 'dontqueryaboutit_kttroy2';
$mysql_pass = 'dontqueryaboutitdemo';
$mysql_db = 'dontqueryaboutit_moviedata';

$dbconnect = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db) or die("could not select data");

//if(isset($_POST['movieId'])) {
 
    $sql = "SELECT * FROM Actor ORDER BY RAND() LIMIT 1";
    $result = mysqli_query($dbconnect, $sql)or die("wtf");
    $row = mysqli_fetch_array($result);
    $_SESSION['rowA'] = $row[0];
    $_SESSION['rowB'] = $row[1];
    $_SESSION['rowC'] = $row[2];
    /* 
    if(mysqli_num_rows($result) >= 1) {
        while($row = mysqli_fetch_array($result)) {
           //echo print_r($row);
           echo "Title: ";
           echo " ";
           echo $row[0];
           echo "<br>";
           echo "Release Date: ";
           echo " ";
           echo $row[1];
           echo "<br> ";
           echo "Popularity Rating: ";
           echo " ";
           echo $row[2];
           echo "<br> ";
           echo "Plot Summary: ";
           echo " ";
           echo $row[3];
        }
       exit;
    }
    
    
    else {
       
        header('Location:reselect.html');
        exit;
    }
    */
    





?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 1000px;
     
    }
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 30px;
      /*background-color: darkred;*/
      background: url("black and red stripes.jpg") repeat-y top left;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #111;
      color: white;
      padding: 0px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 0px;
      }
      .row.content {height:auto;
      } 
    }
    .col-sm-8 {
        background: url(movie-theater1.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
   left: 0%;
   background-size: cover;

}
.container-fluid1 {
    background: url(movie-theater1.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
   left: 0%;
   background-size: cover;

}

.col-sm-82 {
    position: absolute;
    top: 0%;
    left: 0;
    width: 100%;
    color: white;
}
.col-sm-2 {
    color : green;
}
      /* Carousel Styling */
.slide1{
  background-image: url('solid red pattern.png');
  height: 300px;
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
}
.slide2{
  background-image: url('bkgrnd2.png');
  height: 300px;
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
}
.slide3{
  background-image: url('bkgrnd3.png');
  height: 300px;
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
}
.carousel-caption h1{
  font-size: 4.0em;
  font-family: 'Arial';
  padding-bottom: .2em;
}
.carousel-caption p{
  font-size: 0.5em;
}

  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#"><img src="clapper transparent.png"height="35" width="40"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="indexsignedin.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Hello <?php 
        session_start(); 
        $query = $_SESSION['username']; 
        echo $query ?>! <span class="glyphicon glyphicon-log-out"></span> <button class= "btn btn-danger" onclick="myFunction()"> Log Out</button></a></li>
        <script>
            function myFunction() {
            location.replace("http://dontqueryaboutit.web.illinois.edu/login_register.php")
        }
        </script>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container-fluid1 row text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
      <p><a href="randommovie.php" class="btn btn-danger btn-sm">Random Movie</a></p>
      <p><a href="randomactor.php" class="btn btn-danger btn-sm">Random Actor/Actress</a></p>
      
    </div>
    <div class="col-sm-8 text-center"> 
      
        <div class="col-sm-82 text-center"> 
      <h1><?php 
        session_start(); 
        $randactor = $_SESSION['rowA']; 
        echo  $randactor
        ?></h1>
      <p style="padding-left: 50px; padding-right: 50px;"><?php 
        session_start(); 
        $randact1 = $_SESSION['rowB']; 
        echo "Popularity Rating: ";
        echo $randact1
        ?>    <br>  <?php 
        session_start(); 
        $randact2 = $_SESSION['rowC'];
        echo "Known for ";
        echo $randact2
        ?></p>
      



 

  
    </div>
    </div>
    <div class="col-sm-2 sidenav">
      <p><a href="watchlist.php" class="btn btn-danger btn-sm">Watch List</a></p>
      <p><a href="myratings.php" class="btn btn-danger btn-sm">My Ratings</a></p>
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
  <p>© Copyright 2018 Don't Query About It</p>
</footer>

</body>
</html>