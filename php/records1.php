
<!DOCTYPE html>
<head>

	<title>View records</title>
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
				
				  <li><a href="../index.html" ><i class="fa fa-home fa-medium"></i>Home page</a></li>
				  <li> <a href="../mastermind.php?action=view" class="active"><i class="fa fa-send-o fa-medium"></i>View all records </a></li>
				  <li><a href="../mastermind.php?action=update"><i class="fa fa-send-o fa-medium"></i>Update Records</a></li>
				  <li><a href="../mastermind.php?action=add"><i class="fa fa-send-o fa-medium"></i>Add a record</a></li>
				  <li><a href="../mastermind.php?action=delete"><i class="fa fa-send-o fa-medium"></i>Delete a record</a></li>
				 
				</ul>
			</div>
		</div> <!-- left section -->
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 white-bg right-container">
			<h1 class="logo-right hidden-xs margin-bottom-60">White Hotel</h1>	
			<div class="tm-right-inner-container">
			<br /> 
			<br />
			<br />
			<br />
<?php
 require '../config.php';
 
$today = date("y-m-d", strtotime('2020-12-31')); // converts the user selection to the proper format
$month = date('y-m-d', strtotime('-1 month', strtotime('today')) ); 
$year = date('y-m-d', strtotime('-1 year', strtotime('today')) );                      
$var1 = $_GET['view'];

switch ($var1) // a switch to determine the value of the session variable date 
{
	case "all": 
	{
		$_SESSION['date'] = $today;

		break;
	}
	case "month":
		{		
		$_SESSION['date'] = $month;
		break;
		}
	case "year": 
		{
		$_SESSION['date'] = $year;
		break;
		}
	default: echo "An error occurred <a href = \"../mastermind.php?action=view\" class=\"btn btn-warning\" > Back </a> " ;

}
 $conn = mysqli_connect(HOST, USER, PASS); // the script for displaying the results starts here with all the checks
 if (!$conn) 
 {
    die("Connection failed: " . mysqli_connect_error());
 }

 if (!mysqli_select_db($conn, DB)) 
 {
    echo 'Could not select database';
    exit;
}

$date = $_SESSION['date'];
 $sql = "SELECT * FROM orders 
				WHERE date_start <= '$date'
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
 echo  "<article>";
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
	?>
		<tr>
			<td><?php echo $row['order_ID'] ?></td>
			<td><?php echo $row['fname'] ?></td>
			<td><?php echo $row['lname'] ?></td>
			<td><?php echo $row['room_number'] ?></td>
			<td><?php echo $row['date_start'] ?></td>
			<td><?php echo $row['date_end'] ?></td>
		</tr>
	<?php
	
	}
	
mysqli_free_result($result);

echo "<a href = \"../mastermind.php?action=view\" class=\"btn btn-warning\"> Back </a>";
echo "</article>";
 }
 ?>
	
		</div> <!-- right section -->
	</div>	
</body>
</html>

