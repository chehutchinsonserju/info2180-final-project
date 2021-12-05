<?php
require "conDB.php";

session_start();
$cEmail= "";
$pW = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

  $jsn = file_get_contents('php://input');
  $data = json_decode($jsn);

  if (filter_var($data->email, FILTER_VALIDATE_EMAIL)){
      $pW = $data->password;
      $cEmail = $data->email;
      $sql = "SELECT * FROM userstable WHERE email= :email";
      $stmt = $conn->prepare($sql);
      $stmt->execute(array(':email' =>  $cEmail));
      $record = $stmt->fetch(PDO::FETCH_ASSOC);
  }else{
      echo "2";
  }
      if ($stmt->rowCount() == 1){
          if (password_verify($pW, $record["password"])){
              $_SESSION['id'] = $record['id'];
              $_SESSION['email'] = $record['email'];
              echo "1";
          }
          else{ 
              echo "2";
          } 
      }
      else{
          echo "2";
      }
}
else{
    echo "";
}
?>
