<?php

	include('../connection.php');
	session_start();
	//-->> trim all the data using a trim function
	$uid = $_POST['uid'];
	$pass = $_POST['password'];
	// $c_value= $_POST['c_value'];
	$email= $_POST['email'];
	$cvalue="student_coordinator";
	$tid=$_SESSION['uid'];
	// echo $uname.' '.$pass.' '.$c_value.' '.$email;

	//-->> validate email and username 



	if(validate()){

		//preparing a query
		//we will be checking both email and password
		
		$check=$db->prepare('SELECT * FROM signup WHERE  email = ? OR uid = ?');
		$data=array($email,$uid); //for below 'if' statement
		
		//we want email and username both unique ... thats why we used email and username in prepare query

		//execute the query by combining data in the check table
		$check->execute($data);
		if($check->rowcount()==1){
			echo 0; //->> 0 for already exist account
		}
		else{
			
			//we will create a new account
			//encrypt the password
			//-->>> $password1_hash=password_hash($pass,PASSWORD_DEFAULT); <-- bhaiya file

			//creating a new query
			$query=$db->prepare("INSERT INTO signup(password, email, uid, value,tid) VALUES (?,?,?,?,?)");
			$data=array($pass,$email,$uid,$cvalue,$tid);

			//execute 
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