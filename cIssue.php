<?php
require "conDB.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    $jsn = file_get_contents('php://input');
    $data = json_decode($jsn);
    $title = $data->title;
    $description = $data->description;
    /**To get the Id value */
    $user = explode( " ", $data->assigned_to);
    $sql = "SELECT id FROM userstable WHERE firstname = '$user[0]' AND lastname = '$user[1]'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC);

    $assignedto = $record['id'];
    $type = $data->type;
    $priority = $data ->priority;
    $status = "Open";
    $created_by = $_SESSION['id'];
    $created = date('Y/m/d H:i:s');
}

$prep = $conn -> prepare("INSERT INTO issuesTable (title, description, type, priority, status, assigned_to, created_by, created) VALUES (:title, :description, :type, :priority, :status, :assignedto, :created_by, :created)");

$prep->bindParam(':title', $title);
$prep->bindParam(':description', $description);
$prep->bindParam(':type', $type);
$prep->bindParam(':priority', $priority);
$prep->bindParam(':status', $status);
$prep->bindParam(':assignedto', $assignedto);
$prep->bindParam(':created_by', $created_by);
$prep->bindParam(':created', $created);

if ($prep -> execute()){
    echo "1";
}
else{
    echo "2";
}


?>
