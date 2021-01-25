<!DOCTYPE html>
<html lang="en">
  <title>RendahTecc Hotel</title>

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
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=team">Our Team</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=feedback">Feedback</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-body text-white">
    </div>
  </div>
  <div id="preloader"></div>
        <div class="modal fade" id="uni_modal" role='dialog'>
      <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>
        
        <!-- include homepage in this header -->
        <?php 
        $page = isset($_GET['page']) ?$_GET['page'] : "home";
        include $page.'.php';
        ?>

        <!--  footer -->
        <footer class="bg-light py-5">
            <div class="container">
              <div>
                Contact Us <br><br>
                <table>
                  <?php echo html_entity_decode($_SESSION['setting_hotel_name']) ?>

                  <tr>
                    <td style="width:20%;">Address</td>
                    <td style="color:red;"><?php echo html_entity_decode($_SESSION['setting_hotel_address']) ?></td>   
                  </tr>


                  <tr>
                    <td>Email</td>
                    <td><a href="mailto:<?php echo html_entity_decode($_SESSION['setting_email']) ?>"><?php echo html_entity_decode($_SESSION['setting_email']) ?></a></td>
                  </tr>

                  <tr>
                    <td>Phone</td>
                    <td><a href="tel:<?php echo html_entity_decode($_SESSION['setting_contact']) ?>"><?php echo html_entity_decode($_SESSION['setting_contact']) ?></a></td>
                  </tr>

                  <tr>
                    <td>Fax</td>
                    <td style="color:red;"><?php echo html_entity_decode($_SESSION['setting_fax']) ?></td>   
                  </tr>

                </table>
              </div>
              <br>
              <div class="small text-center text-muted">
                <p>&copy; 2021 by RendahTecc Hotel Mangement System | For Educational Porpose Only</p>
              </div>
            </div>
        </footer>
        
       <?php include('footer.php') ?>
    </body>
    <script>
      window.start_load = function(){
    $('body').prepend('<di id="preloader2"></di>')
  }
  window.end_load = function(){
    $('#preloader2').fadeOut('fast', function() {
        $(this).remove();
      })
  }

  window.uni_modal = function($title = '' , $url=''){
    start_load()
    $.ajax({
        url:$url,
        error:err=>{
            console.log()
            alert("An error occured")
        },
        success:function(resp){
            if(resp){
                $('#uni_modal .modal-title').html($title)
                console.log(resp)
                $('#uni_modal .modal-body').html(resp)
                $('#uni_modal').modal('show')            
                end_load()                
            }
        }
    })
}
window.alert_toast= function($msg = 'TEST',$bg = 'success'){
      $('#alert_toast').removeClass('bg-success')
      $('#alert_toast').removeClass('bg-danger')
      $('#alert_toast').removeClass('bg-info')
      $('#alert_toast').removeClass('bg-warning')

    if($bg == 'success')
      $('#alert_toast').addClass('bg-success')
    if($bg == 'danger')
      $('#alert_toast').addClass('bg-danger')
    if($bg == 'info')
      $('#alert_toast').addClass('bg-info')
    if($bg == 'warning')
      $('#alert_toast').addClass('bg-warning')
    $('#alert_toast .toast-body').html($msg)
    $('#alert_toast').toast({delay:3000}).toast('show');
  }
  $(document).ready(function(){
    $('#preloader').fadeOut('fast', function() {
        $(this).remove();
      })
  })
    </script>
    <?php $conn->close() ?>

</html>
