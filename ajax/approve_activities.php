<?php

	include('../connection.php');

	$uid = $_POST['uid'];
	// $email= $_POST['email'];

	if(validate()){

		//preparing a query
		//we will be checking both email and password
		
		$check=$db->prepare('SELECT * FROM activity WHERE  aid = ?');
		$data=array($uid); //for below 'if' statement

		$check->execute($data);
		if($check->rowcount()==0){
			echo 0; //->> account does not exist
		}
		else{
			
			//update if account exist
			$query=$db->prepare('UPDATE activity SET flag=? WHERE aid=?');
			$datarow=$check->fetch();
			$flagvalue=$datarow['flag'];
			if($flagvalue=="0")
			$data=array(1,$uid);
			else 
			$data=array(0,$uid);

			//execute 
			if($query->execute($data)){
				echo 1; //account deleted
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