<?php
session_start();
ob_start();

$mysql_host = 'localhost';
$mysql_user = 'dontqueryaboutit_kttroy2';
$mysql_pass = 'dontqueryaboutitdemo';
$mysql_db = 'dontqueryaboutit_moviedata';

$dbconnect = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db) or die("could not select data");
if(isset($_POST['logSubmit'])) {
    $username = $_POST['logUser'];
    mysql_real_escape_string($username);
    $_SESSION['username'] = $username;
    $password = $_POST['logPass'];
    $query = "SELECT * FROM LoginInfo WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($dbconnect, $query)or die("Couldn't connect login");
    if(mysqli_num_rows($result) >= 1) {
        header('Location:indexsignedin.php');
        exit;
    }
    else {
        echo "<script>alert(\"UserID or Password Incorrect\");</script>";
    }
}
else if(isset($_POST['regSubmit'])) {
    $username = $_POST['regUser'];
    $password = $_POST['regPass'];
    $_SESSION['username'] = $username;
    $query = "SELECT * FROM LoginInfo WHERE username = '$username'";
    $result = mysqli_query($dbconnect, $query) or die("Could not connect register");
    if(mysqli_num_rows($result) >= 1) {
        echo "<script>alert(\"That username was already taken!\");</script>";
    }
    else {
        $insertQuery = "INSERT INTO LoginInfo(username, password) VALUES('$username', '$password')";
        $resultInsert = mysqli_query($dbconnect, $insertQuery) or die("wtf3");
        echo "<script>alert(\"Registration Successful!\");</script>";
        header('Location:indexsignedin.php');
        #todo: start user session here!!!
        exit;
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        body{
            background-color: #2f2f2f;
            background-image: url("movie-theater1.jpg");
            background-size: 100%;
            margin:0;
        }
        .panel{
            background-color: #2f2f2f;
            color: white;
        }
        .panel > .panel-heading{
            background-color: #2f2f2f;
            color: white;
        }
        .btn{
            background-color: #D23535;
            border-color: #D23535;
            color: white;
        }
        .btn:hover{
            background-color: #D23535;
            border-color: #D23535;
            color: white;
        }
    </style>
</head>
<body>
<div class="container-fluid text-center" style="padding-top: 50px;">
    <img src="PaFlogo.png" class="img-responsive img-rounded margin" style="display:inline" alt="Bird" width="350" height="350">
</div>
<div class="container bg-1">
    <div class="row">
        <div class="col-md-4 col-md-offset-2" style="padding-top: 100px;">
            <form action="login_register.php" method="post">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        LOGIN
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>UserID</label>
                            <input type="text" name="logUser" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="logPass" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="logSubmit" class="form-control btn btn-success">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4" style="padding-top: 100px;">
            <form action="login_register.php" method="post">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        REGISTER
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>UserID</label>
                            <input type="text" name="regUser" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="regPass" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="regSubmit" class="form-control btn btn-success">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>