<?php
session_start();
if(isset($_SESSION["user_email"])){
  header('location: home.php');
}
include 'header.php';

$register_err = $s_message = "";
if(isset($_POST['register'])){

      $user_name     = $_POST['username'];
      $user_email    = $_POST['email'];
      $user_password = md5($_POST['password']);
      include 'dbconnect.php';

      $query = "SELECT * from user where user_email='$user_email'";
      $result = mysqli_query($conn, $query);
      if (mysqli_num_rows($result) == 0) {
        $insert_user = "INSERT INTO user (user_name, user_email, user_pass)
        VALUES ('$user_name', '$user_email', '$user_password')";

        if (mysqli_query($conn, $insert_user)) {
            $s_message = "You are registered successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
      }
      else
      {
      	$register_err = "You have already registered with this email";
      }
}

 ?>

<section id="section1" class="" style="margin-top:100px;">
  <div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Register</h3>
				<div class="d-flex justify-content-end social_icon">
					<span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span>
				</div>
			</div>
			<div class="card-body">
				<form action="" method="post">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="Type Username" name="username" required>

					</div>
          <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-envelope"></i></span>
						</div>
						<input type="email" class="form-control" placeholder="Type Email" name="email" required>

					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="Type Password" name="password" required>
					</div>

					<div class="form-group">
            <div class="r-msg">
              <span style="color:#fff;font-weight: 400;"><?php echo $s_message;?></span>
              <span style="color:red;font-weight: 400;"><?php echo $register_err; ?></span>
           </div>
						<input type="submit" value="Register" class="btn float-right login_btn" name="register">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Allready have an account?<a href="index.php">Sign In</a>
				</div>
			</div>
		</div>
	</div>
</div>
</section>

<?php include 'footer.php';?>
