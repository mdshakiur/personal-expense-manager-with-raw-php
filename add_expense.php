<?php
session_start();
if(!isset($_SESSION["user_email"])){
  header('location: index.php');
}

else{
      if(isset($_POST['expense'])){
        $date = $_POST['date'];
        $ex_detail = $_POST['ex-detail'];
        $expense = $_POST['cost'];
        $user_email = $_SESSION["user_email"];
        include 'dbconnect.php';
        $today_expensed = "SELECT expense FROM expense WHERE e_date='$date' AND user_email='$user_email'";
        $today_expensed = mysqli_query($conn, $today_expensed);
        $total = 0;
        foreach($today_expensed as $total_expense){
          $total = $total + $total_expense["expense"];
        }
        $new_total= $total+$expense;

        $current_date = date("Y-m-d");
        $date1=date_create("$date");
        $date2=date_create("$current_date");
        $diff=date_diff($date1,$date2);
        $diff = $diff->format("%R%a");
        $diff = (int)$diff;

        if($new_total<=1000 and $expense<=1000 and $diff>=0){
        $query = "SELECT * from user where user_email='$user_email'";
        $result = mysqli_query($conn, $query);
        while ($row=mysqli_fetch_row($result))
          {
          $user_id = $row[0];
          }
          $insert_data = "INSERT INTO expense (user_id, user_email, e_date, ex_detail, expense)
          VALUES ('$user_id', '$user_email', '$date', '$ex_detail', '$expense' )";

          if (mysqli_query($conn, $insert_data)) {
              $_SESSION["save_success"] = "Saved sucessfully";
              header('location: home.php');
          }
          else{
            $_SESSION["save_error"] ='<span style="color:red;">something rong</span>';
            header('location: home.php');
          }
        }
        else{
          $remain = 1000-$total;
              if($new_total>1000 or $expense>1000){
              $_SESSION["save_error"] = "Your limit is over. You have remain $$remain for expend";
              header('location: home.php');
            }
            if($diff<0){
            $_SESSION["save_error"] = "You cannot add future date";
            header('location: home.php');
          }

        }
      }
    }
?>
