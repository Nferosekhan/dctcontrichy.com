<?php
session_start();
if (!isset($_SESSION['uname'])) {
	header("Location: logout.php");
}
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
// Database connection
include '../connection.php';

// Check if the database connection is successful
if (!$db) {
	die("Connection failed: " . mysqli_connect_error());
}

// Fetch today's registration count
$todayquery = $db->prepare("SELECT COUNT(*) as today_count FROM registrations WHERE DATE(registration_date) = CURDATE() AND paid_status=1");
$todayquery->execute();
$todayresult = $todayquery->get_result();
$todayrow = $todayresult->fetch_assoc();
$today_count = $todayrow['today_count'];

$total_query = $db->prepare("SELECT COUNT(*) as total_count FROM registrations WHERE paid_status=1");
$total_query->execute();
$total_result = $total_query->get_result();
$total_row = $total_result->fetch_assoc();
$total_count = $total_row['total_count'];

$doctorquery = $db->prepare("SELECT COUNT(*) as doctorcount FROM registrations WHERE category='Doctor' AND paid_status=1");
$doctorquery->execute();
$doctorresult = $doctorquery->get_result();
$doctorrow = $doctorresult->fetch_assoc();
$doctorcount = $doctorrow['doctorcount'];

$studentquery = $db->prepare("SELECT COUNT(*) as studentcount FROM registrations WHERE category='Student' AND paid_status=1");
$studentquery->execute();
$studentresult = $studentquery->get_result();
$studentrow = $studentresult->fetch_assoc();
$studentcount = $studentrow['studentcount'];


// Fetch all registrations
$registrations_query = $db->prepare("SELECT * FROM registrations WHERE paid_status=1");
$registrations_query->execute();
$registrations_result = $registrations_query->get_result();
$registrations_query_hidden = $db->prepare("SELECT * FROM registrations WHERE paid_status=1");
$registrations_query_hidden->execute();
$registrations_result_hidden = $registrations_query_hidden->get_result();
$response="";
if (isset($_GET['error'])) {
	$response='<div class="alert alert-danger" role="alert">'.$_GET['error'].'</div>';
}
if (isset($_GET['success'])) {
	$response='<div class="alert alert-success" role="alert">'.$_GET['success'].'</div>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Dashboard</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f8f9fa;
		}
		.dashboard-card {
			margin-top: 50px;
			padding: 20px;
			background-color: white;
			border-radius: 10px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
		}
		.sidebar {
			position: fixed;
			top: 0;
			left: 0;
			height: 100%;
			width: 250px;
			background-color: #343a40;
			padding-top: 20px;
		}
		.sidebar a {
			color: white;
			padding: 15px;
			text-decoration: none;
			display: block;
			font-size: 18px;
		}
		.sidebar a:hover {
			background-color: #007bff;
		}
		.content {
			margin-left: 260px;
			padding: 20px;
		}
		.card-header {
			font-size: 24px;
			font-weight: bold;
		}
		.card-body {
			font-size: 18px;
			color: #007bff;
		}
		.table th, .table td {
			text-align: center;
		}
		.table-action-btns a {
			margin: 0 5px;
		}
		.sidebar .fa {
			margin-right: 10px;
		}
	</style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
	<h3 class="text-white text-center">Admin Panel</h3>
	<a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
	<a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

<!-- Content -->
<div class="content">
	<div><?=$response?></div>
	<h1 class="text-center my-4">Dashboard</h1>

	<div class="row">
		<!-- Today's Registrations Card -->
		<div class="col-md-3 mb-4">
			<div class="dashboard-card">
				<div class="card-header">
					Today's Registrations
				</div>
				<div class="card-body text-center">
					<h2><?php echo $today_count; ?></h2>
				</div>
			</div>
		</div>

		<!-- Total Registrations Card -->
		<div class="col-md-3 mb-4">
			<div class="dashboard-card">
				<div class="card-header">
					Total Registrations
				</div>
				<div class="card-body text-center">
					<h2><?php echo $total_count; ?></h2>
				</div>
			</div>
		</div>
      <div class="col-md-3 mb-4">
			<div class="dashboard-card">
				<div class="card-header">
					Doctor Registrations
				</div>
				<div class="card-body text-center">
					<h2><?php echo $doctorcount; ?></h2>
				</div>
			</div>
		</div>
		<div class="col-md-3 mb-4">
			<div class="dashboard-card">
				<div class="card-header">
					PG & CRRI Registrations
				</div>
				<div class="card-body text-center">
					<h2><?php echo $studentcount; ?></h2>
				</div>
			</div>
		</div>
	</div>

	<h2 class="my-4">Registered Persons</h2>

	<!-- Registrations Table -->
	<div class="dashboard-card">
		<table id="registrationTable" class="table table-bordered table-striped" style="display: none;">
			<thead>
				<tr>
					<th>Name</th>
					<th>Category</th>
					<th>Place</th>
					<th>WhatsApp Mobile Number</th>
					<th>Email ID</th>
					<th>MCI Number</th>
					<th>State</th>
					<th>Meal Preference</th>
					<th>Registered On</th>
				</tr>
			</thead>
			<tbody>
				<?php while ($rowhidden = $registrations_result_hidden->fetch_assoc()) { ?>
					<tr>
						<td><?php echo $rowhidden['name']; ?></td>
						<td><?= (($rowhidden['category']=='Student')?'PG & CRRI':$rowhidden['category']) ?></td>
						<td><?php echo $rowhidden['place']; ?></td>
						<td><?php echo $rowhidden['mobile']; ?></td>
						<td><?php echo $rowhidden['email']; ?></td>
						<td><?php echo $rowhidden['mci']; ?></td>
						<td><?php echo $rowhidden['state']; ?></td>
						<td><?php echo $rowhidden['meal']; ?></td>
						<td><?php echo date('d/m/Y h:i:s A',strtotime($rowhidden['registration_date'])); ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
		<table class="table table-bordered table-striped" id="paginationtable">
			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Mobile</th>
					<th>Place</th>
					<th>Category</th>
					<th>Registered On</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php while ($row = $registrations_result->fetch_assoc()) { ?>
					<tr>
						<td><?php echo $row['name']; ?></td>
						<td><?php echo $row['email']; ?></td>
						<td><?php echo $row['mobile']; ?></td>
						<td><?php echo $row['place']; ?></td>
						<td><?php echo $row['category']; ?></td>
						<td><?php echo date('d/m/Y h:i:s A',strtotime($row['registration_date'])); ?></td>
						<td class="table-action-btns">
							<a href="view.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm m-1"><i class="fas fa-eye"></i> View</a>
							<a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are You Sure To Delete This Record?')" class="btn btn-danger btn-sm m-1"><i class="fas fa-trash"></i> Delete</a>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- Buttons Extension -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script>
$(document).ready(function() {
	$('#paginationtable').DataTable({
		dom: 'frtip',
		ordering: false
	});
	$('#registrationTable').DataTable({
		dom: 'B',
		paging: false,
		buttons: [
			{
				extend: 'copy',
				title: 'Registrations',
				filename: 'registrations'
			},
			{
				extend: 'csv',
				title: 'Registrations',
				filename: 'registrations'
			},
			{
				extend: 'excel',
				title: 'Registrations',
				filename: 'registrations'
			},
			{
				extend: 'pdf',
				title: 'Registrations',
				filename: 'registrations',
				orientation: 'landscape',
				pageSize: 'A4'
			},
			{
				extend: 'print',
				title: 'Registrations'
			}
		]
	});
});
</script>

</body>
</html>