<?php
session_start();
if(Session_destroy())
{header("Location: index.php");
}
?>