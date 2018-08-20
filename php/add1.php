<!DOCTYPE html>

	<head>

	<title>Add records</title>
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
				  <li><a href="../mastermind.php?action=add" class="active"><i class="fa fa-send-o fa-medium"></i>Add a record</a></li>
				  <li><a href="../mastermind.php?action=delete"><i class="fa fa-send-o fa-medium"></i>Delete a record</a></li>
				 
				</ul>
			
			</div>
		</div> <!-- left section -->
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 white-bg right-container">
			<h1 class="logo-right hidden-xs margin-bottom-60">White Hotel</h1>	
			<div class="tm-right-inner-container">

<?php 

	// this is simply the add. First it performs s validation on the input. 
	// then inserts the new data in the db and displys all of the results. 
					require '../config.php';
		if(empty($_POST['fname']) || (!preg_match("/^[a-zA-Z'-]+$/",$_POST['fname']) ) )
		{			
			echo "Please Enter a Valid First Name! <a href = \"../mastermind.php?action=add\"  class=\"btn btn-warning\"> Back </a>";
		}
		else if (empty($_POST['lname']) || (!preg_match("/^[a-zA-Z'-]+$/",$_POST['lname'] ) ) )
		{
			echo "Please Enter a Valid Last Name! <a href = \"../mastermind.php?action=add\"  class=\"btn btn-warning\"> Back </a>";
		}
		
		else if (empty($_POST['room_number']) || ($_POST['room_number'] <= 0 ) )
		{
			echo "Please Enter a Valid Room Number! <a href = \"../mastermind.php?action=add\"  class=\"btn btn-warning\"> Back </a>";
		}
		else if (empty($_POST['start_date']))
		{
			echo "Please Enter a Valid Start Date! <a href = \"../mastermind.php?action=add\"  class=\"btn btn-warning\"> Back </a>";
		}
		
		else if (empty($_POST['end_date']))
		{
			echo "Please Enter a Valid End Date! <a href = \"../mastermind.php?action=add\"  class=\"btn btn-warning\"> Back </a>";
		}
		
		else if ($_POST['start_date'] > $_POST['end_date'])
		{
			echo "Please Enter a Valid Start and End Date! <a href = \"../mastermind.php?action=add\"  class=\"btn btn-warning\"> Back </a>";
		}
		else 
		{
		$_SESSION['fname'] = $_POST['fname'];
		$_SESSION['lname'] = $_POST['lname'];
		$_SESSION['room_number'] = $_POST['room_number'];
		$_SESSION['start_date'] = $_POST['start_date'];
		$_SESSION['end_date'] = $_POST['end_date'];
		

 
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
				$fname = $_SESSION['fname'];
				$lname = $_SESSION['lname'];
				$room = $_SESSION['room_number'];
				$start = $_SESSION['start_date'];
				$end = $_SESSION['end_date'];
				$start = date('Y-m-d',strtotime($_SESSION['start_date']));
				$end = date('Y-m-d',strtotime($_SESSION['end_date']));
				
				$insert = "INSERT INTO orders (fname, lname, room_number, date_start, date_end) 
											VALUES ('$fname', '$lname', $room, '$start', '$end')";
											
				$result1 = mysqli_query($conn, $insert);

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
				echo "Adding was successful!";
				echo "<a href = \"../mastermind.php?action=add\" class=\"btn btn-warning\"> Back </a>";
				 }
		}
				 ?>
	
		</div> <!-- right section -->
	</div>	
</body>
</html>
