<?php
session_start();
if(!isset($_SESSION["user_email"])){
  header('location: index.php');
}
include 'header.php';
$id = $_GET['id'];
include 'dbconnect.php';
$expense_data = "SELECT * FROM expense WHERE id=$id";
$expense_data = mysqli_query($conn, $expense_data);
$expense_data = mysqli_fetch_assoc($expense_data);
?>

<a class="logout" href="logout.php">LogOut</a>

<section id="section1" class="" style="margin-top:50px;">
  <div class="container">
    <div class="d-flex justify-content-center h-100">
  		<div class="card">
  			<div class="card-header">
  				<h3>Edit Expenses</h3>
          <hr style="height:1px; background:#ffc312; margin:0;"></hr>
  			</div>

  			<div class="card-body">
  				<form action="update_expense.php" method="post">
  					<div class="input-group">
              <div class="form-group">
                <input  style="width:100%;" name="date"  type="date" value="<?php echo $expense_data['e_date'];?>" placeholder="Month/Date/Year" required/>
              </div>
            </div>
            <h3 style="color:#ccc; font-size:18px;">Expenses Detail</h3>
            <div class="input-group form-group">
  						<div class="input-group-prepend">
  							<span class="input-group-text"><i class="fas fa-info"></i></span>
  						</div>
  						<textarea style="width:309px;" name="ex-detail" cols="10" rows="3" required><?php echo $expense_data['ex_detail'];?></textarea>

  					</div>
  					<div class="input-group form-group">
  						<div class="input-group-prepend">
  							<span class="input-group-text"><i class="fas fa-dollar"></i></span>
  						</div>
  						<input type="number" class="form-control" value="<?php echo $expense_data['expense'];?>" name="cost" required>
              <input type="hidden" class="" value="<?php echo $id;?>" name="id"/>
              <input type="hidden" class="" value="<?php echo $expense_data['expense'];?>" name="p-amount"/>
  					</div>

  					<div class="form-group">
              <?php if(isset($_SESSION["update-success"])){?>
                <span style="color:#fff;"><?php echo $_SESSION["update-success"]; ?></span>
              <?php
                unset($_SESSION["update-success"]);
                }
              ?>
              <?php if(isset($_SESSION["update-error"])){?>
                <span style="color:red;"><?php echo $_SESSION["update-error"]; ?></span>
              <?php
                unset($_SESSION["update-error"]);
                }
              ?>
  						<input type="submit" value="Save" class="btn float-right login_btn" name="update-expense">
  					</div>
  				</form>
  			</div>
  			<div class="card-footer">
            <a class="back-to-home" href="home.php">Back to Home</a>
  			</div>
  		</div>

</div>
</section>

<?php include 'footer.php';?>
