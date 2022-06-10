<?php
require_once('server.php');
require_once('errors.php');

if(empty($_SESSION['username'])) {
	array_push($errors, "Please Login First.");
  header('location: login.php');
}
include('templates/header.php');

?>

<body>
	<?php include('templates/navbar.php'); ?>

<?php
$_SESSION["No_of_Seats_indirect"] = $_POST["No_of_Seats"];
$_SESSION["Price_indirect"] = $_POST["Price"];
$_SESSION["Duration_indirect"] = $_POST["Duration"];
$_SESSION["Class_indirect"] = $_POST["Class"];
$_SESSION["Start_DepartureTime"]=$_POST["Start_DepartureTime"];
$_SESSION["Mid_ArrivalTime"]=$_POST["Mid_ArrivalTime"];
$_SESSION["Start_Flight_no"]=$_POST["Start_Flight_no"];
$_SESSION["Mid_Airport"]=$_POST["Mid_Airport"];
$_SESSION["Mid_Flight_No"]=$_POST["Mid_Flight_No"];
$_SESSION["Mid_DepartureTime"]=$_POST["Mid_DepartureTime"];
$_SESSION["Final_ArrivalTime"]=$_POST["Final_ArrivalTime"];


echo "<h1>Enter details of Passengers</h1>";
echo "<br><br>";
echo '<form action="payment_indirect.php" method = "post">';
for($x=1;$x<=$_SESSION["No_of_Seats_indirect"];$x++)
{
	echo "Enter details for passenger ".$x."<br>";
    echo 'Name : <input type="text" name="Passenger_name_'.$x .'" required> ';
    echo 'Email : <input type="text" name="Passenger_email_'.$x.'" > ';
    echo 'Contact No : <input type="text" name="Passenger_contact_'.$x.'" >';
    echo "<br><br>";
}
echo '<input type="submit" value="submit" name="submit">'.'</form>';
?>

<?php include('templates/footer.php'); ?>
