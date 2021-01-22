<!-- Masthead-->
<header class="masthead">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-end mb-4" style="background: #0000002e;">
                <h1 class="text-uppercase text-white font-weight-bold">Rooms</h1>
                <hr class="divider my-4" />
            </div>
        </div>
    </div>
</header>



<section class="page-section bg-dark">
		<div class="container">	
			<div class="col-lg-12">	
				<div class="card">
					<div class="card-body">	
						<form id="filter" method="POST"></form>
					</div>
				</div>	
				<hr>	
				<?php while($row=$rooms->fetch_assoc()): ?>
					<option value="<?php echo $row['id'] ?>" <?php echo $row['id'] == $rid ? "selected": '' ?>><?php echo $row['room'] . " | ". ($cat_arr[$row['category_id']]['name']) ?></option>
				<?php endwhile; ?>
				<div class="card item-rooms mb-3">
					<div class="card-body">
						<div class="row">
							<div class="col-md-5">
								<img src="assets/img/<?php echo $cat_arr[$row['id']]['cover_img'] ?>" alt="">
							</div>
							<div class="col-md-5" height="100%">
								<h3><b><?php echo 'RM '.number_format($cat_arr[$row['id']]['price'],2) ?></b><span> / per day</span></h3>

									<h4><b>
									<?php echo $fetch['id']?>	
									</b></h4>

									<div class="align-self-end mt-5">
										<a style = "margin-left:580px;" href = "index.php?page=available?id=<?php echo $fetch['id']?>" class = "btn btn-primary float-right" type="button"><i class = "glyphicon glyphicon-list"></i> Reserve</a>

									</div>
								</div>
							</div>

							</div>
						</div>
				</div>	
		</div>	
</section>
<style type="text/css">
	.item-rooms img {
    width: 23vw;
}
</style>

<script>
	$('.book_now').click(function(){
		uni_modal('Book','admin/book.php?in=<?php echo $date_in ?>&out=<?php echo $date_out ?>&cid='+$(this).attr('data-id'))
	})
</script>