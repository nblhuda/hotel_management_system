<?php 
include('db_connect.php');
if($_GET['id']){
	$id = $_GET['id'];
	$qry = $conn->query("SELECT * FROM checked where id =".$id);
	if($qry->num_rows > 0){
		foreach($qry->fetch_array() as $k => $v){
			$$k=$v;
		}
	}
	if($room_id > 0){
	$room = $conn->query("SELECT * FROM rooms where id =".$room_id)->fetch_array();
	$cat = $conn->query("SELECT * FROM room_categories where id =".$room['category_id'])->fetch_array();
}else{
	$cat = $conn->query("SELECT * FROM room_categories where id =".$booked_cid)->fetch_array();

}
 $calc_days = abs(strtotime($date_out) - strtotime($date_in)) ; 
 $calc_days =floor($calc_days / (60*60*24)  );
}
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
	<table>
		<tr>
			<td><b>Name</b></td>
			<td><?php echo $name ?></td>
		</tr>

		<tr>
			<td><b>Room</b></td>
			<td><?php echo isset($room['room']) ? $room['room'] : 'NA' ?></td>
		</tr>

		<tr>
			<td><b>Room Category</b></td>
			<td><?php echo $cat['name'] ?></td>
		</tr>

		<tr>
			<td><b>Room Price [per day]</b></td>
			<td><?php echo 'RM'.number_format($cat['price'],2) ?></td>
		</tr>

		<tr>
			<td><b>Contact no</b></td>
			<td><?php echo $contact_no ?></td>
		</tr>

		<tr>
			<td><b>Check-in Date/Time</b></td>
			<td><?php echo date("M d, Y h:i A",strtotime($date_in)) ?></td>
		</tr>

		<tr>
			<td><b>Check-out Date/Time</b></td>
			<td><?php echo date("M d, Y h:i A",strtotime($date_out)) ?></td>
		</tr>

		<tr>
			<td><b>Days</b></td>
			<td><?php echo $calc_days ?></td>
		</tr>

		<tr>
			<td><b>Amount (Price * Days)</b></td>
			<td><?php echo 'RM'.number_format($cat['price'] * $calc_days ,2) ?></td>
		</tr>
	
	</table>
	
		<div class="row">
			<?php if(isset($_GET['checkout']) && $status == 0): ?>
				<div class="col-md-3">
					<button type="button" class="btn btn-primary checkin" >Check-in</button>
				</div>
				<div class="col-md-3">
					<button type="button" class="btn btn-primary edit_checkin" >Edit</button>
				</div>
				<div class="col-md-3">
					<button type="button" class="btn btn-danger cancel_checkin" >Cancel Booking</button>
				</div>
			<?php elseif(isset($_GET['checkout']) && $status == 1): ?>
				<div class="col-md-3">
					<button type="button" class="btn btn-primary checkout" >Checkout</button>
				</div>
				<div class="col-md-3">
					<button type="button" class="btn btn-primary edit_checkin" >Edit</button>
				</div>	
		<?php endif; ?>	
				
				<div class="col-md-3">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
		
		</div>
</div>
<script>
	$(document).ready(function(){
		
	})

	//Update Booking Information to Database
	$('.edit_checkin').click(function(){
		uni_modal("Edit Check In","manage_check_in.php?id=<?php echo $id ?>&rid=<?php echo $room_id ?>")
	})

	//Update Status to Check-Out into Database
	$('.checkout').click(function(){
		start_load()
		$.ajax({
			url:'ajax.php?action=save_checkout',
			method:'POST',
			data:{id:'<?php echo $id ?>',rid:'<?php echo $room_id ?>'},
			success:function(resp){
				if(resp ==1){
					alert_toast("Checkout Successfully",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}
			}
		})
	})

	//Update Status to Check-In into Database
	$('.checkin').click(function(){
		start_load()
		$.ajax({
			url:'ajax.php?action=save_checkin',
			method:'POST',
			data:{id:'<?php echo $id ?>',rid:'<?php echo $room_id ?>'},
			success:function(resp){
				if(resp ==1){
					alert_toast("Data successfully saved",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}
			}
		})
	})

	//Update Status to Cancel Booking into Database
	$('.cancel_checkin').click(function(){
		start_load()
		$.ajax({
			url:'ajax.php?action=cancel_checkin',
			method:'POST',
			data:{id:'<?php echo $id ?>',rid:'<?php echo $room_id ?>'},
			success:function(resp){
				console.log(resp)
				if(resp ==1){
					alert_toast("Booking canceled",'success')
					setTimeout(function(){
						
						location.reload()
					},1500)
				}
			}
		})
	})
</script>