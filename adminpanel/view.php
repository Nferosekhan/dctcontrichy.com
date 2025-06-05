<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
session_start();
if (!isset($_SESSION['uname'])) {
    header("Location: logout.php");
}
// Database connection
include '../connection.php';

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the registration ID from URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Fetch registration details
if ($id) {
    $query = $db->prepare("SELECT * FROM registrations WHERE id = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();
    $registration = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
    <h2 class="text-center mb-4">Registration Details</h2>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <!-- Left Side (Details) -->
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-6">
                            <p><strong>Name</strong></p>
                            <p><strong>Category</strong></p>
                            <p><strong>Place</strong></p>
                            <p><strong>Mobile</strong></p>
                            <p><strong>Email</strong></p>
                            <p><strong>MCI Number</strong></p>
                            <p><strong>State</strong></p>
                            <p><strong>Meal</strong></p>
                            <!-- <p><strong>Payment Status</strong></p> -->
                            <p><strong>Registered On</strong></p>
                        </div>

                        <!-- Right Side (Values) -->
                        <div class="col-lg-6">
                            <p>: &nbsp;<?php echo $registration['name']; ?></p>
                            <p>: &nbsp;<?= (($registration['category']=='Student')?'PG & CRRI':$registration['category']) ?></p>
                            <p>: &nbsp;<?php echo $registration['place']; ?></p>
                            <p>: &nbsp;<?php echo $registration['mobile']; ?></p>
                            <p>: &nbsp;<?php echo $registration['email']; ?></p>
                            <p>: &nbsp;<?php echo $registration['mci']; ?></p>
                            <p>: &nbsp;<?php echo $registration['state']; ?></p>
                            <p>: &nbsp;<?php echo $registration['meal']; ?></p>
                            <!-- <p>: &nbsp;<?php echo $registration['payment']; ?></p> -->
                            <p>: &nbsp;<?php echo date('d/m/Y h:i:s A', strtotime($registration['registration_date'])); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Right Side (Image) -->
                <!-- <div class="col-lg-6">
                    <?php if (!empty($registration['image'])): ?>
                        <img src="<?php echo $registration['image']; ?>" alt="Uploaded Image" class="img-fluid" style="width: 350px;height: 350px;" />
                        <a class="btn btn-success mt-3" href="<?php echo $registration['image']; ?>" target="blank">Click to see image in new tab</a>
                        <a class="btn btn-primary mt-3" href="<?php echo $registration['image']; ?>" download="<?php echo basename($registration['image']); ?>">Click to download the image</a>
                    <?php else: ?>
                        <p>No image available.</p>
                    <?php endif; ?>
                </div> -->
            </div>
            <a href="dashboard.php" class="btn btn-primary mt-3">Back to Dashboard</a>
        </div>
    </div>
</div>

</body>
</html>