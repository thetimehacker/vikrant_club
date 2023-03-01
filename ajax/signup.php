<?php

	include('../connection.php');

	//-->> trim all the data using a trim function

	$pass = $_POST['password'];
	// $c_value= $_POST['c_value'];
	$email= $_POST['email'];
	$uid=$_POST['uid'];

	if(validate()){

		$check=$db->prepare('SELECT * FROM signup WHERE  email = ? OR uid = ?');
		$data=array($email,$uid);
	
		$check->execute($data);
		if($check->rowcount()==1){ 
			echo 0; //->> 0 for already exist account
		}
		else{
			
			//insert values in db
			$query=$db->prepare("INSERT INTO signup(password,email,uid) VALUES (?,?,?)");
			$data=array($pass,$email,$uid);

			if($query->execute($data)){
				//->>> starting a session -- bhaiya file
				// $_SESSION['user_name'] = $uname;	
				echo 1;
			}
			else echo 2;
		}

	}

	//trim function
	function trim_data(){
		//-->> to complete this function
	}

	function validate(){
		//-->> to complete this function
		return true;
	}

?>