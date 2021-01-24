<?php
	include('db_connect.php');
?>
<style>
	.custom-menu {
        z-index: 1000;
	    position: absolute;
	    background-color: #ffffff;
	    border: 1px solid #0000001c;
	    border-radius: 5px;
	    padding: 8px;
	    min-width: 13vw;
	}
	a.custom-menu-list {
    	width: 100%;
    	display: flex;
    	color: #4c4b4b;
    	font-weight: 600;
    	font-size: 1em;
    	padding: 1px 11px;
	}
	span.card-icon {
    	position: absolute;
    	font-size: 3em;
    	bottom: .2em;
    	color: #ffffff80;
	}
	.file-item{
		cursor: pointer;
	}
	a.custom-menu-list:hover,.file-item:hover,.file-item.active {
    	background: #80808024;
	}
	table th,td{
		/*border-left:1px solid gray;*/
	}
	a.custom-menu-list span.icon{
		width:1em;
		margin-right: 5px
	}
	.candidate {
    	margin: auto;
    	width: 23vw;
    	padding: 0 10px;
    	border-radius: 20px;
    	margin-bottom: 1em;
    	display: flex;
    	border: 3px solid #00000008;
    	background: #8080801a;

	}
	.candidate_name {
    	margin: 8px;
    	margin-left: 3.4em;
    	margin-right: 3em;
    	width: 100%;
	}
	.img-field {
	    display: flex;
	    height: 8vh;
	    width: 4.3vw;
	    padding: .3em;
	    background: #80808047;
	    border-radius: 50%;
	    position: absolute;
	    left: -.7em;
	    top: -.7em;
	}
	
	.candidate img {
    height: 100%;
    width: 100%;
    margin: auto;
    border-radius: 50%;
	}
	.vote-field {
    	position: absolute;
    	right: 0;
    	bottom: -.4em;
	}
	.col-25 {    
    float: left;    
    width: 30%;    
	margin-top: 6px;  
	text-align:center;  
    }    
        
    /* Clear floats after the columns */    
    .row:after {    
    content: "";    
    display: table;    
    clear: both;    
    }    
</style>

<div class="containe-fluid">

	<div class="row">
		<div class="col-lg-12">
			<div class="card col-md-4 offset-2 bg-info float-left">
				 <!--COUNT ROOM THAT IS BOOKED status = 0-->
				<div class="card-body text-white">
					<h4><b>On-Booking</b></h4>
					<hr>
					<span class="card-icon"><i class="fa fa-users"></i></span>
					<?php 
						$cat = $conn->query("SELECT COUNT(id) as count FROM checked where status = 0");
						while($count = $cat->fetch_assoc()){
					?>
					<h3 class="text-right"><b> <?php echo $count['count'] ?> </b></h3>
					<?php } ?>
				</div>
			</div>

			 <!--COUNT ROOM THAT IS VACANT status = 1-->
			<div class="card col-md-4 offset-2 bg-primary ml-4 float-left">
				<div class="card-body text-white">
					<h4><b>Checked-In</b></h4>
					<hr>
					<span class="card-icon"><i class="fa fa-user-tie"></i></span>
					<?php 
						$cat = $conn->query("SELECT COUNT(id) as count FROM checked where status = 1");
						while($count = $cat->fetch_assoc()){
					?>
					<h3 class="text-right"><b> <?php echo $count['count'] ?> </b></h3>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>

	<div class="row mt-3 ml-3 mr-3">
			<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					Customer Statistics	
					<div class="row">   
						<div class="col-25">   
							<label>Pending</label>    
							<?php 
								$cat = $conn->query("SELECT COUNT(id) as count FROM checked where status = 0");
								while($count = $cat->fetch_assoc()){
							?>
							<h3><b> <?php echo $count['count'] ?> </b></h3>
							<?php } ?>
                		</div>    
                		<div class="col-25">    
							<label>Check-in</label> 
							<?php 
								$cat = $conn->query("SELECT COUNT(id) as count FROM checked where status = 1");
								while($count = $cat->fetch_assoc()){
							?>
							<h3><b> <?php echo $count['count'] ?> </b></h3>
							<?php } ?>
                		</div> 
						<div class="col-25">    
							<label>Check-out</label>    
							<?php 
								$cat = $conn->query("SELECT COUNT(id) as count FROM checked where status = 2");
								while($count = $cat->fetch_assoc()){
							?>
							<h3><b> <?php echo $count['count'] ?> </b></h3>
							<?php } ?>
                		</div> 
						
						   
                	</div>  			
					<br><br>					
					<div class="row">   
						<div class="col-25">   
							<i class="fa fa-users fa-4x" aria-hidden="true"></i> 
                		</div> 
						<div class="col-25">  
						<label>Total Customers</label>    
							<?php 
								$cat = $conn->query("SELECT COUNT(id) as count FROM checked ");
								while($count = $cat->fetch_assoc()){
							?>
							<h3><b> <?php echo $count['count'] ?> </b></h3>
							<?php } ?>
						</div>
					</div>
					<br><br>
					<table class="table table-bordered">
						<thead>
							<th>#</th>
							<th>About</th>
							<th>Total</th>
						</thead>
						<tbody>
							<?php 
								$i = 1;
								$where = '';
							?>
							<tr>
								<td class="text-center"><?php echo $i++ ?></td>
								<td>Room Category</td>
								<td>
								<?php 
								$cat = $conn->query("SELECT COUNT(id) as count FROM room_categories ");
									while($count = $cat->fetch_assoc()){
								?>
								<h5><?php echo $count['count'] ?></h5>
								<?php } ?>
								</td>
							</tr>

							<tr>
								<td class="text-center"><?php echo $i++ ?></td>
								<td>Rooms</td>
								<td>
								<?php 
								$cat = $conn->query("SELECT COUNT(id) as count FROM rooms ");
									while($count = $cat->fetch_assoc()){
								?>
								<h5><?php echo $count['count'] ?></h5>
								<?php } ?>
								</td>
							</tr>

							
							<tr>
								<td class="text-center"><?php echo $i++ ?></td>
								<td>Facilities</td>
								<td>
								<?php 
								$cat = $conn->query("SELECT COUNT(id) as count FROM facilities ");
									while($count = $cat->fetch_assoc()){
								?>
								<h5><?php echo $count['count'] ?></h5>
								<?php } ?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
