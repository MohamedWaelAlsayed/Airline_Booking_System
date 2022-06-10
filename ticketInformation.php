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
//var_dump($_SESSION);
$No_of_seats = $_POST["No_of_Seats"];
$DepartureTime = $_POST["DepartureTime"];
$ArrivalTime = $_POST["ArrivalTime"];
$Price = $_POST["Price"];
$Duration = $_POST["Duration"];
$Flight_no = $_POST["Flight_no"];
$Class = $_POST["Class"];
echo "<h1>Enter details of Passengers</h1>";
echo "<br><br>";
echo '<form action="payment.php" method = "post">';
for($x=1;$x<=$No_of_seats;$x++)
{
	echo "Enter details for passenger ".$x."<br>";
    echo 'Name : <input type="text" name="Passenger_name_'.$x .'" required> ';
    echo 'Email : <input type="text" name="Passenger_email_'.$x.'" > ';
    echo 'Contact No : <input type="text" name="Passenger_contact_'.$x.'" >';
    echo "<br><br>";
}
echo '<input type="hidden" name="DepartureTime" value= '.$DepartureTime.' > ';
echo '<input type="hidden" name="ArrivalTime" value= '.$ArrivalTime.' > ';
echo '<input type="hidden" name="Flight_no" value= "'.$Flight_no.'" > ';
echo '<input type="hidden" name="Duration" value= '.$Duration.' > ';
echo '<input type="hidden" name="No_of_Seats" value= '.$No_of_seats.' > ';
echo '<input type="hidden" name="Price" value= '.$Price.' > ';
echo '<input type="hidden" name="Class" value= '.$Class.' > ';
echo '<input type="submit" value="submit" name="submit">'.'</form>';
?>

<?php include('templates/footer.php'); ?>
