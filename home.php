 <!-- Masthead-->
<header class="masthead">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-end mb-4">
                <div class="card" id="filter-book">
                    <div class="card-body">
                    	<div class="container-fluid">
                    		<form action="index.php?page=list" id="filter" method="POST">
                    			<div class="row">
                    				<div class="col-md-3">
                    					<label for="">Check-in Date</label>
                    					<input type="date" class="form-control" id="date_in" name="date_in" autocomplete="off">
                    				</div>
                    				<div class="col-md-3">
                    					<label for="">Check-out Date</label>
                    					<input type="date" class="form-control" id="date_out" name="date_out" autocomplete="off">
                    				</div>
                    						
                    				<div class="col-md-3">
                    					<br>
                    					<button class="btn-btn-block btn-primary mt-3">Check Availability</button>
                    				</div>
								</div>
							</form>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>


<!-- to display all the room categories available	 -->
<div style="font-family: Bahnschrift;word-spacing: 15px;letter-spacing: 5px; text-align:center;padding-top:20px; font-size:50px; color:gray">
 	<i>Welcome To RendahTecc Hotel</i>
</div>
<div id="portfolio">
    <div class="container-fluid p-0">
        <div class="row no-gutters">
            <?php 
				include'admin/db_connect.php';
				// select data from room categories table
                $qry = $conn->query("SELECT * FROM  room_categories order by rand() ");
                while($row = $qry->fetch_assoc()):
            ?>
            <div class="col-lg-4 col-sm-6" style="padding:40px">
                <a class="portfolio-box" href="#">
                <img class="img-fluid" src="assets/img/<?php echo $row['cover_img'] ?>" alt="" />
                    <div class="portfolio-box-caption">
                        <div class="project-category text-white-30"><?php echo "RM ".number_format($row['price'],2) ?> per day</div>
                        <div class="project-name"><?php echo $row['name'] ?></div>
                    </div>
                </a>
            </div>
        <?php endwhile; ?>
        </div>
    </div>
</div>


<!-- js function -->
<script>
// set minimum date to current date
let todayh = new Date(),
    dayh = todayh.getDate(),
    monthh = todayh.getMonth()+1, //January is 0
    yearh = todayh.getFullYear();
         if(dayh<10){
                dayh='0'+dayh
            } 
        if(monthh<10){
            monthh='0'+monthh
        }
        todayh = yearh+'-'+monthh+'-'+dayh;

        document.getElementById("date_in").setAttribute("min", todayh);
        document.getElementById("date_in").setAttribute("value", todayh);
        
// set check out date totommorow
 let tommorow = new Date(),
    tday = tommorow.getDate()+1,
    tmonth = tommorow.getMonth()+1, //January is 0
    tyear = tommorow.getFullYear();
         if(tday<10){
                tday='0'+tday
            } 
        if(tmonth<10){
            tmonth='0'+tmonth
        }
        tommorow = tyear+'-'+tmonth+'-'+tday;

        document.getElementById("date_out").setAttribute("min", tommorow);
        document.getElementById("date_out").setAttribute("value", tommorow);
</script>