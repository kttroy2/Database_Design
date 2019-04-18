<?php 
    session_start(); 
    $username = $_SESSION['username'];
    $testGroup = $_SESSION['groupName'];
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
      background: url("black and red stripes.jpg") repeat-y top left;
      height: 100%;
      color: white;
    }
    
    .dropdown-menu {
        right: 150px !important;
        left: 150px !important;
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
        echo $username ?>! <span class="glyphicon glyphicon-log-out"></span> <button class= "btn btn-danger" onclick="myFunction()"> Log Out</button></a></li>
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
      <p><a style="color: white;" href="randommovie.php" class="btn btn-danger btn-sm">Random Movie</a></p>
      <p><a style="color: white;" href="randomactor.php" class="btn btn-danger btn-sm">Random Actor/Actress</a></p>
    </div>
    <div class="col-sm-8 text-center"> 
        <div class="col-sm-82 text-center"> 
      <h1><img src="PaFlogo.png" class="img-responsive img-rounded margin" style="display:inline" alt="Bird" width="350" height="350"></h1>
      <p style="padding-left: 50px; padding-right: 50px;">Welcome to the simple, easy to use website for sharing your favorite movies with friend's and finding everything about the next hit movie!</p>
      
 
<!-- Carousel -->
<!-- Surround everything with a div with the class carousel slide -->
<div id="theCarousel" class="carousel slide" data-ride="carousel">
 
  <!-- Define how many slides to put in the carousel -->
  <ol class="carousel-indicators">
    <li data-target="#theCarousel" data-slide-to="0" class="active"> </li >
    <li data-target="#theCarousel" data-slide-to="1"> </li>
    <li data-target ="#theCarousel" data-slide-to="2"> </li>
  </ol >
 
  <!-- Define the text to place over the image -->
  <div class="carousel-inner">
    <div class="item active" >
    <div class ="slide1"></div>
    <div class="carousel-caption">
      <h1>Looking for an Actor/Actress or Movie?</h1>
      <p><a href="select_query.php" class="btn btn-danger btn-sm">Search Here!</a></p>
    </div>
    </div>
  <div class="item">
  <div class="slide2"></div>
  <div class="carousel-caption">
    <h1>Looking for your group?</h1>
    <p><a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal">Look no further!</a></p>
  </div>
  </div>
  <div class="item">
  <div class="slide3"></div>
  <div class="carousel-caption">
    <h1>See what movies have the most of your fave Actors!</h1>
    <p><a href="pop_actors.php" class="btn btn-danger btn-sm">Lets do this!!</a></p>
  </div>
  </div>
  </div>
  
  <?php
    $mysql_host = 'localhost';
    $mysql_user = 'dontqueryaboutit_kttroy2';
    $mysql_pass = 'dontqueryaboutitdemo';
    $mysql_db = 'dontqueryaboutit_moviedata';
    
    $dbconnect = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db) or die("could not select data");
    $myGroupz = "SELECT MG.GroupName 
                FROM MovieGroup MG INNER JOIN GroupEnrollment GE on GE.GroupID = MG.GroupID 
                WHERE GE.UserID = '$username'";
    $result = mysqli_query($dbconnect, $myGroupz)or die("Couldn't connect");
    
    if(isset($_POST['submit'])) {
        $myGroup = $_POST[the_groups];
        $_SESSION['groupName'] = $myGroup;
    }
    
    if(isset($_POST['createGroupSubmit'])) {
        $newGroup = $_POST['groupName'];
        $newGroupDesc = $_POST['groupDesc'];
        $newGroupE = mysql_real_escape_string($newGroup);
        $newGroupDescE = mysql_real_escape_string($newGroupDesc);
        $usedGroupQuery = "SELECT MG.GroupName FROM MovieGroup MG WHERE MG.GroupName = '$newGroupE'";
        $usedGroupResult = mysqli_query($dbconnect, $usedGroupQuery)or die("$newGroup");
        if(mysqli_num_rows($usedGroupResult) >= 1) {
            echo "<script>alert(\"This Group Name is already taken!\");</script>";
        } else {
            $insertGroupQuery = "INSERT INTO MovieGroup(GroupName, Description, NumMembers) VALUES('Testing', '$newGroupDescE', 1)";
            $resultInsert = mysqli_query($dbconnect, $insertGroupQuery)or die("Couldn't insert group");
            $selectGroupID = "SELECT GroupID FROM MovieGroup WHERE GroupName = '$newGroupE'";
            $resultID = mysqli_query($dbconnect, $selectGroupID)or die("wtf1");
            $row = mysqli_fetch_array($result);
            $groupID = $row[0];
            $insertEnrollmentQuery = "INSERT INTO GroupEnrollment(UserID, GroupID) VALUES('$username', '$groupID')";
            $resultInsertEnrollment = mysqli_query($dbconnect, $insertEnrollmentQuery)or die("Couldn't insert enrollment");
        }
    }
?>

  <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" style="color: black;">Get to your group!</h4>
          </div>
          <div class="modal-body">
            <p style="color: black;">Select your group:</p>
            <form action="#" method="post">
                <div class="form-group">
                    <select class="form-control" name="the_groups">
                          <?php while ($row = mysqli_fetch_array($result)) { 
                                echo "<option value=\"$row[0]\">$row[0]</option>";
                            }?>
                    </select>
                    <input type="submit" name="submit" value="Select" />
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <form action="group_home.php" method="post">
                <div class="form-group">
                    <button type="submit" class="btn btn-default form-control" name="groupBtn" style="background-color: #D23535; color: white;">Go!</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
 
  <!-- Set the actions to take when the arrows are clicked -->
  <a class="left carousel-control" href="#theCarousel" data-slide="prev">
  <span class="glyphicon glyphicon-chevron-left"> </span>
  </a>
  <a class="right carousel-control" href="#theCarousel" data-slide="next">
  <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
  </div>
    </div>
    </div>
    <div class="col-sm-2 sidenav">
      <p><a style="color: white;" href="watchlist.php" class="btn btn-danger btn-sm">Watch List</a></p>
      <p><a style="color: white;" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#createModal" >Create A Group</a></p>
    </div>
  </div>
</div>


<footer class="container-fluid text-center">
  <p>© Copyright 2018 Don't Query About It</p>
</footer>

<div id="createModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" style="color: black;">Create A Group!</h4>
          </div>
          <div class="modal-body">
            <form action="#" method="post">
                <div class="form-group">
                    <label>Group Name:</label>
                    <input type="text" name="groupName" class="form-control"/>
                    <label>Group Description:</label>
                    <input type="text" name="groupDesc" class="form-control"/>
                    <input type="submit" name="createGroupSubmit" value="Create!" />
                </div>
            </form>
          </div>
        </div>
      </div>
    </div> 

</body>
</html>
