<?php
require_once('server.php');
require_once('errors.php');
if(empty($_SESSION['username'])) {
	array_push($errors, "Please Login First.");
  header('location: login.php');
}
include('templates/header.php');
// sleep(10);
?>
<body>
  <?php include('templates/navbar.php'); ?>

<?php
header('refresh:5; url =index.php');
echo "<h1>Your Payment has been done!!</h1>";
echo "<br></br>";
echo "<p>You will be redirected soon</p>";
include('templates/footer.php');
?>
