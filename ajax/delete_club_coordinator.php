<?php

	include('../connection.php');

	$uid = $_POST['uid'];

	if(validate()){

		//preparing a query
		//we will be checking both email and password
		
		$check=$db->prepare('SELECT * FROM signup WHERE  (sid = ?)');
		$data=array($uid); //for below 'if' statement

		$check->execute($data);
		if($check->rowcount()==0){
			echo 0; //->> account does not exist
		}
		else{
			
			//delete if account exist
			$query=$db->prepare('DELETE FROM signup WHERE sid=?');
			$data=array($uid);

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