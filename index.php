<!DOCTYPE html>
<html lang="en">
  <title>Home | RendahTecc Hotel</title>

  <?php
    session_start();
    // include alll the header.php page
    include('header.php');
    include('admin/db_connect.php');

    // select from database system_setting
    // to fetch from setting databse and display to home page
    $query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
    
  ?>

    <style>
    	header.masthead {
		  background: url(assets/img/<?php echo $_SESSION['setting_cover_img'] ?>);
		  background-repeat: no-repeat;
		  background-size: cover;
		}
    </style>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav"> 
            <div class="container">
            <img class="nav-link js-scroll-trigger" src="images/logo2.png" alt="RendahTecc Hotel" width="auto" height="70">
                <b>RendahTecc Hotel System</b>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=home">Home</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=list">Rooms</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=facilities">Facilities</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=about">About</a></li>
                    </ul>
                </div>
            </div>
        </nav>
       

        <!-- include homepage in this header -->
        <?php 
        $page = isset($_GET['page']) ?$_GET['page'] : "home";
        include $page.'.php';
        ?>

        <!--  footer -->
        <footer class="bg-light py-5">
            <div class="container"><div class="small text-center text-muted">RendahTecc Hotel Mangement system | For Educational Porpose Only</div></div>
        </footer>
        
       <?php include('footer.php') ?>
    </body>

    <?php $conn->close() ?>

</html>
