<?php
session_start();
ob_start();

$mysql_host = 'localhost';
$mysql_user = 'dontqueryaboutit_kttroy2';
$mysql_pass = 'dontqueryaboutitdemo';
$mysql_db = 'dontqueryaboutit_moviedata';

$dbconnect = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db) or die("could not select data");
$query = "SELECT M.title, COUNT(*) 
            FROM Actor A INNER JOIN Movie M on A.knownMovie = M.title 
            GROUP BY M.title
            ORDER BY COUNT(*) DESC";
$result = mysqli_query($dbconnect, $query)or die("Couldn't connect");
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
        <h3 style="padding-top: 100px;">These are all the movies ranked by the number of actors/actresses in our database that are "known for" that movie.</h2>
      </ul><br>
    </div>
    <div class="col-sm-9">
      <h4><small>Pick A Flick</small></h4>
      <hr>
      <h1>Actor-Trending Movies:</h1>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Movie Name</th>
            <th>Number of Actors "Known For" This Movie</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_array($result)) { ?>
          <tr>
            <td><?php echo $row[0]; ?></td>
            <td><?php echo $row[1]; ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

  </div>
</div>

<footer class="container-fluid">
  <p>© Copyright 2018 Don't Query About It</p>
</footer>

</body>
</html>