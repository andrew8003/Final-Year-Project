<?php
ini_set('memory_limit', '4048M');
session_start();
if (isset($_SESSION['userid']))
{
    echo "<p style='float: middle'><i><b>".$_SESSION['fname']." ".$_SESSION['sname']." | User Type:
    ".$_SESSION['usertype']."</b></i></p>";
}



?>