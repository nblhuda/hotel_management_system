<!-- login page for admin and staff -->
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1.0" name="viewport">
		<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<title>Admin | RendahTecc Hotel Management System</title>
		

		<?php include('./header.php'); ?>
		<?php include('./db_connect.php'); ?>
		<?php 
			session_start();
			if(isset($_SESSION['login_id']))
			header("location:index.php?page=home");

			$query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
			foreach ($query as $key => $value) {
				if(!is_numeric($key))
					$_SESSION['setting_'.$key] = $value;
			}
		?>
	</head>

	<!-- style for login form -->
	<style>
		body{
		background:linear-gradient(rgba(0, 0, 50, 0.5), rgba(0, 0, 50, 0.5 )), url(assets/img/bg-01.jpg);
		background-size:cover;
		background-position:center;
	}

	.login-box{
		max-width:800px;
		float:none;
		margin:150px auto;
		text-align: center;
		padding-left: 200px;
	}

	.login-left{
		background:#fff;
		padding:60px;
	}
	</style>

	<!-- login form -->
	<body>
  		<div class="container">
            <div class="login-box">
                <div class="row">
                    <div class="col-md-8 login-left">
                        <h2>Login Here</h2>
                    	<form id="login-form" >
							<div class="form-group">
								<label>Username</label>
								<input type="text" id="username" name="username" class="form-control" required>
								</div>

								<div class="form-group">
									<label>Password</label>
									<input type="password" id="password" name="password" class="form-control" required>
								</div>
								<div class="text-center">
									<center><button class="btn-sm btn-block btn-wave col-md-4 btn-primary">Login</button></center>
							</div>  
						</form>
					</div>
				</div>
			</div>
    	</div>
	</body>
	
	<!-- js function -->
	<script>
		$('#login-form').submit(function(e){
			e.preventDefault()
			$('#login-form button[type="button"]').attr('disabled',true).html('Logging in...');
			if($(this).find('.alert-danger').length > 0 )
				$(this).find('.alert-danger').remove();
			$.ajax({
				url:'ajax.php?action=login',
				method:'POST',
				data:$(this).serialize(),
				error:err=>{
					console.log(err)
			$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

		},

				// if success to login
				success:function(resp){
					if(resp == 1){
						location.href ='index.php?page=home';
					}else if(resp == 2){
						location.href ='index.php?page=home';
					}else{
						$('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
						$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
					}
				}
			})
		})
	</script>	
</html>