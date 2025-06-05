<?php
$host = "localhost";  
$whitelist = array(
	'127.0.0.1',
	'::1'
);
if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
	$user = "mc4ug65vvf5i";  
	$password = 'TZTrnS0i##5l';  
	$db_name = "dctregister"; 
}
else{
	$user = "root";  
	$password = '';  
	$db_name = "dctregister"; 
}
$db = mysqli_connect($host, $user, $password, $db_name);  
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	exit();
}
?>