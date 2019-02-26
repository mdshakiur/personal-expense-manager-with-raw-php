<?php
session_start();
if(!isset($_SESSION["user_email"])){
  header('location: index.php');
}
include 'dbconnect.php';

if(isset($_POST['update-expense'])){

  $id         = $_POST['id'];
  $date       = $_POST['date'];
  $ex_detail  = $_POST['ex-detail'];
  $expense    = $_POST['cost'];
  $p_amount   = $_POST['p-amount'];
  $user_email = $_SESSION["user_email"];

  $today_expensed = "SELECT expense FROM expense WHERE e_date='$date' AND user_email='$user_email'";
  $today_expensed = mysqli_query($conn, $today_expensed);
  $total = 0;
  foreach($today_expensed as $total_expense){
    $total = $total + $total_expense["expense"];
  }
  $total     = $total - $p_amount;
  $new_total = $total + $expense;

  $current_date = date("Y-m-d");
  $date1=date_create("$date");
  $date2=date_create("$current_date");
  $diff=date_diff($date1,$date2);
  $diff = $diff->format("%R%a");
  $diff = (int)$diff;

  if($new_total<=1000 and $diff>=0){
    $update_expense = "UPDATE expense SET e_date = '$date', ex_detail = '$ex_detail', expense = '$expense'   WHERE id=$id";
    if(mysqli_query($conn, $update_expense)){
      $_SESSION["update-success"] = "Update successfully";
      header('location: edit-expense.php?id='.$id);
    }
  }
  else{
        if($new_total>1000){
          $_SESSION["update-error"] = "New ammount is greater then limit";
          header('location: edit-expense.php?id='.$id);
        }

        if($diff<0){
          $_SESSION["update-error"] = "You cannot update with future date";
          header('location: edit-expense.php?id='.$id);
        }
  }
}
?>
