<?php 

session_start();
ob_start();

$mysql_host = 'localhost';
$mysql_user = 'dontqueryaboutit_kttroy2';
$mysql_pass = 'dontqueryaboutitdemo';
$mysql_db = 'dontqueryaboutit_moviedata';

$dbconnect = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db) or die("could not select data");
$username = $_SESSION['username'];

$query = "SELECT watch_title, haveWatched, myRating from WatchList where watchuser = '$username'" or die('could not find username');

$result = mysqli_query($dbconnect, $query)or die("Couldn't connect");

if(isset($_POST['addSeenSubmit'])) {
    $title = $_POST['seenTitle'];
    $rating = $_POST['seenRating'];
    $checkDBQuery = "SELECT title FROM Movie WHERE title='$title'";
    $resultCheckDB = mysqli_query($dbconnect, $checkDBQuery)or die("Error1");
    if(mysqli_num_rows($resultCheckDB) >= 1) {
        $insertQuery = "INSERT INTO WatchList(watchuser, watch_title, haveWatched, myRating) VALUES('$username', '$title', \"Yes\", '$rating')";
        $resultInsert = mysqli_query($dbconnect, $insertQuery)or die("Error2");
        echo "<script>alert(\"Success!\");</script>";
    } else {
        echo "<script>alert(\"Sorry, that movie isn't in our database.\");</script>";
    }
    header('Location:watchlist.php');
}
if(isset($_POST['addNewSubmit'])) {
    $title = $_POST['newTitle'];
    $checkDBQuery = "SELECT title FROM Movie WHERE title='$title'";
    $resultCheckDB = mysqli_query($dbconnect, $checkDBQuery)or die("Couldn't connect login3");
    if(mysqli_num_rows($resultCheckDB) >= 1) {
        $insertQuery = "INSERT INTO WatchList(watchuser, watch_title, haveWatched) VALUES('$username', '$title', \"No\")";
        $resultInsert = mysqli_query($dbconnect, $insertQuery)or die("Couldn't connect login4");
        echo "<script>alert(\"Success!\");</script>";
    } else {
        echo "<script>alert(\"Sorry, that movie isn't in our database.\");</script>";
    }
    header('Location:watchlist.php');
}
if(isset($_POST['changeRSubmit'])) {
    $title = $_POST['changeRTitle'];
    $rating = $_POST['changeRRating'];
    $checkDBQuery = "SELECT title FROM Movie WHERE title='$title'";
    $resultCheckDB = mysqli_query($dbconnect, $checkDBQuery)or die("Error5");
    if(mysqli_num_rows($resultCheckDB) >= 1) {
        $updateQuery = "UPDATE WatchList SET myRating = $rating WHERE watchuser = '$username' AND watch_title = '$title'";
        $resultUpdate = mysqli_query($dbconnect, $updateQuery)or die("Error6");
        echo "<script>alert(\"Success!\");</script>";
    } else {
        echo "<script>alert(\"Sorry, that movie isn't in our database.\");</script>";
    }
    header('Location:watchlist.php');
}
if(isset($_POST['changeWSubmit'])) {
    $title = $_POST['changeWTitle'];
    $status = $_POST['changeWStatus'];
    $checkDBQuery = "SELECT title FROM Movie WHERE title='$title'";
    $resultCheckDB = mysqli_query($dbconnect, $checkDBQuery)or die("Couldn't connect login7");
    if(mysqli_num_rows($resultCheckDB) >= 1) {
        $updateQuery = "UPDATE WatchList SET haveWatched = \"Yes\" WHERE watchuser = '$username' AND watch_title = '$title'";
        $resultUpdate = mysqli_query($dbconnect, $updateQuery)or die("Couldn't connect login8");
        echo "<script>alert(\"Success!\");</script>";
    } else {
        echo "<script>alert(\"Sorry, that movie isn't in our database.\");</script>";
    }
    header('Location:watchlist.php');
}

mysqli_close($dbconnect);
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
    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {height: 1500px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #D23535;
      height: 100%;
      color: white;
    }
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;} 
    }
    a{
        color: red;
    }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav">
      <ul class="nav nav-pills nav-stacked">
        <li class="active" style="padding-top: 25px;"><a href="indexsignedin.php" style="background-color: #2f2f2f; color: white;">Take Me Home</a></li>
        <li class="active" style="padding-top: 25px;"><a  style="background-color: #2f2f2f; color: white;" data-toggle="modal" data-target="#addSeenModal">Add a Movie I've Seen!</a></li>
        <li class="active" style="padding-top: 25px;"><a  style="background-color: #2f2f2f; color: white;" data-toggle="modal" data-target="#addNewModal">Add a Movie I Want to Watch!</a></li>
        <li class="active" style="padding-top: 25px;"><a  style="background-color: #2f2f2f; color: white;" data-toggle="modal" data-target="#changeRatingModal">Change a Movie Rating</a></li>
        <li class="active" style="padding-top: 25px;"><a  style="background-color: #2f2f2f; color: white;" data-toggle="modal" data-target="#changeWatchedModal">I Watched A Movie On My List!</a></li>
        <h3 style="padding-top: 100px;">Watch List that shows ratings and movies you would like to watch in the future</h2>
      </ul><br>
    </div>
    <div class="col-sm-9">
      <h4><small>Pick A Flick</small></h4>
      <hr>
      <h1>My Watchlist</h1>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Movie Name</th>
            <th>Have I seen this Movie?</th>
            <th>My Rating</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_array($result)) { ?>
          <tr>
            <td><?php echo $row[0]; ?></td>
            <td><?php echo $row[1]; ?></td>
            <td><?php echo $row[2]; ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

  </div>
</div>

<!-- Add Seen Modal -->
    <div id="addSeenModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" style="color: black;">Add Movie I Watched</h4>
          </div>
          <div class="modal-body">
            <form action="#" method="post">
                <div class="form-group">
                    <label>Enter Movie Title</label>
                    <input type="text" name="seenTitle" class="form-control">
                    <label>Enter My Rating</label>
                    <input type="number" name="seenRating" class="form-control">
                    <input type="submit" name="addSeenSubmit" value="Add!" />
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
<!-- Add New Modal -->
    <div id="addNewModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" style="color: black;">Add Movie I Want To See</h4>
          </div>
          <div class="modal-body">
            <form action="#" method="post">
                <div class="form-group">
                    <label>Enter Movie Title</label>
                    <input type="text" name="newTitle" class="form-control">
                    <input type="submit" name="addNewSubmit" value="Add!" />
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
<!-- Change Rating Modal -->
    <div id="changeRatingModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" style="color: black;">Change A Movie's Rating On My List</h4>
          </div>
          <div class="modal-body">
            <form action="#" method="post">
                <div class="form-group">
                    <label>Enter Movie Title</label>
                    <input type="text" name="changeRTitle" class="form-control">
                    <label>Enter My Rating</label>
                    <input type="number" name="changeRRating" class="form-control">
                    <input type="submit" name="changeRSubmit" value="Update!" />
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
<!-- Change Watched Modal -->
    <div id="changeWatchedModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" style="color: black;">I Watched This Movie!</h4>
          </div>
          <div class="modal-body">
            <form action="#" method="post">
                <div class="form-group">
                    <label>Enter Movie Title</label>
                    <input type="text" name="changeWTitle" class="form-control">
                    <input type="submit" name="changeWSubmit" value="Update!" />
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>



<footer class="container-fluid">
  <p>© Copyright 2018 Don't Query About It</p>
</footer>

</body>
</html>