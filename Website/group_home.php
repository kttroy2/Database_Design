<?php
session_start();
ob_start();

$groupName = $_SESSION['groupName'];
$userID = $_SESSION['username'];

$mysql_host = 'localhost';
$mysql_user = 'dontqueryaboutit_kttroy2';
$mysql_pass = 'dontqueryaboutitdemo';
$mysql_db = 'dontqueryaboutit_moviedata';

$dbconnect = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db) or die("could not select data");
$selectGroupID = "SELECT GroupID FROM MovieGroup WHERE GroupName = '$groupName'";
$result = mysqli_query($dbconnect, $selectGroupID)or die("wtf1");
$row = mysqli_fetch_array($result);
$groupID = $row[0];

$selectGroupDesc = "SELECT Description FROM MovieGroup WHERE GroupName = '$groupName'";
$result = mysqli_query($dbconnect, $selectGroupDesc)or die("wtf1");
$rowDesc = mysqli_fetch_array($result);
$groupDesc = $rowDesc[0];

if(isset($_POST['leaveSubmit'])) {
    $deleteQuery = "DELETE FROM GroupEnrollment WHERE UserID = '$userID' AND GroupID = '$groupID'";
    $resultDelete = mysqli_query($dbconnect, $deleteQuery)or die("wtf");
    
    $sqlSelectNum = "SELECT NumMembers FROM MovieGroup WHERE GroupID = '$groupID'";
    $resultSelectNum = mysqli_query($dbconnect, $sqlSelectNum)or die("wtf4");
    $currNumMembers = mysqli_fetch_array($resultSelectNum);
    $newNumMembers = $currNumMembers[0] - 1;
    $sqlUpdate = "UPDATE MovieGroup SET NumMembers = '$newNumMembers' WHERE GroupID = '$groupID'";
    $resultUpdate = mysqli_query($dbconnect, $sqlUpdate)or die("wtf5");
    header('Location:indexsignedin.php');
    exit;
}
if(isset($_POST['addSubmit'])) {
    $userToAdd = $_POST['userToAdd'];
    $selectUser = "SELECT username FROM LoginInfo WHERE username = '$userToAdd'";
    $result = mysqli_query($dbconnect, $selectUser) or die("wtf");
    if(mysqli_num_rows($result) >= 1) {
        #todo: see if member is already in the group!!!
        $sqlInsert = "INSERT INTO GroupEnrollment(UserID, GroupID) VALUES ('$userToAdd', '$groupID')";
        $resultInsert = mysqli_query($dbconnect, $sqlInsert)or die("wtf");
        
        $sqlSelectNum = "SELECT NumMembers FROM MovieGroup WHERE GroupID = '$groupID'";
        $resultSelectNum = mysqli_query($dbconnect, $sqlSelectNum)or die("wtf4");
        $currNumMembers = mysqli_fetch_array($resultSelectNum);
        $newNumMembers = $currNumMembers[0] + 1;
        $sqlUpdate = "UPDATE MovieGroup SET NumMembers = '$newNumMembers' WHERE GroupID = '$groupID'";
        $resultUpdate = mysqli_query($dbconnect, $sqlUpdate)or die("wtf5");
    }
}

$allWatchedQuery = "SELECT W.watch_title, AVG(W.myRating)
                    FROM WatchList W, GroupEnrollment GE
                    WHERE GE.GroupID=$groupID AND W.watchuser=GE.UserID AND W.haveWatched=\"Yes\"
                    GROUP BY W.watch_title
                    ORDER BY AVG(W.myRating) DESC";
$allWatchedResult = mysqli_query($dbconnect, $allWatchedQuery)or die("wtf111");

$notWatchedQuery = "SELECT W.watch_title
                    FROM WatchList W, GroupEnrollment GE
                    WHERE GE.GroupID=$groupID AND W.watchuser=GE.UserID AND W.haveWatched=\"No\"
                    GROUP BY W.watch_title";
$notWatchedResult = mysqli_query($dbconnect, $notWatchedQuery)or die("wtf111");

$membersQuery = "SELECT UserID
                    From GroupEnrollment
                    WHERE GroupID=$groupID";
$membersResult = mysqli_query($dbconnect, $membersQuery)or die("wtf222");
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
        <li class="active" style="padding-top: 25px;"><a style="background-color: #2f2f2f; color: white;" data-toggle="modal" data-target="#addModal">Add a Member</a></li>
        <li class="active" style="padding-top: 25px; paddint-bottom: 50px;"><a style="background-color: #2f2f2f; color: white;" data-toggle="modal" data-target="#leaveModal">Leave This Group</a></li>
        <table class="table">
            <thead>
              <tr>
                <th>Members</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($row = mysqli_fetch_array($membersResult)) { ?>
              <tr>
                <td><?php echo $row[0]; ?></td>
              </tr>
              <?php } ?>
            </tbody>
      </table>
      </ul><br>
    </div>
    <div class="col-sm-9">
      <h1><?php echo $groupName; ?></h1>
      <hr>
      <h4><?php echo $groupDesc; ?></h4>
      <hr>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Movies That Have Been Watched</th>
            <th>Our Average Rating</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_array($allWatchedResult)) { ?>
          <tr>
            <td><?php echo $row[0]; ?></td>
            <td><?php echo $row[1]; ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      <hr>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Movies We Want To Watch</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_array($notWatchedResult)) { ?>
          <tr>
            <td><?php echo $row[0]; ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

  </div>
</div>


<!-- Add Modal -->
    <div id="addModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" style="color: black;">Add a Member</h4>
          </div>
          <div class="modal-body">
            <form action="#" method="post">
                <div class="form-group">
                    <label>Enter Their UserID</label>
                    <input type="text" name="userToAdd" class="form-control">
                    <input type="submit" name="addSubmit" value="Add!" />
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
<!-- Leave Modal -->
    <div id="leaveModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" style="color: black;"><?php echo "$groupName"; ?></h4>
          </div>
          <div class="modal-body">
              <form action="#" method="post">
                <div class="form-group">
                    <p style="color: black;">Are you sure you want to leave this group?</p>
                    <input type="submit" name="leaveSubmit" value="Yes" />
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
