<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link rel="stylesheet" type="text/css" href="normalize.css">
  <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
  
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <style >
table {
border-collapse: collapse;
width: 100%;
/*overflow: auto;*/
color: #588c7e;
font-family: monospace;
font-size: 20px;
text-align: left;
}
th {
background-color: #588c7e;
color: white;
padding: 0 15px;
}
tr:nth-child(even) {background-color: #f2f2f2}
td{
	padding: 0 15px;
}
</style>
<style>
body {
  margin: 0;
  font-family: "Lato", sans-serif;
}

.sidebar {
  margin: 0;
  padding: 0;
  width: 200px;
  background-color: black;
  position: fixed;
  height: 100%;
  overflow: auto;
  font-size: 20px;
}

.sidebar a {
  display: block;
  color: white;
  padding: 16px;
  text-decoration: none;
}
 
.sidebar a.active {
  background-color: white;
  color: black;
}

.sidebar a:hover:not(.active) {
  background-color: #555;
  color: white;
}

div.content {
  margin-left: 200px;
  padding: 1px 16px;
  /*height: 1000px;*/
}

@media screen and (max-width: 700px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
  .sidebar a {float: left;}
  div.content {margin-left: 0;}
}

@media screen and (max-width: 400px) {
  .sidebar a {
    text-align: center;
    float: none;
  }
}
</style>
</head>
<body> 
  

<div class="sidebar">
  <a class="active" href="#home">Home</a>
  <a href="index.php">Sign Out</a>
</div>

<div class="content">
  <section id="adminform" class="section_class">

					<!-- //all club coordinators -->
		

			<!-- //new row -->
		<div class="col-sm-12">

			<div class="col-sm-6">
				
					<!-- Add a new activity -->
				<div class="add_club_coordinator" style="margin-bottom: 20px;">
					<div class="admin_heading">
						<h1 style="text-align: center;">Add a New Activity</h1>
					</div>
					<form id="activityform">
						<div class="form-group">
							<input type="text" id="title" placeholder="Title" class="form-control" required>
						</div>
						<div class="form-group">
							<input type="date" placeholder="dd/mm/yyyy"id="date" class="form-control" required>
						</div>
						<div class="form-group">
							<input type="text" id="venue" placeholder="Venue" class="form-control" required>
						</div>
						<div class="form-group">
							<input type="text" id="eligibility" placeholder="Eligibility" class="form-control" required>
						</div>
						<div class="form-group">
							<textarea id="description" placeholder="Description" class="form-control" required rows="4"></textarea>
						</div>
						<div class="form-group">
							<input type="submit" value="Submit" class="btn btn-success btn-block" onclick="savedata();">
						</div>	
					</form>
				</div>

			</div>
			
			<div class="col-sm-6">



			</div>

		</div>
	<div class="col-sm-12">

			<div class="admin_tick" style="text-align: left;margin-bottom: 20px;">
				<div class="admin_heading" style="margin-bottom: 20px;">
					<h1 style="text-align: center;">Approved Activities</h1>
				</div>
				<!-- //create php  -->
				<!-- <h4 style="text-align: center;">Remove Club coordinator</h4> -->
			
				<!-- </table> -->
				<?php
					session_start();
					
					include('connection.php');
					$check=$db->prepare('SELECT * FROM activity where (tid=? and flag=1) Order by date ASC');
					$data=array($_SESSION['tid']);
					$check->execute($data);
					if($check->rowcount()==0){
						echo 'Empty Table'; //->> 0 for account does not exist
					}

					else{
						?>
						<table>
							<tr>
							<th>TId</th>	
							<th>SId</th>
							<th>Date</th>
							<th>Activity Name</th>
							<th>Description</th>
							<th>action</th>
							</tr>

						<?php
						while($datarow=$check->fetch()){
							?>
							
							<tr>
									<td><?php echo $datarow['tid'] ?></td>
									<td><?php echo $datarow['sid'] ?></td>
									<td><?php echo $datarow['date'] ?></td>
									<td><?php echo $datarow['aname'] ?></td>
									<td><?php echo $datarow['description'] ?></td>
									<td><button onclick="deleteactivity(<?php echo $datarow['aid'] ?>)" 
										style="text-decoration:none;
										background: red;
										border: none;
										border-radius: 5px;
										padding: 0px 10px;
										color: white;
										margin: 10px;">Delete</button></td>
								</tr>



							<?php
						}
						echo "</table>";
						
					}


				?>

			</div>
			<!-- All Activities -->
			<div class="admin_tick" style="text-align: left;margin-bottom: 20px;">
				<div class="admin_heading" style="margin-bottom: 20px;">
					<h1 style="text-align: center;">Pending Approval </h1>
				</div>
				<!-- //create php  -->
				<!-- <h4 style="text-align: center;">Remove Club coordinator</h4> -->
			
				<!-- </table> -->
				<?php
					// session_start();
					
					include('connection.php');
					$check=$db->prepare('SELECT * FROM activity where (tid=? and flag=0) Order by date ASC');
					$data=array($_SESSION['tid']);
					$check->execute($data);
					if($check->rowcount()==0){
						echo 'Empty Table'; //->> 0 for account does not exist
					}

					else{
						?>
						<table>
							<tr>
							<th>TId</th>	
							<th>SId</th>
							<th>Date</th>
							<th>Activity Name</th>
							<th>Description</th>
							<th>action</th>
							</tr>

						<?php
						while($datarow=$check->fetch()){
							?>
							
							<tr>
									<td><?php echo $datarow['tid'] ?></td>
									<td><?php echo $datarow['sid'] ?></td>
									<td><?php echo $datarow['date'] ?></td>
									<td><?php echo $datarow['aname'] ?></td>
									<td><?php echo $datarow['description'] ?></td>
									<td><button onclick="deleteactivity(<?php echo $datarow['aid'] ?>)" 
										style="text-decoration:none;
										background: red;
										border: none;
										border-radius: 5px;
										padding: 0px 10px;
										color: white;
										margin: 10px;">Delete</button></td>
								</tr>



							<?php
						}
						echo "</table>";
						
					}

				?>

			</div>

			<!-- Delete Activities -->
			<div class="admin_tick" style="text-align: left;margin-bottom: 20px;">
				<div class="admin_heading" style="margin-bottom: 20px;">
					<h1 style="text-align: center;">Deleted Activities</h1>
				</div>
				<!-- //create php  -->
				<!-- <h4 style="text-align: center;">Remove Club coordinator</h4> -->
			
				<!-- </table> -->
				<?php
					// session_start();
					
					include('connection.php');
					$check=$db->prepare('SELECT * FROM activity where (tid=? and flag=-1) Order by date ASC');
					$data=array($_SESSION['tid']);
					$check->execute($data);
					if($check->rowcount()==0){
						echo 'Empty Table'; //->> 0 for account does not exist
					}

					else{
						?>
						<table>
							<tr>
							<th>TId</th>	
							<th>SId</th>
							<th>Date</th>
							<th>Activity Name</th>
							<th>Description</th>
							<th>action</th>
							</tr>

						<?php
						while($datarow=$check->fetch()){
							?>
							
							<tr>
									<td><?php echo $datarow['tid'] ?></td>
									<td><?php echo $datarow['sid'] ?></td>
									<td><?php echo $datarow['date'] ?></td>
									<td><?php echo $datarow['aname'] ?></td>
									<td><?php echo $datarow['description'] ?></td>
									<td><button onclick="deleteactivity(<?php echo $datarow['aid'] ?>)" 
										style="text-decoration:none;
										background: green;
										border: none;
										border-radius: 5px;

										padding: 0px 10px;
										color: white;
										margin: 10px;">Add</button></td>
								</tr>



							<?php
						}
						echo "</table>";
						
					}

				?>

			</div>
		</div>

	</section>
</div>
<script type="text/javascript">

	function savedata(){
		var title=document.getElementById('title').value;
		var date=document.getElementById('date').value;
		var venue=document.getElementById('venue').value;
		var eligibility=document.getElementById('eligibility').value;
		var description=document.getElementById('description').value;

		if(title!="" && date!="" && venue!="" && eligibility!="" && description!=""){
			
	
			$.ajax(
			{
				type:"POST",
				url:"ajax/add_activity.php",
				data:{title:title,date:date,venue:venue,eligibility:eligibility,description:description}, //cvalue will be passed in ajax
				success:function(data){
					if(data == 0){
						alert('Activity already exists!');
					}
					else if(data == 1){
						//account created
						alert('Successfully created activity!!!');
						open("newstudentcoordinator.php","_self"); //refresh the page

					}
					else if(data == 2){
						alert('Some problem encountered!');
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
	function deleteactivity(uid){
		// =document.getElementById('delete_id').value;
// alert(uid);
		// alert(uid+" "+email);
		if(uid!=""){
			
			//sending data to backend
			//using ajax post
			// alert('sending data');
			$.ajax(
			{
				type:"POST",
				url:"ajax/delete_activities.php",
				data:{uid:uid},
				success:function(data){
					if(data==0){
						// alert('Activity Does not exist!!!');
					}
					else if(data == 1){
						//account created
						// alert('Successfully Deleted Activity!!!');
						open("newstudentcoordinator.php","_self"); //refresh the page

					}
					else if(data == 2){
						alert('Some problem encountered!');
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