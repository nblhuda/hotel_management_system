<!-- to display feedback from customers -->
<?php include('db_connect.php'); ?>
<div class="container-fluid">
		<div class="row mt-3">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<table class="table table-bordered">
							<thead class="text-center">
								<th>#</th>
                                <th>Feedback</th>
                                <th>Rate</th>
								<th>Date</th>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$feedback = $conn->query("SELECT * FROM feedback");
								while($row=$feedback->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td style="width:70%"><?php echo $row['feedback'] ?></td>
									<td class="text-center">
										<?php
											$r=$row['rate'];
											if ($r == "4") {
												echo "Excellent";
											}elseif ($r=="3"){
												echo "Good";
											}elseif ($r=="2"){
												echo "Neutral";
											}elseif ($r=="1"){
												echo "Poor";
											}
										?>
									</td>
									
									<td class="text-center"><?php echo $row['date_updated'] ?></td>
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



