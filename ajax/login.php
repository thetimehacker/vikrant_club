<?php

	include('../connection.php');

	session_start();

	//-->> trim all the data using a trim function
	$uname = $_POST['username'];
	$pass = $_POST['password'];
	// echo $uname.' '.$pass.' ';
	// $_SESSION['sid']=0;
	//-->> validate email and username `



	if(validate()){

		//preparing a query
		$check=$db->prepare('SELECT * FROM signup WHERE uid = ? or email = ?');

		$data=array($uname,$uname);
		//execute the query by combining data in the check table
		$check->execute($data);
		if($check->rowcount()==0){ //count will always be 0 or 1
			echo 0;
			// echo "0,1"; //->> 0 for account does not exist
		}
		else{
			
			//fetch the data from database
			$datarow=$check->fetch();

			$_SESSION['uid']=$datarow['sid'];
			$_SESSION['tid']=$datarow['tid'];
			//flag will define whether the higher authorities have allowed them or not
			if($pass==$datarow['password']){
				//valid details
				if($datarow['value']=="admin"){
					$arr="11,";
					$arr.=(string)$datarow['sid'];
					// $_SESSION=$datarow['sid'];
					echo $arr;
					// echo 11;
				}
				else if($datarow['value']=="club_coordinator"){
					$arr="12,";
					$arr.=(string)$datarow['sid'];
					echo $arr;
					// echo 12;
				}
				else if($datarow['value']=="student_coordinator"){
					$arr="13,";
					$arr.=(string)$datarow['sid'];
					// echo $arr;
					
					echo $arr;
				}
				else{
					echo 14;
				}
			}
			else {
				echo 2;
				// echo "2,1"; //invalid details
			}

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