<?php
require "conDB.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    $jsn = file_get_contents('php://input');
    $data = json_decode($jsn);
    if (filter_var($data->email, FILTER_VALIDATE_EMAIL)){
        $firstname = $data->firstname;
        $lastname = $data->lastname;
        $pW = password_hash($data->password, PASSWORD_DEFAULT);
        $email = $data->email;
        $datejoined = date('Y/m/d H:i:s');
    }
}

$prep = $conn -> prepare("INSERT INTO userstable (firstname, lastname, password, email, date_joined) VALUES (:firstname, :lastname, :password, :email, :date_joined)");

$prep->bindParam(':firstname', $firstname);
$prep->bindParam(':lastname', $lastname);
$prep->bindParam(':password', $pW);
$prep->bindParam(':email', $email);
$prep->bindParam(':date_joined', $datejoined);

if ($prep -> execute()){
    echo "1";
}
else{
    echo "2";
}

?>

