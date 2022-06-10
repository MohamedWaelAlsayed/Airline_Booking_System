<?php
require_once('server.php');
require_once('errors.php');

if(empty($_SESSION['username'])) {
	array_push($errors, "Please Login First.");
  header('location: login.php');
}
include('templates/header.php');

if(isset($_POST["pay"]))
{
	$connection = new mysqli("localhost","root","","airlineresvervationsystem");
    if($connection->connect_error){
    die("Connection failed: ".$connection->connect_error."\n");}
	/*
	   Execute Queries
	*/
	  $now = new DateTime();
    $curr= $now->format('Y-m-d H:i:s');
	$User_ID = $_SESSION['username'];
	for($x=1;$x<=$_SESSION["No_of_Seats"];$x++)
	{
	$Flight_no=$_SESSION["Flight_no"];
	$sql = "SELECT Airline_ID,Account_No FROM Flights where Flight_no = '$Flight_no'";
	$result = $connection->query($sql);
	$Ticket_ID="";
	$Account_credited="";
	while($row = $result->fetch_assoc())
    {
       $Ticket_ID = $row["Airline_ID"];
       $Account_credited = $row["Account_No"];
    }
    $sql = "SELECT count(*) as Total from Ticket ";
	$result = $connection->query($sql);
	$var="";
	while($row = $result->fetch_assoc())
    {
       $var = $row["Total"];
    }
    $returnTicket_ID= $Ticket_ID." ".$var;
    $Ticket_ID = $Ticket_ID." ".($var+1);
    $Class=$_SESSION["Class"];
    $Airport_Id_Src=$_SESSION["Airport_Id_Src"];
    $Airport_Id_Dst=$_SESSION["Airport_Id_Dst"];
    $Flight_no=$_SESSION["Flight_no"];
    $Passenger_name_=$_SESSION["Passenger_name_".$x.""];
    $Passenger_email_=$_SESSION["Passenger_email_".$x.""];
    $Passenger_contact_=$_SESSION["Passenger_contact_".$x.""];
    $ArrivalTime=$_SESSION["ArrivalTime"];
    $DepartureTime=$_SESSION["DepartureTime"];
    $Date_of_travelling=$_SESSION["Date_of_travelling"];
    $Account_No=$_POST["Account_No"];

    $returnDate_of_travelling=$_SESSION["returnDate_of_travelling"];
    $returnNo_of_seats = $_SESSION["returnNo_of_Seats"];
    $returnDepartureTime = $_SESSION["returnDepartureTime"];
    $returnArrivalTime = $_SESSION["returnArrivalTime"];
    $returnPrice = $_SESSION["returnPrice"];
    $returnDuration = $_SESSION["returnDuration"];
    $returnFlight_no = $_SESSION["returnFlight_no"];
    $returnClass = $_SESSION["returnClass"];


    $Total_Price=$_SESSION["Total_Price"];
    $sql = "insert into Ticket VALUES(1,0,0,NULL,'$Ticket_ID','$Class','$curr','$Airport_Id_Src','$Airport_Id_Dst','$Flight_no','$User_ID','$Passenger_name_','$Passenger_email_','$Passenger_contact_','$ArrivalTime','$DepartureTime','$Date_of_travelling')";
    $connection->query($sql);

    //retrn ticket
    $sql = "insert into Ticket VALUES(1,0,0,NULL,'$returnTicket_ID','$returnClass','$curr','$Airport_Id_Dst','$Airport_Id_Src','$returnFlight_no','$User_ID','$Passenger_name_','$Passenger_email_','$Passenger_contact_','$returnArrivalTime','$returnDepartureTime','$returnDate_of_travelling')";
    $connection->query($sql);

   // var_dump($connection);
    $sql = "insert into Payment(Account_credited,Account_debited,TimeOfPayment,ModeOfPayment,Amount,Ticket_ID)
      VALUES('$Account_credited','$Account_No','$curr','online','$Total_Price','$Ticket_ID')";
    $result = $connection->query($sql);

    $sql = "insert into Payment(Account_credited,Account_debited,TimeOfPayment,ModeOfPayment,Amount,Ticket_ID)
      VALUES('$Account_credited','$Account_No','$curr','online','$Total_Price','$returnTicket_ID')";
    $result = $connection->query($sql);
    }

	echo "<script type='text/javascript'>window.location.href = 'payment_done.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
include('templates/navbar.php');
$No_of_seats = $_POST["No_of_Seats"];
$_SESSION['No_of_Seats']=$No_of_seats;
$DepartureTime = $_POST["DepartureTime"];
$_SESSION['DepartureTime']=$DepartureTime;
$ArrivalTime = $_POST["ArrivalTime"];
$_SESSION["ArrivalTime"]=$ArrivalTime;
$Price = $_POST["Price"];
$_SESSION["Price"]=$Price;
$Duration = $_POST["Duration"];
$_SESSION["Duration"]=$Duration;
$Flight_no = $_POST["Flight_no"];
$_SESSION["Flight_no"]=$Flight_no;
$Class = $_POST["Class"];
$_SESSION["Class"]=$Class;

$returnDate_of_travelling=$_SESSION["returnDate_of_travelling"];
$returnNo_of_seats = $_SESSION["returnNo_of_Seats"];
$returnDepartureTime = $_SESSION["returnDepartureTime"];
$returnArrivalTime = $_SESSION["returnArrivalTime"];
$returnPrice = $_SESSION["returnPrice"];
$returnDuration = $_SESSION["returnDuration"];
$returnFlight_no = $_SESSION["returnFlight_no"];
$returnClass = $_SESSION["returnClass"];
// var_dump($returnPrice);
/*
$Price=0??????????????????????
*/
// $Price=0;
// $returnPrice=0;
//check once

echo "<h2>Summary :- </h2>";
?>
<div class="container">
  <div class="row">
    <div class="col-sm">
<?php
echo "Flight_no : ".$Flight_no."<br><br>";
echo "ArrivalTime : ".$_SESSION["Date_of_travelling"]." ".$ArrivalTime."<br><br>";
echo "DepartureTime : ".$_SESSION["Date_of_travelling"]." ".$DepartureTime."<br><br>";
echo "Price :".$No_of_seats*($Price)."<br><br>";

for($x=1;$x<=$No_of_seats;$x++)
{
	echo "Passenger ".$x." Details : "."<br>";
	echo 'Name: "'.$_POST["Passenger_name_".$x.""].'"  Email:  "'.$_POST["Passenger_email_".$x.""].'" Contact : "'.$_POST["Passenger_contact_".$x.""];
	echo "<br><br>";
	$_SESSION["Passenger_name_".$x.""]=$_POST["Passenger_name_".$x.""];
	$_SESSION["Passenger_email_".$x.""]=$_POST["Passenger_email_".$x.""];
    $_SESSION["Passenger_contact_".$x.""]=$_POST["Passenger_contact_".$x.""];

}
echo "<br><br>";
?>
</div>
  <div class="col-sm">
<?php
echo "Flight_no : ".$returnFlight_no."<br><br>";
echo "ArrivalTime : ".$_SESSION["returnDate_of_travelling"]." ".$ArrivalTime."<br><br>";
echo "DepartureTime : ".$_SESSION["returnDate_of_travelling"]." ".$DepartureTime."<br><br>";
echo "Price : ".$No_of_seats*($returnPrice)."<br><br>";

for($x=1;$x<=$No_of_seats;$x++)
{
echo "Passenger ".$x." Details : "."<br>";
echo 'Name: "'.$_POST["Passenger_name_".$x.""].'"  Email:  "'.$_POST["Passenger_email_".$x.""].'" Contact : "'.$_POST["Passenger_contact_".$x.""];
echo "<br><br>";
$_SESSION["Passenger_name_".$x.""]=$_POST["Passenger_name_".$x.""];
$_SESSION["Passenger_email_".$x.""]=$_POST["Passenger_email_".$x.""];
  $_SESSION["Passenger_contact_".$x.""]=$_POST["Passenger_contact_".$x.""];

}
echo "<br><br>";
?>
</div>
</div>
<?php
echo "Total Price :".$No_of_seats*($Price+$returnPrice)."<br><br>";
 ?>
</div>



<?php
$_SESSION["Total_Price"]=$No_of_seats*($Price+$returnPrice);
echo '<form action="paymentRoundTrip.php" method = "post">';
echo 'Account No : <input type="text" name="Account_No" required><br>';
echo '<input type="Submit" name="pay" value = "PAY!!">';
?>

<?php include('templates/footer.php'); ?>
