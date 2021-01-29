<!-- the page where it will display all the available rooms available by each category in for user to book ke room -->
<?php
include('db_connect.php');
$cid = $_GET['cid'];
?>
<style>
	.container-fluid p{
		margin: unset
	}
	#uni_modal .modal-footer{
		display: none;
	}
</style>
<div class="container-fluid">	
	<form action="" id="manage-reserve">
		<div class="form-group">
			<table class="table table-bordered">
				<thead>
					<th>#</th>
					<th>Room</th>
					<th>Action</th>
				</thead>
				<tbody>				
					<tr>
						<?php 
							$i = 1; 
							$cat = $conn->query("SELECT * FROM rooms where status = 0 and category_id = '.$cid.' ");
							while($row= $cat->fetch_assoc()):
						?>
						<td class="text-center"><?php echo $i++ ?></td>
						<td class="text-center"><?php echo $row['room']?></td>
						<td class="text-center">
							<button class="btn btn-sm btn-primary manager" type="button" data-id="<?php echo $row['id'] ?>">Book Now</button>
						</td>
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>		
	</form>			
</div>

<script>
	$('.manager').click(function(){
		uni_modal("Booking","admin/manage_check_in_user.php?rid="+$(this).attr("data-id"))
	})
</script>