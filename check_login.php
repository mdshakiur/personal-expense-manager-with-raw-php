<?php
session_start();
if(isset($_SESSION["user_email"])){
  header('location: home.php');
}

$log_err = $s_message = "";
if(isset($_POST['login'])){
      $user_email    = $_POST['email'];
      $user_password = md5($_POST['password']);
      if(empty($user_email) or empty($user_password)){
        $_SESSION["log_err"] = "Both Input Fields are required";
        header('location: index.php');
      }
      else{
      include 'dbconnect.php';

      $user_email = mysqli_real_escape_string($conn, $user_email);
      $user_password = mysqli_real_escape_string($conn, $user_password);

      $query = "SELECT * FROM user WHERE user_email='$user_email' AND user_pass ='$user_password'";
    	$results = mysqli_query($conn, $query);
      	if (mysqli_num_rows($results) == 1) {
          $_SESSION["user_email"] = $user_email;
      	  header('location: home.php');
        	}else {
        		$_SESSION["log_err"] = "Wrong email/password combination";
            header('location: index.php');
        	}
      }
    }
else{
  header('location: index.php');
}

 ?>
