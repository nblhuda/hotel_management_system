<!-- for the page where display all customers that already checkin to the hotel [status of table checked is 1] -->
<?php include('db_connect.php'); 
$cat = $conn->query("SELECT * FROM room_categories");
$cat_arr = array();
while($row = $cat->fetch_assoc()){
	$cat_arr[$row['id']] = $row;
}
$room = $conn->query("SELECT * FROM rooms");
$room_arr = array();
while($row = $room->fetch_assoc()){
	$room_arr[$row['id']] = $row;
}
?>
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="row mt-3">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<table class="table table-bordered">
							<thead>
								<th>#</th>
								<th>Category</th>
								<th>Room</th>
								<th>Reference</th>
								<th>Status</th>
								<th>Date & Time</th>
								<th>Action</th>
							</thead>
							<tbody>
							<?php 
								$i = 1;
								$checked = $conn->query("SELECT * FROM checked where status = 1 order by status desc, id asc");
								while($row=$checked->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td ><?php echo $cat_arr[$room_arr[$row['room_id']]['category_id']]['name'] ?></td>
									<td class="text-center"><?php echo $room_arr[$row['room_id']]['room'] ?></td>
									<td class="text-center"><?php echo $row['name'] ?></td>
										<td class="text-center"><span class="badge badge-warning">Check in</span></td>
									<td class="text-center"><?php echo $row['date_updated'] ?></td>
									<td class="text-center">
										<button class="btn btn-sm btn-primary check_out" type="button" data-id="<?php echo $row['id'] ?>">View</button>
									</td>
								</tr>
							<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$('table').dataTable()
	//Open Check-In Details
	$('.check_out').click(function(){
		uni_modal("Check Out","manage_check_out.php?checkout=1&id="+$(this).attr("data-id"))
	})
	//Filter According to Searching
	$('#filter').submit(function(e){
		e.preventDefault()
		location.replace('index.php?page=check_in&category_id='+$(this).find('[name="category_id"]').val()+'&status='+$(this).find('[name="status"]').val())
	})
</script>