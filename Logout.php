<?php
include "Connection.php";
session_start();
$id=$_SESSION['id'];
$query="delete from Session_Table where Student_No= '$id'";
$answ=mysqli_query($conn,$query);
session_destroy();
header("location:index.php");
?>