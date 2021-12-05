<?php
session_start();

$status = $_GET['status'];
$con = mysqli_connect('localhost','root','','bugme');
$id = $_SESSION['id'];
echo $id;
mysqli_select_db($con,"index");
if ($status == "1"){
    $sql="SELECT * FROM issuestable";
}else if ($status == '2'){
    $sql="SELECT * FROM issuestable WHERE status = 'Open'";
}else{
    $sql="SELECT * FROM issuestable WHERE assigned_to = '$id'";
}


$result = mysqli_query($con,$sql);

echo "<table>
<tr>
<th id= 'tt'style='width: 400px;'>Title</th>
<th id ='ty' style='width: 100px;'>Type</th>
<th>Status</th>
<th style='width: 150px;'>Assigned To</th>
<th>Created</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td id = 'tt'>" .' <b>#' .$row['id'] . "</b> <button class = 'titlebtns' >". $row['title']."</button></td>";
  echo "<td id = 'ty'>" . $row['type'] ."</td>";
  echo "<td>" ."<button class = 'statusbtns'>". $row['status'] ."</button". "</td>";
  echo "<td id = 'at'>" . $row['assigned_to'] . "</td>";
  echo "<td>" . $row['created'] . "</td>";
  echo "</tr>";
}
echo "</table>";
?>