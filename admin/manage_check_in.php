<!-- the form when the admin or staff click on the 'check-in' button to book the room -->
<?php 
include('db_connect.php');
	$rid = $_GET['rid'];
if(isset($_GET['id'])){
	$id = $_GET['id'];
	$qry = $conn->query("SELECT * FROM checked where id =".$id);
	if($qry->num_rows > 0){
		foreach($qry->fetch_array() as $k => $v){
			$meta[$k]=$v;
		}
	}
	$calc_days = abs(strtotime($meta['date_out']) - strtotime($meta['date_in'])) ; 
 	$calc_days =floor($calc_days / (60*60*24)  );
 	$cat = $conn->query("SELECT * FROM room_categories");
	$cat_arr = array();
	while($row = $cat->fetch_assoc()){
		$cat_arr[$row['id']] = $row;
	}
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
	
	<form action="" id="manage-check">
		<input type="hidden" name="id" id="" value="<?php echo isset($_GET['id']) ? $_GET['id']: '' ?>">
		<?php if(isset($_GET['id'])):
			$rooms = $conn->query("SELECT * FROM rooms where status =0 or id = $rid order by id asc");
		 ?>

		<div class="form-group">
			<label for="name">Room</label>
			<select name="rid" id="" class="custom-select browser-default">
				
				<?php while($row=$rooms->fetch_assoc()): ?>
				<option value="<?php echo $row['id'] ?>" <?php echo $row['id'] == $rid ? "selected": '' ?>><?php echo $row['room'] . " | ". ($cat_arr[$row['category_id']]['name']) ?></option>
				<?php endwhile; ?>
			</select>
			
		</div>

		<?php else: ?>
		<input type="hidden" name="rid" value="<?php echo isset($_GET['rid']) ? $_GET['rid']: '' ?>">
		<?php endif; ?>
		<div class="form-group">
			<label for="name">Name</label>
			<input type="text" name="name" id="name" class="form-control" value="<?php echo isset($meta['name']) ? $meta['name']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="contact_no">Contact #</label>
			<input type="text" name="contact_no" id="contact_no" class="form-control" value="<?php echo isset($meta['contact_no']) ? $meta['contact_no']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="date_in">Check-in Date</label>
			<input type="date" name="date_in" id="date_in" class="form-control" value="<?php echo isset($meta['date_in']) ? date("Y-m-d",strtotime($meta['date_in'])): date("Y-m-d") ?>" required>
		</div>
		<div class="form-group">
			<label for="date_in_time">Check-in Time</label>
			<input type="time" min="12:00" max="16:00" name="date_in_time" id="date_in_time" class="form-control" value="<?php echo isset($meta['date_in']) ? date("H:i",strtotime($meta['date_in'])): date("H:i") ?>" required>
		</div>
		<div class="form-group">
			<label for="days">Days of Stay</label>
			<input type="number" min ="1" name="days" id="days" class="form-control" value="<?php echo isset($meta['date_in']) ? $calc_days: 1 ?>" required>
		</div>
		<div class="form-group">
			<label for="status" class="control-label">Status</label>
			<select class="custom-select browser-default" name="status" id="status">
				<option value="0">Booking</option>
				<option value="1">Check-In</option>
			</select>			
		</div>
		<div class="card-footer">
			<div class="row">
				<div class="col-md-12">
					<button class="btn btn-sm btn-primary col-sm-3 offset-md-3"> Save</button>
					<button class="btn btn-sm btn-default col-sm-3" type="button" data-dismiss="modal" onclick="$('#manage-check').get(0).reset()"> Cancel</button>
				</div>
			</div>
		</div>
	</form>
</div>
<!-- js function -->
<script>
	
	// Save the Booking details to database
	$('#manage-check').submit(function(e){
		e.preventDefault()
		start_load()		
		$.ajax({
			url:'ajax.php?action=save_check',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){	
				console.log(resp)
				if(resp>0)
				{
					alert_toast("Booking completed",'success')
					setTimeout(function(){
						location.reload()
					},1500)	
				}												
			}
		})
	})

	// Set minimum date to current date
	let today = new Date(),
    day = today.getDate(),
    month = today.getMonth()+1, //January is 0
    year = today.getFullYear();
         if(day<10){
                day='0'+day
            } 
        if(month<10){
            month='0'+month
        }
        today = year+'-'+month+'-'+day;

        document.getElementById("date_in").setAttribute("min", today);
        document.getElementById("date_in").setAttribute("value", today);
</script>