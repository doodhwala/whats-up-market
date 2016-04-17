<?php 
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "supermarket";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) 
	{
		die("Connection failed: " . $conn->connect_error);
	} 
	if(isset($_COOKIE['id']))
	{     
		//checks if this username was set (atleast once)
		$user_name =  $_COOKIE['id'];  
		if($user_name == "none" || $user_name != '103')
		{    
			//if he hasnt signed in, it ll go to another page just to prompt him to sign in. else continue
			header('location:validation.php');
		}
	}
	else header('location:validation.php');
	$mid = $_COOKIE['id'];
	$mname= "";
	$sql = "select * from employee where E_ID ='".$mid."' ";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc() )
		{
			$mname = $row['Name'];
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="man.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script type="text/javascript">
		function init()
		{
			//to make the grey portion of sidebar extend till the bottom of the page
			side = document.getElementById("side");
			side.style.height = screen.height+50+"px";
		}
    </script>
</head>
<body onload="init()">
	<nav class="navbar navbar-default" >
		<div class="container-fluid" style="background-color:#030303;height:100px">
			<div class="navbar-header col-md-6 text-center">
				<h1 style="color:white;margin-top:30px">Welcome <?php echo $mname?> !</h1>
			</div>
			<ul class="nav navbar-nav " style=" margin-left:250px;padding-top:30px;color:#e0e0e0">
				<li><a href="Manager_Profile.php" style="color:white" >Profile</a></li>
				<li><a href="Manager_Portal.php"><i class="material-icons" style=" margin-right:10px;color:white">sms</i></a></li>
				<li><img src="pic.jpg" height="40px" width="50px" ></li>
				<li><a href="Manager_Signout.php" style="color:white" >Signout</a>
			</ul>
		</div>
	</nav>
	<div class="container-fluid">
		<div class="row">
			<div id ="side" class="col-md-3 text-center" style="left:-75px;margin-top:-21px;background-color:#e0e0e0;z-index:100;height:100%">
				<div class="list-group" style="margin-right:-15px;margin-left:2px">
					<a href="Manager_Employee_View.php" class="list-group-item "><h4>Employee</h4></a>
					<a href="Manager_Customer_View.php" class="list-group-item"><h4>Customer</h4></a>
					<a href="Manager_Accounts_Summary.php" class="list-group-item"><h4>Accounts</h4></a>
					<a href="Manager_Supply_ViewVendor.php" class="list-group-item active"><h4>Supply</h4></a>
					<a href="Manager_Product_View.php" class="list-group-item"><h4>Products</h4></a>
				</div>
			</div>
			<div class="col-md-9 container">
				<div class="row">
					<ul class="nav nav-tabs nav-justified" style="margin-left:-105px;margin-top:-21px">
					
						<li><a href="Manager_Supply_ViewVendor.php">View Vendors</a></li>
						<li  class="active"><a href="Manager_Supply_AddVendor.php">Add Vendor</a></li>	
						<li><a href="Manager_Supply_AddProduct.php">Add Products to Vendor </a></li>
						<li><a href="Manager_Supply_AddOrder.php"> Place Order </a></li>
					</ul>
				</div>
				
				<div class="tab-content">
					<div class="row">
						<br><br> 
						Add details of Vendor
					</div><br><br>
					<div style="padding-left:30px">
						<table class='table table-striped' class = 'table table-bordered' style='margin-left:-90px;margin-top:-10px'>
							<thead>
								<tr>
								<tr>
									<th>Vendor ID</th>
									<th>Name</th>
									<th>Address</th>
									<th>Contact No.</th>
								</tr>
							</thead>
							<form action="addvendor.php" method=post onsubmit="return validate()">
								<tr>
									<th><input type='text' name='vendor_id' id='vendor_id'/></th>
									<th><input type='text' name='vendor_name' id='vendor_name'/></th>
									<th><input type='text' name='address' id='salary'/></th>
									<th><input type='number' name='contact' id='contact'/></th>
									<th><button type="submit" style="border: none; background-color: 'Transparent'; outline:none;"><img src="glyphicons-191-plus-sign.png"/></button></th>
								</tr>
								</form>
						</table>
					</div>	
				</div>
			</div>
		</div>
	</div>

</body>
</html>