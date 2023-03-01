<?php

	include('../connection.php');

	session_start();

	$club_name= $_POST['club_name'];
	$description= $_POST['description'];

	

	//-->> validate email and username 



	if(validate()){

		
		$check=$db->prepare('SELECT * FROM club WHERE  clubname = ?');
		$data=array($club_name); 

		$check->execute($data);
		if($check->rowcount()==1){
			echo 0; //already exist
		}
		else{
			$query=$db->prepare("INSERT INTO club(sid,clubname, clubdesc) VALUES (?,?,?)");
			$data=array($_SESSION['uid'],$club_name,$description);

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