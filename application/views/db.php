<?php include("/application/config/database.php");
$con = mysqli_connect('localhost','memblue_master','?[)iUGugEeKQ','memblue_master');
if (!$con)
{
die('Could not connect: ' . mysqli_error($con));
}
mysqli_select_db($con,"memblue_master");
?>