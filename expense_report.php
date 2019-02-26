<?php
session_start();
if(!isset($_SESSION["user_email"])){
  header('location: index.php');
}
include 'header.php';
?>

<a class="logout" href="logout.php">LogOut</a>

<section id="section2" style="width:100%; margin-top:150px;">
  <div class="container" style="">
<?php
if(isset($_POST['expensereport'])){
   $start_date = $_POST['startdate'];
   $end_date = $_POST['enddate'];
   $total = 0;
   $user_email = $_SESSION["user_email"];
   $date1=date_create($start_date);
   $date2=date_create($end_date);
   $diff=date_diff($date1,$date2);
   $diff = $diff->format("%R%a");
   $diff = (int)$diff;
   if($diff>=0){
   include 'dbconnect.php';

  $myquery = "SELECT * FROM expense WHERE user_email='$user_email' and e_date >='$start_date' and e_date <='$end_date' ORDER BY e_date ASC";
  $myresult = mysqli_query($conn, $myquery);
  ?>
<div style="color:#ccc; text-align:center; font-size:28px; width:100%; margin:50px auto 0; background:#000; padding:10px 0; border-bottom:3px solid #ffc312;">
  Expense Report From <span style="color:#ffc312"><?php echo $start_date; ?></span> To <span style="color:#ffc312"><?php echo $end_date; ?></span>
</div>
  <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%; background:#fff;">
    <thead>
      <tr>
        <th>DATE</th>
        <th>EXPENSE DETAIL</th>
        <th>PRICE</th>
        <th>ACTION</th>
      </tr>
    </thead>
    <tbody>
        <?php
          while($myrow = mysqli_fetch_assoc($myresult))
          {
            echo '<tr><td>'.$myrow["e_date"].'</td>';
            // echo '<td>'.$myrow["user_email"].'</td>';
            echo '<td>'.$myrow["ex_detail"].'</td>';
            echo '<td><span style="float:right;">'.$myrow["expense"].'</span></td>';
            $total = $total + $myrow["expense"];
            ?>
            <td><button class="delet-expense btn btn-danger" value="delet-expense.php?id=<?php echo $myrow["id"];?>">DELETE</button>
                <button class="edit-expense btn btn-warning" onclick="window.location.href='edit-expense.php?id=<?php echo $myrow["id"];?>'">EDIT</button>
            </td>
            <?php
            echo '</tr>';
          }
        ?>
    </tbody>
  </table>
  <h2 style="color:#fff; text-align:right;">Total Exepense = <span style="color:#ffc312"><?php echo $total; ?></span></h2>
<?php
  }
  else{
    $_SESSION["report_error"] = "Start date should be smaller then End date";
    header('location: home.php');
  }

 }
 ?>
</div>
</section>
<?php include 'footer.php';?>



<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable({
    "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]]
    });
} );

$(document).ready(function() {
  $('.delet-expense').click(function(){
    var redirect_link = $(this).val();
    swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          window.location.href = redirect_link;
        }
      })
      })
});


</script>
