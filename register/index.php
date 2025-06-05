<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../connection.php';
if (isset($_POST['submit'])) {
	$name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
	$category = htmlspecialchars($_POST['category'], ENT_QUOTES, 'UTF-8');
	$place = htmlspecialchars($_POST['place'], ENT_QUOTES, 'UTF-8');
	$mobile = htmlspecialchars($_POST['mobile'], ENT_QUOTES, 'UTF-8');
	$email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
	$mci = htmlspecialchars($_POST['mci'], ENT_QUOTES, 'UTF-8');
	$state = htmlspecialchars($_POST['state'], ENT_QUOTES, 'UTF-8');
	$meal = htmlspecialchars($_POST['meal'], ENT_QUOTES, 'UTF-8');
	// $reg_for = htmlspecialchars($_POST['reg_for'], ENT_QUOTES, 'UTF-8');
	$payment = htmlspecialchars($_POST['payment'], ENT_QUOTES, 'UTF-8');

	$imageName = $_FILES['image']['name'];
	$imageTmpName = $_FILES['image']['tmp_name'];

	$imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);
	$newImageName = uniqid() . '.' . $imageExtension;

	$uploadDirectory = "../adminpanel/payments/";
	// if (move_uploaded_file($imageTmpName, $uploadDirectory . $newImageName)) {
		$imagevalue = $uploadDirectory . $newImageName;

		$query = $db->prepare("INSERT INTO registrations (name,category,place,mobile,email,mci,meal,state,payment, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$query->bind_param("ssssssssss", $name, $category, $place, $mobile, $email, $mci, $meal, $state, $payment, $imagevalue);
		if ($query->execute()) {
			session_start();
			$_SESSION['idofreg'] = $db->insert_id;
			if($category=="Doctor"){
				header("location:https://rzp.io/rzp/dctcon2025");
			}
			elseif($category=="Student"){
				header("location:https://rzp.io/rzp/dctconpg");
			}
			else{
				header("location:index.php?error=Please try again");
			}
	    }
	    else {
	       header("location:index.php?error=Please try again");
	    }
	// }
	// else{
	// 	header("location:index.php?error=Please try again");
	// }
}

$response="";
if (isset($_GET['success'])) {
	$response='<div class="alert alert-success" role="alert">'.$_GET['success'].'</div>';
}
else if (isset($_GET['error'])) {
	$response='<div class="alert alert-danger" role="alert">'.$_GET['error'].'</div>';
}
?>
<!DOCTYPE html>
<html lang="en">
	 <meta charset="UTF-8">
	 <link rel="icon" type="image/x-icon" href="../images/favicon.ico">
	 <meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <title>DCTCON 2025 Registration Form</title>
	 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	 <style>
		  body {
		    color: white;
			background-color: lightcyan;
			font-family: Arial, sans-serif;
		  }
		  .form-container {
			max-width: 800px;
			margin: 20px auto;
			background: #fff;
			padding: 30px;
			border-radius: 10px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		  }
		  .form-header {
			text-align: center;
			margin-bottom: 20px;
			font-weight: bold;	
			text-transform: uppercase;
		  }
		  .table-bordered th, .table-bordered td {
			text-align: center;
			vertical-align: middle;
		  }
	 </style>
</head>
<body>
	 <div class="container">
		  <div class="form-container" style="background-color: #52adc1;">
				<h2 class="form-header" style="color: #040459;text-shadow: 1px 1px 8px white;">DCTCON 2025 - 15th Annual Professional Conference</h2>
				<h3 class="form-header" style="	color: #d7db2a;">Academic Extravaganza @ Trichy</h3>
				<p class="text-center" style="color: black;">@ COURTYARD BY MARRIOT, TRICHY, TAMILNADU, INDIA</p>
				<p class="text-center" style="color: white;font-size:25px;font-weight: bold;text-decoration: underline;">Registration Form</p>
				<p class="text-center" style="color: black;">June 14th & 15th,2025</p>
				<div><?=$response?></div>
				<form action="" method="POST" autocomplete="off" enctype="multipart/form-data">

				    <div class="mb-3 row">
				    	<div class="col-sm-3">
					    	<label class="col-form-label">Delegates Fees : </label>
					    </div>
					    <div class="col-sm-7">
						    <table class="table table-bordered table-sm">
							    <thead style="font-size: 15px;">
									<tr>
									    <th>Category</th>
									    <th>Fees</th>
									    <!-- <th>Action</th> -->
									</tr>
							    </thead>
							    <tbody style="font-size: 15px;">
									<tr>
									    <td>PG & CRRI</td>
									    <td>₹2000 INR</td>
									    <!-- <td><a href="https://rzp.io/rzp/dctconpg" target="blank" class="btn btn-success" style="font-size: 15px;color: white;">Pay</a></td> -->
									</tr>
									<tr>
									    <td>Medical Practitioners</td>
									    <td>₹3500 INR</td>
									    <!-- <td><a href="https://rzp.io/rzp/dctcon2025" target="blank" class="btn btn-success" style="font-size: 15px;color: white;">Pay</a></td> -->
									</tr>
							    </tbody>
							</table>
						</div>
					</div>
					
				    <div class="mb-3 row">
						<label class="col-sm-3 col-form-label">Name : </label>
						<div class="col-sm-7">
						    <input type="text" name="name" class="form-control form-control-sm" required>
						</div>
				    </div>
				    
				    <div class="mb-3 row">
						<label class="col-sm-3 col-form-label">Category : </label>
						<div class="col-sm-7">
						    <select name="category" class="form-select form-select-sm">
								<option value="Doctor">Doctor</option>
								<option value="Student">PG & CRRI</option>
						    </select>
						</div>
				    </div>
				    
				    <div class="mb-3 row">
						<label class="col-sm-3 col-form-label">Place : </label>
						<div class="col-sm-7">
						    <input type="text" name="place" class="form-control form-control-sm" required>
						</div>
				    </div>
				    
				    <div class="mb-3 row">
						<label class="col-sm-3 col-form-label">WhatsApp Mobile Number : </label>
						<div class="col-sm-7">
						    <input type="text" name="mobile" class="form-control form-control-sm" required>
						</div>
				    </div>
				    
				    <div class="mb-3 row">
						<label class="col-sm-3 col-form-label">Email ID : </label>
						<div class="col-sm-7">
						    <input type="email" name="email" class="form-control form-control-sm" required oninput="this.value = this.value.toLowerCase()">
						</div>
				    </div>
				    
				    <div class="mb-3 row">
						<label class="col-sm-3 col-form-label">MCI Number : </label>
						<div class="col-sm-7">
						    <input type="text" name="mci" class="form-control form-control-sm" required>
						</div>
				    </div>
				    
				    <div class="mb-3 row">
						<label class="col-sm-3 col-form-label">State : </label>
						<div class="col-sm-7">
						    <input type="text" name="state" class="form-control form-control-sm" required>
						</div>
				    </div>
				    
				    <div class="mb-3 row">
						<label class="col-sm-3 col-form-label">Meal Preference : </label>
						<div class="col-sm-7">
						    <select name="meal" class="form-select form-select-sm">
								<option value="Veg">Veg</option>
								<option value="Non-Veg">Non-Veg</option>
						    </select>
						</div>
				    </div>
				    
				    <div class="mb-3 row" style="display: none;">
						<label class="col-sm-3 col-form-label">Registration for : </label>
						<div class="col-sm-7">
						    <select name="reg_for" class="form-select form-select-sm">
								<option value="Conference">Conference</option>
								<option value="Workshop Only">Workshop Only</option>
						    </select>
						</div>
				    </div>

				    <!-- Payment Details and Image Upload -->
				    <div class="mb-3 row" style="display:none;">
					    <label class="col-sm-3 col-form-label">Payment Details : </label>
					    <div class="col-sm-7">
							<textarea name="payment" class="form-control form-control-sm" placeholder="Enter payment status with transaction number"></textarea>
					    </div>
					</div>

				    
				    <div class="mb-3 row" style="display:none;">
						<label class="col-sm-3 col-form-label">Upload Image (Screenshot of the completed Payment) : </label>
						<div class="col-sm-7">
						    <input type="file" name="image" class="form-control form-control-sm" accept="image/*">
						</div>
				    </div>

				    <!-- Submit Button -->
				    <div class="text-center">
						<button type="submit" name="submit" class="btn btn-primary" style="color: yellow; background-color: darkblue;">Register</button>
				    </div>
				</form>

		  </div>
	 </div>
</body>
</html>
