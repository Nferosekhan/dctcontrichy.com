<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
// Database connection
include '../connection.php';

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the registration ID from URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id) {
    // Prepare and execute delete query
    $query = $db->prepare("DELETE FROM registrations WHERE id = ?");
    $query->bind_param("i", $id);
    if ($query->execute()) {
        header("Location: dashboard.php?success=Record Successfully Deleted"); // Redirect back to dashboard after deletion
        // echo "Deleted";
    } else {
        header("Location: dashboard.php?error=Record Not Deleted");
    }
}
?>
