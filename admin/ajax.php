<?php
	ob_start();
	$action = $_GET['action'];
	include 'admin_class.php';
	$crud = new Action();

	if($action == 'login'){
		$login = $crud->login();
		if($login)
			echo $login;
	}
	if($action == 'logout'){
		$logout = $crud->logout();
		if($logout)
			echo $logout;
	}
	if($action == 'save_user'){
		$save = $crud->save_user();
		if($save)
			echo $save;
	}
	if($action == "save_settings"){
		$save = $crud->save_settings();
		if($save)
			echo $save;
	}
	if($action == "save_category"){
		$save = $crud->save_category();
		if($save)
			echo $save;
	}
	if($action == "delete_category"){
		$save = $crud->delete_category();
		if($save)
			echo $save;
	}
	if($action == "save_room"){
		$save = $crud->save_room();
		if($save)
			echo $save;
	}
	if($action == "delete_room"){
		$save = $crud->delete_room();
		if($save)
			echo $save;
	}
	if($action == 'cancel_checkin'){
		$save = $crud->cancel_check_in();
		if($save)
			echo $save;
	}
	if($action == 'save_check'){
		$save = $crud->save_check_in();
		if($save)
			echo $save;
	}

	if($action == 'save_checkin'){
		$save = $crud->save_checkin();
		if($save)
			echo $save;
	}
	
	if($action == "save_checkout"){
		$save = $crud->save_checkout();
		if($save)
			echo $save;
	}
	if($action == "save_book"){
		$save = $crud->save_book();
		if($save)
			echo $save;
	}
	if($action == "save_facility"){
		$save = $crud->save_facility();
		if($save)
			echo $save;
	}
	if($action == "delete_facility"){
		$save = $crud->delete_facility();
		if($save)
			echo $save;
	}
	if($action == "save_feedback"){
		$save = $crud->save_feedback();
		if($save)
			echo $save;
	}

	if($action == "delete_user"){
		$save = $crud->delete_user();
		if($save)
			echo $save;
	}
?>

