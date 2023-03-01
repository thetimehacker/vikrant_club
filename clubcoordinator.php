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
    }
    tr:nth-child(even) {background-color: #f2f2f2}
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
  <a class="active" href="clubcoordinator.php">Home</a>
  <a href="addstudentcoordinator.php">Add Coordinator</a>
  <a href="approveactivities.php">Events</a>
  <a href="index.php">Sign Out</a>
</div>

<div class="content">
<h1>
  <?php
    //we have teacher/club_coordinator sid ... so we can search for club if it exists
    session_start();
    include('connection.php');
    $check=$db->prepare('SELECT * FROM club where sid=?');
    $data=array($_SESSION['uid']);
    $check->execute($data);
    if($check->rowcount()==0){
      //A club does not exist
      //we will ask the club coordinator to enter a club

  ?>
  <section id="adminform" class="section_class">
    <div class="col-sm-12" style="margin-top: 30px;">
      <div class="col-sm-3"></div>
    <div class="col-sm-6">
        
          <!-- Add a new activity -->
        <div class="add_club_coordinator" style="margin-bottom: 20px;">
          <div class="admin_heading">
            <h1 style="text-align: center;">Add a New Club</h1>
          </div>
          <form id="activityform">
            <div class="form-group">
              <input type="text" id="club_name" placeholder="Club Name" class="form-control" required>
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
    <div class="col-sm-3"></div>
      
    </div>
  </section>

  <?php
    }
    else{

  ?>

      <div class="col-sm-12">
      <!-- All Activities -->
      <div class="admin_tick" style="text-align: left;margin-bottom: 20px;">
        <div class="admin_heading" style="margin-bottom: 20px;">
          <h1 style="text-align: center;">Club Details</h1>
        </div>
        <!-- //create php  -->
        <!-- <h4 style="text-align: center;">Remove Club coordinator</h4> -->
      
        <!-- </table> -->
        <?php
          // session_start();
          
          include('connection.php');
          $check=$db->prepare('SELECT * FROM club where sid=?');
          $data=array($_SESSION['uid']);
          $check->execute($data);
          if($check->rowcount()==0){
            echo 'Empty Table'; //->> 0 for account does not exist
          }

          else{
            ?>
            <table>
              <tr>
              <th>Id</th>
              <th>Image</th>

              <th>Club Name</th>
              <th>Description</th>
              <th>action</th>
              </tr>

            <?php
            while($datarow=$check->fetch()){
              ?>
              
              <tr>
                  <td><?php echo $datarow['cid'] ?></td>
                  <td><?php echo $datarow['clubname'] ?></td>
                  <td><?php echo $datarow['clubdesc'] ?></td>
                  <td><button onclick="deleteclub(<?php echo $datarow['cid'] ?>)" 
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

  <?php
    }
  ?>
</h1>
</div>


<script type="text/javascript">
  function savedata(){
    var club_name=document.getElementById('club_name').value;
    var description=document.getElementById('description').value;

    if(club_name!="" && description!=""){
      
  
      $.ajax(
      {
        type:"POST",
        url:"ajax/add_club.php",
        data:{club_name:club_name,description:description}, //cvalue will be passed in ajax
        success:function(data){
          if(data == 0){
            alert('Club already exists!');
          }
          else if(data == 1){
            //account created
            // alert('Successfully created club!!!');
            // open("clubcoordinator.php","_self"); //refresh the page

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
  function deleteclub(uid){
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
        url:"ajax/delete_club.php",
        data:{uid:uid},
        success:function(data){
          if(data==0){
            // alert('Activity Does not exist!!!');
          }
          else if(data == 1){
            //account created
            // alert('Successfully Deleted Activity!!!');
            open("clubcoordinator.php","_self"); //refresh the page

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
</body>
</html>