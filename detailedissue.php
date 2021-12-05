<?php

$id = $_GET['id'];
$con = mysqli_connect('localhost','root','','bugme');

mysqli_select_db($con,"index");
$sql="SELECT * FROM issuestable WHERE id = '$id'";

$result = mysqli_query($con,$sql);

echo "
<h1>".$row['title']."</h1>";


while($row = mysqli_fetch_array($result)) {
  
}
?>