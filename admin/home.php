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
        
    /* Clear floats after the columns */    
    .row:after {    
    content: "";    
    display: table;    
    clear: both;    
	}   
	.gradient-text{
		background: linear-gradient(to bottom, #d1670a,#fcc651);
		-webkit-background-clip: text;
		-webkit-text-fill-color: transparent;
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
					<h2 class="text-right"><b> <?php echo $count['count'] ?> </b></h2>
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
					<h2 class="text-right"><b> <?php echo $count['count'] ?> </b></h2>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	
	<!--SPLIT STATISTIC-->
	<div class="row mt-3 ml-3 mr-3">
		<!--SPLIT 1 : STAT-->
		<div class="col-lg-9">
			<!--CUSTOMER STATISTIC-->
			<div class="col-lg-12">
				Customer Statistic
				<div class="card">
					<div class="card-body"><center>
						<div class="row">
							<div class="col-lg-4">
								<br>
								<?php 
									$cat = $conn->query("SELECT COUNT(id) as count FROM checked where status = 0");
									while($count = $cat->fetch_assoc()){
								?>
								<h3><b> <?php echo $count['count'] ?> </b></h3>
								<?php } ?>
								<label>Pending</label> 
							</div>
							<div class="col-lg-4">
								<br>
								<?php 
									$cat = $conn->query("SELECT COUNT(id) as count FROM checked where status = 1");
									while($count = $cat->fetch_assoc()){
								?>
								<h3><b> <?php echo $count['count'] ?> </b></h3>
								<?php } ?>
								<label>Check-in</label>
							</div>
							<div class="col-lg-4">
								<br>
								<?php 
									$cat = $conn->query("SELECT COUNT(id) as count FROM checked where status = 2");
									while($count = $cat->fetch_assoc()){
								?>
								<h3><b> <?php echo $count['count'] ?> </b></h3>
								<?php } ?>
								<label>Check-out</label>  
							</div>
						</div><br><br>
						<div class="row">
							<div class="col-lg-4">
								<center><i class="fa fa-users fa-4x" aria-hidden="true"></i></center>
							</div>
							<div class="col-lg-4">
								<label>Total Customers</label>    
								<?php 
									$cat = $conn->query("SELECT COUNT(id) as count FROM checked ");
									while($count = $cat->fetch_assoc()){
								?>
								<h3><b> <?php echo $count['count'] ?> </b></h3>
								<?php } ?>
							</div>
						</div></center>
					</div>
				</div>					
			</div>		
			<!--CUSTOMER STATISTIC END-->
			
			<div class="row mt-3 ml-3 mr-3">		
				<!--OVERVIEW-->		
				<div class="col-lg-12">
					Overview<br>
					<div class="row">
						<!--CARD 1-->
						<div class="col-4">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col-lg-6">
											<?php 
												$cat = $conn->query("SELECT COUNT(r.id) as count FROM rooms r JOIN room_categories c ON r.category_id =  c.id where c.name = 'Standard Single Room'");
												while($count = $cat->fetch_assoc()){
												?>
											<h3><?php echo $count['count'] ?></h3>
											<?php } ?>
											<label>Standard Single</label>
										</div>
										<div class="col-lg-6">
											<center><i class="far fa-user fa-4x"></i>
											</center>							
										</div>
									</div>
								</div>
							</div>
							<br>
						</div>
						<!--CARD 1 END-->
						<!--CARD 2-->
						<div class="col-4">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col-lg-6">
											<?php 
												$cat = $conn->query("SELECT COUNT(r.id) as count FROM rooms r JOIN room_categories c ON r.category_id =  c.id where c.name = 'Standard Twin Room'");
												while($count = $cat->fetch_assoc()){
											?>
											<h3><?php echo $count['count'] ?></h3>
											<?php } ?>
											<label>Standard Twin</label>
										</div>
										<div class="col-lg-6">
											<center>
											<i class="fa fa-venus-mars fa-4x" aria-hidden="true"></i>
											</center>								
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--CARD 2 END-->
						<!--CARD 3-->
						<div class="col-4">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col-lg-6">
											<?php 
												$cat = $conn->query("SELECT COUNT(r.id) as count FROM rooms r JOIN room_categories c ON r.category_id =  c.id where c.name = 'Deluxe Double Room'");
												while($count = $cat->fetch_assoc()){
											?>
											<h3><?php echo $count['count'] ?></h3>
											<?php } ?>
											<label>Deluxe Double</label>
										</div>
										<div class="col-lg-6">
											<center>
											<i class="far fa-heart fa-4x" aria-hidden="true"></i>
											</center>								
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--CARD 3 END-->
						<!--CARD 4-->
						<div class="col-4">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col-lg-6">
											<?php 
												$cat = $conn->query("SELECT COUNT(r.id) as count FROM rooms r JOIN room_categories c ON r.category_id =  c.id where c.name = 'Deluxe Twin Room'");
												while($count = $cat->fetch_assoc()){
											?>
											<h3><?php echo $count['count'] ?></h3>
											<?php } ?>
											<label>Deluxe Twin</label>
										</div>
										<div class="col-lg-6">
											<center>
											<i class="far fa-gem fa-4x" aria-hidden="true"></i>
											</center>								
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--CARD 4 END-->
						<!--CARD 5-->
						<div class="col-4">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col-lg-6">
											<?php 
												$cat = $conn->query("SELECT COUNT(r.id) as count FROM rooms r JOIN room_categories c ON r.category_id =  c.id where c.name = 'Family Suite'");
												while($count = $cat->fetch_assoc()){
											?>
											<h3><?php echo $count['count'] ?></h3>
											<?php } ?>
											<label>Family Suite</label>
										</div>
										<div class="col-lg-6">
											<center>
											<i class="fa fa-crown fa-4x" aria-hidden="true"></i>
											</center>								
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--CARD 5 END-->
						<!--CARD 6-->
						<div class="col-4">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col-lg-6">
											<?php 
												$cat = $conn->query("SELECT COUNT(id) as count FROM facilities ");
												while($count = $cat->fetch_assoc()){
											?>
											<h3> <?php echo $count['count']?> </h3>
											<?php } ?>
											<label>Facilities</label>
										</div>
										<div class="col-lg-6">
											<center>
											<span style="color:black"><i class="fa fa-dumbbell fa-4x" aria-hidden="true"></i></span>
											</center>								
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--CARD 6 END-->
					</div>
				</div>
				<!--OVERVIEW END-->			
			</div>
		</div>
		<!--SPLIT 1 : STAT END-->
		<!--SPLIT 2 : RATING-->
		<div class="col-lg-3"><center>
			<br>
			<!--RATING-->
			<div class="row">
				<div class="card">
					<div class="card-body">
						<div class="col-lg-12">
							<?php							
								$cat = $conn->query("SELECT FORMAT(AVG(rate),2) AS 'avg' FROM feedback");
								while($count = $cat->fetch_assoc()){
							?>
							<h1 class="gradient-text"><b>&nbsp;&nbsp; <?php echo $count['avg'] ?> &nbsp;&nbsp;</b></h1>
							<?php }?>
							<label>RATING</label>
						</div>						
					</div>
				</div>	
			</div>
			<!--RATING END-->
			<br>
			<!--RATING LIST-->
			<div class="row">
				<div class="card">
					<div class="card-body">
					<table class="table">
						<tbody>
							<?php 
							$feedback = $conn->query("SELECT SUM(rate) as 'rate' FROM feedback WHERE rate=4");
							while($row=$feedback->fetch_assoc()):
							?>
							<tr>
								<td><i class="fa fa-star" style="color: #f5bf42"></td>
								<td style="width:70%"> Excellent</td>
								<?php if(!empty($row)):?>
								<td><?php echo $row['rate'] ?></td>
								<?php else:?>
								<td>0</td>
								<?php endif;?>
							</tr>							
							<?php endwhile; ?>
							<?php 
							$feedback = $conn->query("SELECT SUM(rate) as 'rate' FROM feedback WHERE rate=3");
							while($row=$feedback->fetch_assoc()):
							?>
							<tr>
								<td><i class="fa fa-star" style="color: #f5bf42"></td>
								<td style="width:70%">Good</td>
								<?php if(is_null($row['rate'])):?>
								<td>0</td>
								<?php else:?>
								<td><?php echo $row['rate'] ?></td>
								<?php endif;?>
							</tr>							
							<?php endwhile; ?>
							<?php 
							$feedback = $conn->query("SELECT SUM(rate) as 'rate' FROM feedback WHERE rate=2");
							while($row=$feedback->fetch_assoc()):
							?>
							<tr>
								<td><i class="fa fa-star" style="color: #f5bf42"></td>
								<td style="width:70%">Neutral</td>
								<?php if(is_null($row['rate'])):?>
								<td>0</td>
								<?php else:?>
								<td><?php echo $row['rate'] ?></td>
								<?php endif;?>
							</tr>				
							</tr>							
							<?php endwhile; ?>
							<?php 
							$feedback = $conn->query("SELECT SUM(rate) as 'rate' FROM feedback WHERE rate=1");
							while($row=$feedback->fetch_assoc()):
							?>
							<tr>
								<td><i class="fa fa-star" style="color: #f5bf42"></td>
								<td style="width:70%">Poor</td>
								<?php if(is_null($row['rate'])):?>
								<td>0</td>
								<?php else:?>
								<td><?php echo $row['rate'] ?></td>
								<?php endif;?>
							</tr>				
							</tr>							
							<?php endwhile; ?>
						</tbody>
					</table>
					</div>
				</div>
			</div>
			<!--RATING LIST END-->
		</div></center>
		<!--SPLIT 2 :: RATING END-->
	</div>
	<!--SPLIT STATISTIC END-->
</div>

