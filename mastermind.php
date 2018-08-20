<!DOCTYPE html>
<head>
	<title>Initial page</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet" type="text/css">
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="css/templatemo_style.css" rel="stylesheet" type="text/css">


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
				
				  <li><a href="index.html" ><i class="fa fa-home fa-medium"></i>Home page</a></li>
				  <li> <a href="mastermind.php?action=view"><i class="fa fa-send-o fa-medium"></i>View all records </a></li>
				  <li><a href="mastermind.php?action=update"><i class="fa fa-send-o fa-medium"></i>Update Records</a></li>
				  <li><a href="mastermind.php?action=add"><i class="fa fa-send-o fa-medium"></i>Add a record</a></li>
				  <li><a href="mastermind.php?action=delete"><i class="fa fa-send-o fa-medium"></i>Delete a record</a></li>
				 
				</ul>
				
			</div>
		</div> <!-- left section -->
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 white-bg right-container">
			<h1 class="logo-right hidden-xs margin-bottom-60">White Hotel</h1>		
			<div class="tm-right-inner-container">
				<h1 class="templatemo-header">Black White Hotel Project</h1>
				<article>
						<?php 
						require 'config.php'; // the config file contains the name of the db, the host, the pass, etc.
						 $action = $_REQUEST['action']; // takes the value of the action sent to this file
						switch ($action) // this switch displays the proper initial form depending on the previous selection by the user
						{
						case 'view': // the display/view case
								{ // there is a drop down that the user can click and choose the actual records to display - all, older than an year and older than a month
									?>
										<h1 class="templatemo-header">Records</h1>	

											<form action="php/records1.php" method="get">
					
												<select name = "view">
													<option value="all">All</option>
													<option value="month">Older Than a Month </option>
													<option value="year">Older Than a Year</option>
												</select>
												<input type = "Submit" class="btn btn-warning" value = "Display">									
											</form>	
						
									<?php
								break;
								}
						 case 'update':
						 {
// this php- script and html shows the user the entire content of the db. the user than chooses the file to be updated, by clicking a link next to the desired file						 
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
							$sql = "SELECT * FROM orders 
							ORDER BY date_start DESC";

							$result = mysqli_query($conn, $sql);

							if (!$result) 
							{
								echo "DB Error, could not query the database\n";
								echo 'MySQL Error: ' . mysqli_error($conn);
								exit;
							}
							else 
							{
								?>
								<h1 class="templatemo-header">Update</h1>
									<article>
									<table>
									<tr>
									<th> Order ID  </th>
									<th> First Name  </th>
									<th> Last Name  </th>
									<th> Room Number  </th>
									<th> Date Start  </th>
									<th> Date End  </th>
									<th> Update  </th>
									<tr>
									<?php
										while ($row = mysqli_fetch_assoc($result))
										{
										?>
											<tr>
												<td><?php echo $row['order_ID'] ?></td>
												<td><?php echo $row['fname'] ?></td>
												<td><?php echo $row['lname'] ?></td>
												<td><?php echo $row['room_number'] ?></td>
												<td><?php echo $row['date_start'] ?></td>
												<td><?php echo $row['date_end'] ?></td>
												<td><a href="php/update1.php?c_id=<?php echo $row['order_ID'] ?>">Update</a></td> <!-- The link. Practically, it leads to a new form. After the user fills it, the new information is added to the db. -->
											</tr>
										<?php
										
										}
										
									mysqli_free_result($result);

						 
							}
							break;
						}
						case 'add':
						// the add case displays a form that the user can fill in. Upon clicking the button the data is validated, entered in the database and all records are displayed
						{
						?>
						<h1 class="templatemo-header">Add</h1>
						<form action="php/add1.php" method="post">
							<label for="first_name" class="control-label">First Name</label>
								<input type="text" class="form-control" id="fname" name = "fname">
							<label for="last_name" class="control-label">Last name</label>
								<input type="text" class="form-control" id="lname" name = "lname">
							<label for="room_number" class="control-label">Room Number</label>
								<input type="number" class="form-control" id="room_number" name = "room_number">
							<label for="start_date" class="control-label">Start Date</label>
								<input type="date" class="form-control" id="start_date" name="start_date"/>
							<label for="end_date" class="control-label">End Date</label>
								<input type="date" class="form-control" id="end_date" name="end_date"/>
							<input type = "Submit" class="btn btn-warning" value = "Add">	
							</form>
						<div id="cal1Container"></div>
        
						<?php
						break;
						}
						case 'delete':
						// this is again a lot like the update, however, the button on the right deletes the record. 
						{
						
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
							$sql = "SELECT * FROM orders 
							ORDER BY date_start DESC";

							$result = mysqli_query($conn, $sql);

							if (!$result) 
							{
								echo "DB Error, could not query the database\n";
								echo 'MySQL Error: ' . mysqli_error($conn);
								exit;
							}
							else 
							{
								?>
								<h1 class="templatemo-header">Delete</h1>
									<article>
									<table>
									<tr>
									<th> Order ID  </th>
									<th> First Name  </th>
									<th> Last Name  </th>
									<th> Room Number  </th>
									<th> Date Start  </th>
									<th> Date End  </th>
									<th> DELETE?  </th>
									<tr>
									<?php
										while ($row = mysqli_fetch_assoc($result))
										{
										?>
											<tr>
												<td><?php echo $row['order_ID'] ?></td>
												<td><?php echo $row['fname'] ?></td>
												<td><?php echo $row['lname'] ?></td>
												<td><?php echo $row['room_number'] ?></td>
												<td><?php echo $row['date_start'] ?></td>
												<td><?php echo $row['date_end'] ?></td>
												<td><a href="php/delete.php?c_id=<?php echo $row['order_ID'] ?>">DELETE</a></td>
											</tr>
										<?php
										
										}
										
									mysqli_free_result($result);

						 
							}
							break;
						}
						default: 
						{
							echo "How did you manage this? An error     <a href = \"index.html\" class=\"btn btn-warning\">Back </a>";
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