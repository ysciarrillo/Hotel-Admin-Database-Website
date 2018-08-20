<!DOCTYPE html>
<head>
	<title>Update page</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet" type="text/css">
	<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="../css/templatemo_style.css" rel="stylesheet" type="text/css">	


</head>
<body>
	<div class="templatemo-logo visible-xs-block">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 black-bg logo-left-container">
			<h1 class="logo-left">Black</h1>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 white-bg logo-right-container">
			<h1 class="logo-right">White Hotel</h1>
		</div>			
	</div>
	<div class="templatemo-container">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 black-bg left-container">
			<h1 class="logo-left hidden-xs margin-bottom-60">Black</h1>			
			<div class="tm-left-inner-container">
			</div>
		</div> <!-- left section -->
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 white-bg right-container">
			<h1 class="logo-right hidden-xs margin-bottom-60">White Hotel</h1>		
			<div class="tm-right-inner-container">
				<h1 class="templatemo-header">Black White Hotel Project</h1>
				<article>
					
					<?php
						 require '../config.php';
						 // this whole file displays a secondary web form that the user can fill in The php script 
						 //takes the previous values and inserts them into the new form, so there will be no fields left blank
						 $conn = mysqli_connect(HOST, USER, PASS);
						 if (!$conn) 
						 {
							die("Connection failed: " . mysqli_connect_error());
						 }

						 if (!mysqli_select_db($conn, DB)) 
						 {
							echo 'Could not select database';
							exit;
						}			
						if(!ctype_digit($_GET['c_id']))
							
							{
								echo "There is an error. Could not update. ";
								echo "<a href = \"../../mastermind.php?action=update\" class=\"btn btn-warning\"> Back </a>";
							}
										
										
						else 
						{	
						$updt = $_GET['c_id'];
						$update = "SELECT * FROM orders 
												WHERE Order_ID = '$updt'";
													
						$result1 = mysqli_query($conn, $update);
						if (!$result1) 
						{
							echo "DB Error, could not query the database\n";
							echo 'MySQL Error: ' . mysqli_error($conn);
							exit;
						}
						else 
						{
						while ($row = mysqli_fetch_assoc($result1))
							{
								$_SESSION ['order_ID'] = $row['order_ID'];
								$_SESSION ['fname'] = $row['fname'];
								$_SESSION ['lname'] = $row['lname'];
								$_SESSION ['room'] = $row['room_number'];
								$_SESSION ['start'] = $row['date_start'];
								$_SESSION ['end'] = $row['date_end'];
							}
						}// the form below calls another file
						}
 ?>
			<article>
				
					<form action="update/update2.php" method="post">
					<label for="first_name" class="control-label">First Name</label>
				      <input type="text" class="form-control" id="firstname" name = "fname" value = '<?php echo $_SESSION ['fname']; ?>'>
					<label for="last_name" class="control-label">Last name</label>
				      <input type="text" class="form-control" id="lastname" name = "lname"  value = '<?php echo $_SESSION ['lname']; ?>'>
					<label for="room_number" class="control-label">Room Number</label>
				      <input type="number" class="form-control" id="room_number" name = "room_number"  value = '<?php echo $_SESSION ['room']; ?>'>
					<label for="start_date" class="control-label">Start Date</label>
						<input type="date" class="form-control" id="start_date" name="start_date"  value = '<?php echo $_SESSION ['start']; ?>'/>
					<label for="end_date" class="control-label">End Date</label>
						<input type="date" class="form-control" id="end_date" name="end_date"  value = '<?php echo $_SESSION ['end']; ?>'/>
							<input type = "Submit" class="btn btn-warning" value = "Update">	
							</form>
					<div id="cal1Container"></div>
        
				</article>
				
				<footer>
					<p class="col-lg-6 col-md-6 col-sm-12 col-xs-12 templatemo-copyright">Copyright &copy; 2014 Adriana Izmirova </p>
					<p class="col-lg-6 col-md-6 col-sm-12 col-xs-12 templatemo-social">
						<a href="https://www.facebook.com/adriana.izmirova"><i class="fa fa-facebook fa-medium"></i></a>
						<a href="https://twitter.com/Lucciannos"><i class="fa fa-twitter fa-medium"></i></a>
						<a href="https://www.youtube.com/user/sapfir88888888"><i class="fa fa-youtube fa-medium"></i></a>
						<a href="https://www.linkedin.com/pub/adriana-izmirova/5b/b7/7a2"><i class="fa fa-linkedin fa-medium"></i></a>
					</p>
				</footer>
			</div>	
		</div> <!-- right section -->
	</div>	
</body>
</html>