<?php
session_start();
if(isset($_SESSION["user_email"])){
  header('location: home.php');
}
 include 'header.php';?>


<section id="section1" class="" style="margin-top:100px;">
  <div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card login-box">
			<div class="card-header">
				<h3>Sign In</h3>
				<div class="d-flex justify-content-end social_icon">
					<span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span>
				</div>
			</div>
			<div class="card-body">
				<form action="check_login.php" method="post">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="email" class="form-control" placeholder="Email" name="email" >
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="password" name="password" >
					</div>
					<div class="row align-items-center remember">
						<input type="checkbox">Remember Me
					</div>
					<div class="form-group">
            <div class="r-msg">
              <?php  if (isset($_SESSION["log_err"])){ ?>
                <span style="color:red;font-weight: 400;"><?php echo $_SESSION["log_err"]; ?></span>
                <?PHP
                unset($_SESSION["log_err"]);
                } ?>
            </div>
						<input type="submit" value="Login" class="btn float-right login_btn" name="login">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Don't have an account?<a href="register.php">Sign Up</a>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
<?php include 'footer.php';?>
