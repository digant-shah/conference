<?php
include("../db.php");
//$q = 1376;
//echo $_GET['formData'];
$q = intval($_GET['q']);
$sql="SELECT COUNT(*) AS total FROM user WHERE group_id=".$q;

$result = mysqli_query($con,$sql);
$values1 = mysqli_fetch_assoc($result);
$num_row = $values1['total'];
echo $num_row;

?>
