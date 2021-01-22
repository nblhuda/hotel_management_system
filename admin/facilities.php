<?php include('db_connect.php');?>

<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
			<form action="" id="manage-facility">
				<div class="card">
					<div class="card-header">
						Hotel Facilities
				  	</div>
					<div class="card-body">
						<input type="hidden" name="id">

						<!-- name of facilities -->
						<div class="form-group">
							<label class="control-label">Name</label>
							<input type="text" class="form-control" name="name">
						</div>
						
						<!-- status [0=available, 1=unavailable] -->
						<div class="form-group">
							<label for="" class="control-label">Availability</label>
							<select class="custom-select browser-default" name="status">
								<option value="0">Available</option>
								<option value="1">Unavailable</option>
							</select>
						</div>

						<!-- image of facilities -->
						<div class="form-group">
							<label for="" class="control-label">Image</label>
							<input type="file" class="form-control" name="img" onchange="displayImg(this,$(this))">
						</div>

						<!-- display img at the form after we choose file -->
						<div class="form-group">
							<img src="<?php echo isset($image_path) ? '../assets/img/'.$cover_img :'' ?>" alt="" id="cimg">
						</div>
					</div>
					
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-sm btn-primary col-sm-3 offset-md-3"> Save</button>
								<button class="btn btn-sm btn-default col-sm-3" type="button" onclick="$('#manage-facility').get(0).reset()"> Cancel</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			</div>
			<!-- end of FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-8">
				<div class="card">
					<div class="card-body">
						<table class="table table-bordered table-hover">
							<!-- table head -->
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Img</th>
									<th class="text-center">Category</th>
									<th class="text-center">Status</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>

							<!-- table body -->
							<tbody>
								<?php
									// i is for numbering 
									$i = 1;
									$cats = $conn->query("SELECT * FROM facilities order by id asc");
									while($row=$cats->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>

								
									<td class="text-center">
										<img src="<?php echo isset($row['cover_img']) ? '../assets/img/'.$row['cover_img'] :'' ?>" alt="" id="cimg">
									</td>
									<td class="">
										<p>Name : <b><?php echo $row['name'] ?></b></p>
									</td>

									<?php if($row['status'] == 0): ?>
										<td class="text-center"><span class="badge badge-success">Available</span></td>
									<?php else: ?>
										<td class="text-center"><span class="badge badge-secondary">Unavailable</span></td>
									<?php endif; ?>

									<td class="text-center">
										<!-- edit button -->
										<button class="btn btn-sm btn-primary edit_cat" type="button" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['name'] ?>" data-status="<?php echo $row['status'] ?>" data-cover_img="<?php echo $row['cover_img'] ?>">Edit</button>
										<!-- delete button -->
										<button class="btn btn-sm btn-danger delete_cat" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- end of Table Panel -->
		</div>
	</div>	
</div>

<style>
	img#cimg,.cimg{
		max-height: 10vh;
		max-width: 6vw;
	}
	td{
		vertical-align: middle !important;
	}
</style>

<!-- js function -->
<script>
	// display img in the form
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}

	// save the data to database function
	$('#manage-facility').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_facility',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully added",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
				else if(resp==2){
					alert_toast("Data successfully updated",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	})
	
	// edit data function
	$('.edit_cat').click(function(){
		start_load()
		var cat = $('#manage-facility')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='name']").val($(this).attr('data-name'))
		cat.find("[name='status']").val($(this).attr('data-status'))
		cat.find("#cimg").attr('src','../assets/img/'+$(this).attr('data-cover_img'))
		end_load()
	})

	// delete confirmation
	$('.delete_cat').click(function(){
		_conf("Are you sure to delete this facility?","delete_cat",[$(this).attr('data-id')])
	})

	// delete function
	function delete_cat($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_facility',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}
			}
		})
	}
</script>