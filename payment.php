<?php
require_once('server.php');
require_once('errors.php');

if(empty($_SESSION['username'])) {
	array_push($errors, "Please Login First.");
  header('location: login.php');
}
include('templates/header.php');
  $now = new DateTime();
	$curr= $now->format('Y-m-d H:i:s');


if(isset($_POST["pay"]))
{

  require_once('connect.php');


	/*
	   Execute Queries
	*/
	$User_ID = $_SESSION['username'];
	for($x=1;$x<=$_SESSION["No_of_Seats"];$x++)
	{
	$Flight_no=$_SESSION["Flight_no"];
	$sql = "SELECT Airline_ID,Account_No FROM Flights where Flight_no = '$Flight_no'";
	$result =  sqlsrv_query($db,$sql, array(), array( "Scrollable" => 'keyset' ));
	$Ticket_ID="";
	$Account_credited="";
	while($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
    {
       $Ticket_ID = $row["Airline_ID"];
       $Account_credited = NULL;
    }
    $sql = "SELECT count(*) as Total from ticket ";
	$result =  sqlsrv_query($db,$sql, array(), array( "Scrollable" => 'keyset' )); 
	$var="";
	while($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
    {
       $var = $row["Total"];
    }
    $Ticket_ID = $Ticket_ID." ".$var;
    $payment_ID = $var+46;
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
    // $Account_No=$_POST["Account_No"];
    $now = new DateTime();
    $today= $now->format('Y-m-d');
    $time = strftime('%I:%M:%S');
    $Total_Price=$_SESSION["Total_Price"];
		 $Total_Price=$Total_Price/$_SESSION["No_of_Seats"];
     $a = array('Economy'=>0,'FirstClass'=>1,'Buisness'=>2);

    //  echo $payment_ID ."<br>";
    //   echo $Total_Price;
    $sql_t = "insert into ticket 
    VALUES(1,0,0,NULL,NULL,'$Ticket_ID',$a[$Class],'$today','$time',
    '$Flight_no','$User_ID','$Date_of_travelling')";
    $connection = sqlsrv_query($db,$sql_t); 
  //  // var_dump($sql);
    $sql_p = "insert into [airlineresvervationsystem].[dbo].[payment]
      VALUES($payment_ID,NULL,NULL,'$today','$time','online',$Total_Price,'$Ticket_ID')";
    $result = sqlsrv_query($db,$sql_p); ;
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

echo "<h2>Summary :- </h2>";
echo "Flight_no : ".$Flight_no."<br><br>";
echo "ArrivalTime : ".$_SESSION["Date_of_travelling"]." ".$ArrivalTime."<br><br>";
echo "DepartureTime : ".$_SESSION["Date_of_travelling"]." ".$DepartureTime."<br><br>";
echo "Total Price :".$No_of_seats*$Price."<br><br>";
$_SESSION["Total_Price"]=$No_of_seats*$Price;
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
echo '<form action="payment.php" method = "post">';
// echo 'Account No : <input type="text" name="Account_No" required><br>';
echo '<input type="Submit" name="pay" value = "PAY!!">';
?>
<?php include('templates/footer.php'); ?>
