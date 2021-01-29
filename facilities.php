<!-- to display all the available facilities in the rendahtecc hotel -->

<!-- Masthead-->
<header class="masthead">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-end mb-4" style="background: #0000002e;">
                <h1 class="text-uppercase text-white font-weight-bold">Facilities</h1>
                <hr class="divider my-4" />
            </div>
        </div>
    </div>
</header>


<!-- to display all available facilities -->
<div id="portfolio">
    <div class="container-fluid p-0">
        <div class="row no-gutters">
            <?php 
				include'admin/db_connect.php';
                // select data from room facilities table
                // check the condition, it will display if status = 0 (Available)
                $qry = $conn->query("SELECT * FROM  facilities where status = 0 ");
                while($row = $qry->fetch_assoc()):
            ?>
                    
            <div class="col-lg-4 col-sm-6" style="padding:40px">
                <a class="portfolio-box" href="#">
                    <img class="img-fluid" src="assets/img/<?php echo $row['cover_img'] ?>" alt="" />
                    <div class="portfolio-box-caption">
                        <div class="project-name"><?php echo $row['name'] ?></div>
                    </div>
                </a>
            </div>
            <?php endwhile; ?>
        </div>
     </div>
</div>