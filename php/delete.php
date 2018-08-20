<!DOCTYPE html>
<head>
	<title>Delete page</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet" type="text/css">
	<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="../css/templatemo_style.css" rel="stylesheet" type="text/css">
		<style>
	table, th, td
	{
		border: 1px solid black;
	}
	th 
	{
    background-color: #f0ad4e;
    color: white;
	padding: 20px;
	}
	td 
	{
    text-align: center;
	padding: 20px;
	}
</style>

	
</head>
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
				 <ul class="nav nav-stacked templatemo-nav">
				
				  <li><a href="../index.html" class="active"><i class="fa fa-home fa-medium"></i>Home page</a></li>
				  <li> <a href="../mastermind.php?action=view"><i class="fa fa-send-o fa-medium"></i>View all records </a></li>
				  <li><a href="../mastermind.php?action=update"><i class="fa fa-send-o fa-medium"></i>Update Records</a></li>
				  <li><a href="../mastermind.php?action=add"><i class="fa fa-send-o fa-medium"></i>Add a record</a></li>
				  <li><a href="../mastermind.php?action=delete" class="active"><i class="fa fa-send-o fa-medium"></i>Delete a record</a></li>
				 
				</ul>
			</div>
		</div> <!-- left section -->
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 white-bg right-container">
			<h1 class="logo-right hidden-xs margin-bottom-60">White Hotel</h1>		
			<div class="tm-right-inner-container">
				<h1 class="templatemo-header">Black White Hotel Project</h1>
				
				<article>
						<?php				
							require '../config.php';
						 // all this file does is delete the record from the db and redisplay the db
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
								echo "There is an error. Could not delete. ";
								echo "<a href = \"../mastermind.php?action=delete\" class=\"btn btn-warning\"> Back </a>";
							}
										
										
						else 
						{	
						$del = $_GET['c_id'];
						$delete = "DELETE FROM orders 
												WHERE Order_ID = '$del'";
													
						$result1 = mysqli_query($conn, $delete);
						if (!$result1) 
						{
							echo "DB Error, could not query the database\n";
							echo 'MySQL Error: ' . mysqli_error($conn);
							exit;
						}
						else 
						 {
						  $sql = "SELECT * FROM orders 
										ORDER BY date_start DESC";

						$result = mysqli_query($conn, $sql);

							echo "<table>";
							echo "<tr>";
							echo "<th> Order ID  </th>";
							echo "<th> First Name  </th>";
							echo "<th> Last Name  </th>";
							echo "<th> Room Number  </th>";
							echo "<th> Date Start  </th>";
							echo "<th> Date End  </th>";
							echo "<tr>";
							while ($row = mysqli_fetch_assoc($result))
							{
							echo "<tr>";
							echo  "<td>" . $row['order_ID'] . "</td>";
							echo  "<td>" . $row ['fname'] . "</td>";
							echo  "<td>" . $row ['lname'] . "</td>";
							echo  "<td>" . $row ['room_number'] . "</td>";
							echo  "<td>" . $row ['date_start'] . "</td>";
							echo  "<td>" . $row ['date_end'] . "</td>";
							echo "</tr>";
							}
							
						mysqli_free_result($result);
						echo "Deleting was successful!";
						echo "<a href = \"../mastermind.php?action=delete\" class=\"btn btn-warning\"> Back </a>";
						 }
						 }
						 ?>		
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