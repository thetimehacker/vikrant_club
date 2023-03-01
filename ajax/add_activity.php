<?php

	include('../connection.php');

	session_start();
	//-->> trim all the data using a trim function
	$title= $_POST['title'];
	$date= $_POST['date'];
	// $venue= $_POST['venue'];
	// $eligibility= $_POST['eligibility'];
	$description= $_POST['description'];

	$tid=$_SESSION['tid'];

	//-->> validate email and username 



	if(validate()){

		
		$check=$db->prepare('SELECT * FROM activity WHERE  aname = ? and sid=?');
		$data=array($title,$_SESSION['uid']); 

		$check->execute($data);
		if($check->rowcount()==1){
			echo 0; //already exist
		}
		else{
			

			//creating a new query
			$query=$db->prepare("INSERT INTO activity(tid,sid,aname, date, description) VALUES (?,?,?,?,?)");
			$data=array($tid,$_SESSION['uid'],$title,$date,$description);

			//execute 
			if($query->execute($data)){
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