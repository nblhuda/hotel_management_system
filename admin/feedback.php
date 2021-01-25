<?php include('db_connect.php'); ?>
<div class="container-fluid">
	
		<div class="row mt-3">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<table class="table table-bordered">
							<thead>
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
									<td><?php echo $row['rate'] ?></td>
									<td class=""><?php echo $row['date_updated'] ?></td>
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



