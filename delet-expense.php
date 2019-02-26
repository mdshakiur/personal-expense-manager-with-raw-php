<?php
session_start();
if(!isset($_SESSION["user_email"])){
  header('location: index.php');
}
include 'dbconnect.php';
$id = $_GET['id'];

$delet_expense = "DELETE FROM expense WHERE id=$id";
if(mysqli_query($conn, $delet_expense)){
  header('location: home.php');
}
?>
