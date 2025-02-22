<!-- room page -->

<?php
	$date_in = isset($_POST['date_in']) ? $_POST['date_in'] : date('Y-m-d');
	$date_out = isset($_POST['date_out']) ? $_POST['date_out'] : date('Y-m-d',strtotime(date('Y-m-d').' + 3 days'));
?>
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
					<form action="index.php?page=list" id="filter" method="POST">
			        	<div class="row">
			        		<div class="col-md-3">
			        			<label for="">Check-in Date</label>
			        			<input type="date" class="form-control" id="date_in" name="date_in" autocomplete="off" value="<?php echo isset($date_in) ? date("Y-m-d",strtotime($date_in)) : "" ?>">
			        		</div>
			        		<div class="col-md-3">
			        			<label for="">Check-out Date</label>
			        			<input type="date" class="form-control" id="date_out"name="date_out" autocomplete="off" value="<?php echo isset($date_out) ? date("Y-m-d",strtotime($date_out)) : "" ?>">
			        		</div>
			        		<div class="col-md-3">
			        			<br>
			        			<button class="btn-btn-block btn-primary mt-3">Check Availability</button>
			        		</div>

			        	</div>
			        </form>
				</div>
			</div>	

			<hr>	
			<?php 
			//Count available room (Status = 0)
			$sql = $conn->query("SELECT COUNT('id') as count FROM rooms where status = 0");
			while($counta = $sql->fetch_assoc()){
				// If there is available room (Count > 0)
				if($counta['count'] > 0){
					// select data from room categories
					$cat = $conn->query("SELECT * FROM room_categories");
					$cat_arr = array();
					while($row = $cat->fetch_assoc()){
						$cat_arr[$row['id']] = $row;
					}
					$qry = $conn->query("SELECT distinct(category_id),category_id from rooms where status = 0 and id not in (SELECT room_id from checked where '$date_in' BETWEEN date(date_in) and date(date_out) and '$date_out' BETWEEN date(date_in) and date(date_out) or  status < 2)");
					while($row= $qry->fetch_assoc()){
			?>
			<div class="card item-rooms mb-3">
				<div class="card-body">
					<div class="row">
						<div class="col-md-5">
							<img src="assets/img/<?php echo $cat_arr[$row['category_id']]['cover_img'] ?>" alt="">
						</div>
						<div class="col-md-5" height="100%">
							<h3><b><?php echo 'RM '.number_format($cat_arr[$row['category_id']]['price'],2) ?></b><span> / per day</span></h3>

							<h4><b><?php echo $cat_arr[$row['category_id']]['name'] ?></b></h4>
							<div class="align-self-end mt-5">
								<a style = "margin-left:580px;" class = "btn btn-primary float-right reservation" type="button" data-id="<?php echo $cat_arr[$row['category_id']]['id'] ?>"><i class = "glyphicon glyphicon-list"></i> Reserve</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php }}
				else{ ?>
			<div class="card item-rooms mb-3">
				<div class="card-body">
					<h4 class="text-center" style="color:red"><i><b>SORRY. NO ROOM AVAILABLE AT THIS MOMENT<b><i></h4>
				</div>
			</div>
			<?php }}?>			
		</div>	
	</div>	
</section>
<style type="text/css">
	.item-rooms img {
    width: 23vw;
}
</style>

<script>
	$('.reservation').click(function(){
		uni_modal("Available Room","admin/available.php?cid="+$(this).attr("data-id"))
	})

	// set minimum date to current date
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
// set check out date totommorow
let ttommorow = new Date(),
    ttday = ttommorow.getDate()+1,
    ttmonth = ttommorow.getMonth()+1, //January is 0
    ttyear = ttommorow.getFullYear();
         if(ttday<10){
                ttday='0'+ttday
            } 
        if(ttmonth<10){
            ttmonth='0'+ttmonth
        }
        ttommorow = ttyear+'-'+ttmonth+'-'+ttday;

        document.getElementById("date_out").setAttribute("min", ttommorow);
        document.getElementById("date_out").setAttribute("value", ttommorow);
</script>