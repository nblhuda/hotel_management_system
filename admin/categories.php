<!-- this is the page where admin can add the categories and it will display the categories that available in this hotel -->

<?php include('db_connect.php');?>

<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
				<form action="" id="manage-category">
					<div class="card">
						<div class="card-header">
							Room Category Form
						</div>
						<div class="card-body">
							<input type="hidden" name="id">
								<!-- category -->
								<div class="form-group">
									<label class="control-label">Category</label>
									<input type="text" class="form-control" name="name">
								</div>

								<!-- price -->
								<div class="form-group">
									<label class="control-label">Price</label>
									<input type="number" class="form-control text-right" name="price" step="any">
								</div>

								<!-- Adult -->
								<div class="form-group">
									<label class="control-label">Adult</label>
									<input type="number" class="form-control text-right" name="adult">
								</div>

								<!-- Kids -->
								<div class="form-group">
									<label class="control-label">Kids</label>
									<input type="number" class="form-control text-right" name="kid">
								</div>

								<!-- image -->
								<div class="form-group">
									<label for="" class="control-label">Image</label>
									<input type="file" class="form-control" name="img" onchange="displayImg(this,$(this))">
								</div>

								<div class="form-group">
									<img src="<?php echo isset($image_path) ? '../assets/img/'.$cover_img :'' ?>" alt="" id="cimg">
								</div>
						</div>
						
						<!-- save and cancel button -->
						<div class="card-footer">
							<div class="row">
								<div class="col-md-12">
									<!-- save button -->
									<button class="btn btn-sm btn-primary col-sm-3 offset-md-3"> Save</button>
									<!-- cancel button -->
									<button class="btn btn-sm btn-default col-sm-3" type="button" onclick="$('#manage-category').get(0).reset()"> Cancel</button>
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
									<th class="text-center">Room</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>

							<!-- table body -->
							<tbody>
								<?php
									// i is for numbering 
									$i = 1;
									$cats = $conn->query("SELECT * FROM room_categories order by id asc");
									while($row=$cats->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>

								
									<td class="text-center">
										<img src="<?php echo isset($row['cover_img']) ? '../assets/img/'.$row['cover_img'] :'' ?>" alt="" id="cimg">
									</td>
									<td class="">
										<p>
											<b>Name : </b><?php echo $row['name'] ?><br>
											<b>Price  : </b><?php echo "RM".number_format($row['price'],2) ?><br>
											<b>Adult : </b><?php echo $row['adult'] ?><br>
											<b>Kids : </b><?php echo $row['kid'] ?>
										</p>
									</td>

									<td class="text-center">
										<!-- edit button -->
										<button class="btn btn-sm btn-primary edit_cat" type="button" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['name'] ?>" data-price="<?php echo $row['price'] ?>" data-cover_img="<?php echo $row['cover_img'] ?>" data-adult="<?php echo $row['adult'] ?>" data-kid="<?php echo $row['kid'] ?>">Edit</button>
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
	//Display Uploaded Image on Form
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	//Save Room Category Detail into database
	$('#manage-category').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_category',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Room category successfully added",'success')
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
	
	// Update Room Category from database
	$('.edit_cat').click(function(){
		start_load()
		var cat = $('#manage-category')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='name']").val($(this).attr('data-name'))
		cat.find("[name='price']").val($(this).attr('data-price'))
		cat.find("[name='adult']").val($(this).attr('data-adult'))
		cat.find("[name='kid']").val($(this).attr('data-kid'))
		cat.find("#cimg").attr('src','../assets/img/'+$(this).attr('data-cover_img'))
		end_load()
	})

	// Delete Confirmation Box
	$('.delete_cat').click(function(){
		_conf("Are you sure to delete this category?","delete_cat",[$(this).attr('data-id')])
	})

	// Delete Room category Funtion from database
	function delete_cat($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_category',
			method:'POST',
			data:{id:$id},
			// if the delete success
			success:function(resp){
				if(resp==1){
					// display toast message that data is successfully deleted
					alert_toast("Room category successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}
			}
		})
	}
</script>