<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$uname = $_POST['uname'];
  $password = $_POST['password'];
  $email = $_POST['email'];
   

	$sql = "INSERT INTO users (username, password, email) VALUES ('$uname','$password','$email')";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added";
		
		print"<script>";
	header("location:../setting.php");
			
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the members";
	}
	 

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST