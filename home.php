<?php
session_start();
if(!isset($_SESSION["user_email"])){
  header('location: index.php');
}
include 'header.php';
?>

<a class="logout" href="logout.php">LogOut</a>

<section id="section1" class="" style="margin-top:50px;">
  <div class="container">
    <div class="d-flex justify-content-center h-100">
  		<div class="card">
  			<div class="card-header">
  				<h3>Daily Expenses</h3>
          <hr style="height:1px; background:#ffc312; margin:0;"></hr>
  			</div>

  			<div class="card-body">
  				<form action="add_expense.php" method="post">
  					<div class="input-group">
              <div class="form-group">
                <input  style="width:100%;" name="date"  type="date" data-date-format="DD MMMM YYYY" placeholder="Month/Date/Year" required/>
              </div>
            </div>
            <h3 style="color:#ccc; font-size:18px;">Expense Detail</h3>
            <div class="input-group form-group">
  						<div class="input-group-prepend">
  							<span class="input-group-text"><i class="fas fa-info"></i></span>
  						</div>
  						<textarea style="width:309px;" name="ex-detail" cols="10" rows="3" placeholder="Type detail about expense" required></textarea>

  					</div>
  					<div class="input-group form-group">
  						<div class="input-group-prepend">
  							<span class="input-group-text"><i class="fas fa-dollar"></i></span>
  						</div>
  						<input type="number" class="form-control" placeholder="Cost" name="cost" required>
  					</div>

  					<div class="form-group">
              <?php if(isset($_SESSION["save_success"])){?>
                <span style="color:#fff;"><?php echo $_SESSION["save_success"]; ?></span>
              <?php
                unset($_SESSION["save_success"]);
                }
              ?>
              <?php if(isset($_SESSION["save_error"])){?>
                <span style="color:red;"><?php echo $_SESSION["save_error"]; ?></span>
              <?php
                unset($_SESSION["save_error"]);
                }
              ?>
  						<input type="submit" value="Save" class="btn float-right login_btn" name="expense">
  					</div>
  				</form>
  			</div>
  			<div class="card-footer">

  			</div>
  		</div>

      <div class="d-flex justify-content-center h-100" style="margin-left:50px;">
    		<div class="card">
    			<div class="card-header">
    				<h3>Expenses Report</h3>
            <hr style="height:1px; background:#ffc312; margin:0;"></hr>
    			</div>

    			<div class="card-body">
    				<form action="expense_report.php" method="post">
    					<div class="form-group">
                <h3 style="color:#ccc; font-size:18px; width:100%;">Start Date</h3>
                <input style="width:100%;" name="startdate"  type="date" placeholder="Month/Date/Year" required/>
              </div>
              <div class="form-group" style="margin-top:40px;">
                <h3 style="color:#ccc; font-size:18px; width:100%;">End Date</h3>
                <input style="width:100%;" name="enddate"  type="date" placeholder="Month/Date/Year" required/>
              </div>
    					<div class="form-group" style="margin-top:35px; position:relative;">
                <?php if(isset($_SESSION["report_error"])){?>
                  <span style="color:red;" class="report_error"><?php echo $_SESSION["report_error"]; ?></span>
                <?php
                  unset($_SESSION["report_error"]);
                  }
                ?>
    						<input type="submit" value="Make A Report" class="btn float-right report_btn" name="expensereport">
    					</div>
    				</form>
    			</div>
    			<div class="card-footer">

    			</div>
    		</div>
  	</div>

</div>
</section>

<?php include 'footer.php';?>
