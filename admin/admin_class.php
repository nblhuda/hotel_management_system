<?php
session_start();
Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include 'db_connect.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function login(){
		extract($_POST);
		$qry = $this->db->query("SELECT * FROM users where username = '".$username."' and password = '".$password."' ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'passwors' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
			if($_SESSION['login_type'] == 1)
				return 1;
			else
				return 2;
		}else{
			return 3;
		}
	}
	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}

	// save the staff details into users database
	function save_user(){
		extract($_POST);
		$data = " name = '$name' ";
		$data .= ", username = '$username' ";
		$data .= ", password = '$password' ";
		$data .= ", type = '$type' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set ".$data);
		}else{
			$save = $this->db->query("UPDATE users set ".$data." where id = ".$id);
		}
		if($save){
			return 1;
		}
	}

	// to save all the site setting details into system_settings database
	function save_settings(){
		extract($_POST);
		$data = " hotel_name = '$name' ";
		$data .= ", hotel_address = '$address' ";
		$data .= ", email = '$email' ";
		$data .= ", contact = '$contact' ";
		$data .= ", fax = '$fax' ";
		$data .= ", about_content = '".htmlentities(str_replace("'","&#x2019;",$about))."' ";
		if($_FILES['img']['tmp_name'] != ''){
						$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
						$move = move_uploaded_file($_FILES['img']['tmp_name'],'../assets/img/'. $fname);
					$data .= ", cover_img = '$fname' ";

		}
		
		// echo "INSERT INTO system_settings set ".$data;
		$chk = $this->db->query("SELECT * FROM system_settings");
		if($chk->num_rows > 0){
			$save = $this->db->query("UPDATE system_settings set ".$data." where id =".$chk->fetch_array()['id']);
		}else{
			$save = $this->db->query("INSERT INTO system_settings set ".$data);
		}
		if($save){
		$query = $this->db->query("SELECT * FROM system_settings limit 1")->fetch_array();
		foreach ($query as $key => $value) {
			if(!is_numeric($key))
				$_SESSION['setting_'.$key] = $value;
		}

			return 1;
				}
	}

	// to save all the room categories into room_categories database
	function save_category(){
		extract($_POST);
		$data = " name = '$name' ";
		$data .= ", price = '$price' ";
		$data .= ", adult = '$adult' ";
		$data .= ", kid = '$kid' ";
		if($_FILES['img']['tmp_name'] != ''){
						$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
						$move = move_uploaded_file($_FILES['img']['tmp_name'],'../assets/img/'. $fname);
					$data .= ", cover_img = '$fname' ";

		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO room_categories set ".$data);
		}else{
			$save = $this->db->query("UPDATE room_categories set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}

	// to delete room category from room_categories database
	function delete_category(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM room_categories where id = ".$id);
		if($delete)
			return 1;
	}

	// insert the room data to the database [rooms]
	function save_room(){
		extract($_POST);
		$data = " room = '$room' ";
		$data .= ", category_id = '$category_id' ";
		$data .= ", status = '$status' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO rooms set ".$data);
		}else{
			$save = $this->db->query("UPDATE rooms set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}

	// delete the data from database [rooms]
	function delete_room(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM rooms where id = ".$id);
		if($delete)
			return 1;
	}

	// insert the facilities data to the database [facilities]
	function save_facility(){
		extract($_POST);
		$data = " name = '$name' ";
		$data .= ", status = '$status' ";
		if($_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'../assets/img/'. $fname);
		$data .= ", cover_img = '$fname' ";
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO facilities set ".$data);
		}else{
			$save = $this->db->query("UPDATE facilities set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}

	// delete the data from database [facilities]
	function delete_facility(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM facilities where id = ".$id);
		if($delete)
			return 1;
	}
	
	// insert the customers data to the database when they want to book or check-in to the hotel [checked]
	function save_check_in(){		
		extract($_POST);
		$data = " room_id = '$rid' ";
		$data .= ", name = '$name' ";
		$data .= ", contact_no = '$contact_no' ";
		$data .= ", date_in = '".$date_in.' '.$date_in_time."' ";
		$out= date("Y-m-d H:i",strtotime($date_in.' '.$date_in_time.' +'.$days.' days'));
		$data .= ", date_out = '$out' ";		
		$data .= ", status = 0 ";

		if(empty($id)){
			$save = $this->db->query("INSERT INTO checked set ".$data);			
			$id=$this->db->insert_id;						
		}else{
			$save = $this->db->query("UPDATE checked set ".$data." where id=".$id);
		}
		if($save){
			$this->db->query("UPDATE rooms set status = 1 where id=".$rid);			
			return $id;
		}
	}

	//set the status to 1 if the customer want to check-in [checked]
	function save_checkin(){
		extract($_POST);
			$save = $this->db->query("UPDATE checked set status = 1 where id=".$id);
			if($save){
				return 1;
			}
	}

	//set the status to 2 if the customer want to check-out [checked]
	function save_checkout(){
		extract($_POST);
			$save = $this->db->query("UPDATE checked set status = 2 where id=".$id);
			if($save){

				$this->db->query("UPDATE rooms set status = 0 where id=".$rid);
						return 1;
			}
	}

	//change the status set to 3 from database [checked]
	function cancel_check_in(){
		extract($_POST);
			$save = $this->db->query("UPDATE checked set status = 3 where id=".$id);
			if($save){

				$this->db->query("UPDATE rooms set status = 0 where id=".$rid);
						return 1;
			}
	}

	function save_book(){
		extract($_POST);
		$data = " booked_cid = '$cid' ";
		$data .= ", name = '$name' ";
		$data .= ", contact_no = '$contact' ";
		$data .= ", status = 0 ";

		$data .= ", date_in = '".$date_in.' '.$date_in_time."' ";
		$out= date("Y-m-d H:i",strtotime($date_in.' '.$date_in_time.' +'.$days.' days'));
		$data .= ", date_out = '$out' ";
		$i = 1;
		while($i== 1){
			$ref  = sprintf("%'.04d\n",mt_rand(1,9999999999));
			if($this->db->query("SELECT * FROM checked where ref_no ='$ref'")->num_rows <= 0)
				$i=0;
		}
		$data .= ", ref_no = '$ref' ";

			$save = $this->db->query("INSERT INTO checked set ".$data);
			$id=$this->db->insert_id;
		
		if($save){
			return $id;
		}
	}

	//insert the feedback details into the database [feedback]
	function save_feedback(){
		extract($_POST);
		$data = " rate = '$rate' ";
		$data .= ", feedback = '$feedback' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO feedback set ".$data);
		}else{
			$save = $this->db->query("UPDATE feedback set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}

	// delete the user from database [users]
	function delete_user(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM users where id = ".$id);
		if($delete)
			return 1;
	}
}	