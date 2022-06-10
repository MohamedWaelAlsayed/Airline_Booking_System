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
$_SESSION["No_of_Seats_twostop"] = $_POST["No_of_Seats"];
$_SESSION["Price_twostop"] = $_POST["Price"];
$_SESSION["Duration_twostop"] = $_POST["Duration"];
$_SESSION["Class_twostop"] = $_POST["Class"];
$_SESSION["Start_Airport"]=$_POST["Start_Airport"];
$_SESSION["Start_Flight_no_twostop"]=$_POST["Start_Flight_no"];
$_SESSION["Start_DepartureTime_twostop"]=$_POST["Start_DepartureTime"];
$_SESSION["First_Stop_ArrivalTime"]=$_POST["First_Stop_ArrivalTime"];
$_SESSION["First_Stop_Airport"]=$_POST["First_Stop_Airport"];
$_SESSION["First_Stop_Flight_No"]=$_POST["First_Stop_Flight_No"];
$_SESSION["First_Stop_DepartureTime"]=$_POST["First_Stop_DepartureTime"];
$_SESSION["Second_Stop_ArrivalTime"]=$_POST["Second_Stop_ArrivalTime"];
$_SESSION["Second_Stop_Airport"]=$_POST["Second_Stop_Airport"];
$_SESSION["Second_Stop_Flight_No"]=$_POST["Second_Stop_Flight_No"];
$_SESSION["Second_Stop_DepartureTime"]=$_POST["Second_Stop_DepartureTime"];
$_SESSION["Final_ArrivalTime_twostop"]=$_POST["Final_ArrivalTime"];
$_SESSION["Final_Airport"]=$_POST["Final_Airport"];
echo "<h1>Enter details of Passengers</h1>";
echo "<br><br>";
echo '<form action="payment_twostop.php" method = "post">';
for($x=1;$x<=$_SESSION["No_of_Seats_twostop"];$x++)
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
