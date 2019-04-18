<?php 
    session_start();
    if(isset($_POST[the_groups])) {
        echo "<h1>HIT THE PHP</h1>";
        $myGroup = $_POST[the_groups];
        $_SESSION['groupName'] = $myGroup;
    }
?>