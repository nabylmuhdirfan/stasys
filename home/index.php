<?php
	// ./root/home/index.php
	require_once "../sess/config.php";
	require_once '../sess/session_check.php';
	include('../sess/current_user.php');
?>
<!DOCTYPE html>
<html>
	<!--START: PAGE HEADER-->
	<head>
		<title>STASYS - Home</title>
		<link href="https://fonts.googleapis.com/css?family=Comic Neue" rel='stylesheet'/>
		<link rel="stylesheet" type="text/css" href="../css/styles-new.css"/>
	</head>
	<!--END: PAGE HEADER-->
	<body>
		<!--START: NAVBAR-->
		<nav>
			<a href="./"><h1>STASYS</h1> Student Activity System v <?php echo $VERSION; ?></a>
			<a href="../sess/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Log Out</a>
				<a href="./event/option/add.php"><i class="fa fa-calendar" aria-hidden="true"></i> Add Event</a>
			<a href="./user/"><i class="fa fa-user-circle-o" aria-hidden="true"></i> <?php echo $rowuser['un']; ?></a>
		</nav>
		<!--END: NAVBAR-->
		<!--START: BODY-->
		<div class="wrapper">
			<center><h1><strong>Events</strong></h1></center>
			<!--START: LIST AVAILABLE EVENT-->
				<?php if ($rowuser['access_lvl'] == 3)
					$result = mysqli_query($conn, "SELECT * FROM event WHERE status = 1 ORDER BY date_time DESC");
				else
					$result = mysqli_query($conn, "SELECT * FROM event ORDER BY date_time DESC");
				
				while($rows=mysqli_fetch_array($result)){
				    $count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(u_id) as count FROM participation WHERE e_id = ".$rows['id'].""));
					if ($rows['status'] == 0)
						$status = "<div style='color: #7f4600;'>Approval Pending";
					else
						$status = "<div style='color: darkgreen;'>Approved"; ?>
			<div class="event-bg">
				<div class="txt"><h1><?php echo $rows['title']; ?></h1></div>
				<div class="txt"><?php echo date('h:i A (Hi), d/m/Y', strtotime($rows['date_time'])); ?></div>
				<div class="txt"><?php echo $count['count'].' participant(s) joined'; ?></div>
				<a href="./event/?no=<?php echo $rows['id']; ?>"><div class="button">View</div></a>
			</div><?php
				}?>
			<!--END: LIST AVAILABLE EVENT-->
		</div>
		<!--END: BODY-->
		<script src="https://kit.fontawesome.com/2ba9e2652f.js" crossorigin="anonymous"></script>
	</body>
	
</html>