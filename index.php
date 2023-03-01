<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="normalize.css">
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"> -->

	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
	<section>
		<div class="col-sm-12">
			<div class="col-sm-4"></div>
			
			<div class="col-sm-4">
				<div class="signupform hidden" id="signupform">
					<div class="contain_form">
						<div class="Heading">
							<h2 style="margin-bottom: 20px;">Sign Up</h2>
						</div>
						<form>
							<div class="form-group">
								<input type="text" id="email" placeholder="Email" class="form-control" required>
							</div>
							<div class="form-group">
								<input type="password" id="password1" placeholder="Password" class="form-control" required>
							</div>
							<div class="form-group">
								<input type="password" id="password2" placeholder="Confirm Password" class="form-control" required>
							</div>

							<div class="form-group">
								<input type="text" id="uid" placeholder="UID" class="form-control" >
							</div>
							
							<!-- Submit Button -->
							<div class="form-group">
								<input type="submit" value="Submit" class="btn btn-success btn-block" onclick="savedata();">
							</div>	
						</form> 
					</div>

					<div class="horizontal_line">
						<hr>
					</div>

					<div class="form-group">
						<input id="loginbutton" type="submit" value="Log In" class="btn btn-block" onclick="showlogin()" style="
							padding: 10px 10px;
						    border: 1px solid black;
							background: black;
						    color: white;
						    border-radius: 10px;
						    text-decoration: none;
						    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
						">
					</div>	
				</div>
				<div class="loginform" id="loginform">
					<div class="contain_login_form">
						<div class="Heading">
							<h2 style="margin-bottom: 20px;">Log In</h2>
						</div>
						<form >
							<div class="form-group">
								<input type="text" id="username" placeholder="Uid / Email" class="form-control" required>
							</div>
							<div class="form-group">
								<input type="password" id="password" placeholder="Password" class="form-control" required>
							</div>

							<!-- Submit Button -->
							<div class="form-group">
								<input type="submit" value="Submit" class="btn btn-success btn-block" onclick="savelogindata();">
							</div>	

						</form> 
					</div>
					<div class="horizontal_line">
						<hr>
					</div>

					<div class="form-group">
						<input id="signupbutton" type="submit" value="Create Account" class="btn btn-block" onclick="showsignup()" style="
							padding: 10px 10px;
						    border: 1px solid black;
							background: black;
						    color: white;
						    border-radius: 10px;
						    text-decoration: none;
						    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
						">
					</div>	
				</div>
			</div>
			
			<div class="col-sm-4"></div>
		</div>
	</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
	function showlogin()
	{
		var login=document.getElementById('loginform');
		var signup=document.getElementById('signupform');
		signup.classList.add('hidden');
		login.classList.remove('hidden');
		login.classList.add('show');
	}
	function showsignup()
	{
		var login=document.getElementById('loginform');
		var signup=document.getElementById('signupform');
		login.classList.add('hidden');
		signup.classList.remove('hidden');
		signup.classList.add('show');
	}
	function savedata(){
		// var username=document.getElementById('username').value;
		var pass1=document.getElementById('password1').value;
		var pass2=document.getElementById('password2').value;
		var email=document.getElementById('email').value;
		var uid=document.getElementById('uid').value;

		if(pass1!="" && pass1==pass2 && email!="" && uid!=""){
			
			//sending data to backend
			//using ajax post
			// alert('sending data');
			$.ajax(
			{
				type:"POST",
				url:"ajax/signup.php",
				data:{password:pass1,email:email, uid:uid},
				success:function(data){
					//we are getting the result in form of data from the signup php
					if(data == 0){
						alert('User already exists! Please login');
						showlogin();
					}
					else if(data == 1){
						//account created
						alert('Successfully created account!!!');

						//--->to go to login page
						//Approach 1 -- opens in same window
						// window.location.href = "login.php";

						//Approach 2 -- opens in a new window
						// open("login.php");

						//solution to Approach 2
						// open("login.php","_self");
						showlogin();

					}
					else if(data == 2){
						alert('Some problem encountered!');
					}
					else if(data == 3){
						alert('Inside validation');
					}
					else{
						alert(data);
					}
				}
			}
			);

		}
		else 
		{
			alert("Invalid Input!");
		}
		
	}
	function savelogindata(){
		var username=document.getElementById('username').value;
		var password=document.getElementById('password').value;

		// alert(username);
		if(username!="" && password!=""){
			
			//sending data to backend
			//using ajax post
			// alert('sending data');
			$.ajax(
			{
				type:"POST",
				url:"ajax/login.php",
				data:{username:username,password:password},
				success:function(data){

					var response = data.split(",");
					var first = response[0];
				  	var second = response[1];

					//we are getting the result in form of data from the login php
					if(data==0){
						alert('Account Does not exist!');
					}
					else if(data==2){
						alert('Invalid details!!');
					}
					else if(first=="11"){
						//account created for admin
						// alert('Valid Details!! ADMIN');

						//--->to go to login page
						//Approach 1 -- opens in same window
						// window.location.href = "login.php";

						//Approach 2 -- opens in a new window
						// open("login.php");

						//solution to Approach 2
						// alert(second);
						
						open("newadmin.php","_self");

					}
					else if(first=="12"){
						//account created
						// alert('Valid Details!! CLUB COORDINATOR');

						open("clubcoordinator.php","_self");

					}
					else if(first=="13"){
						//account created
						

						alert(second);

						open("newstudentcoordinator.php","_self");
					}
					else if(data==14){
						//account created
						alert('Valid Details!! student');

						// open("login.php","_self");

					}
					else{
						alert(data);
					}
				}
			}
			);

		}
		else 
		{
			alert("Invalid Input!");
		}
		
	}
</script>
<script type="text/javascript">
    $('form').submit(function(e) {
    e.preventDefault();
});</script>
</body>
</html>
