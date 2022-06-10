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

if(isset($_POST["pay"]))
{
    $connection = new mysqli("localhost","root","","airlineresvervationsystem");
    if($connection->connect_error){
    die("Connection failed: ".$connection->connect_error."\n");}
    $User_ID = $_SESSION['username'];

    /*
       For first flight
    */
    $now = new DateTime();
    $curr= $now->format('Y-m-d H:i:s');

    for($x=1;$x<=$_SESSION["No_of_Seats_twostop"];$x++)
	{
	$Flight_no=$_SESSION["Start_Flight_no_twostop"];
	$Class=$_SESSION["Class_twostop"];
    $col = $Class.'Price';
	$sql = "SELECT Airline_ID,Account_No,$col FROM Flights where Flight_no = '$Flight_no'";
	$result = $connection->query($sql);
	$Ticket_ID="";
	$Account_credited="";
    $newPrice=0;
	while($row = $result->fetch_assoc())
    {
       $Ticket_ID = $row["Airline_ID"];
       $Account_credited = $row["Account_No"];
       $newPrice=$row["$col"];
    }
    $sql = "SELECT count(*) as Total from Ticket ";
	$result = $connection->query($sql);
	$var="";
	while($row = $result->fetch_assoc())
    {
       $var = $row["Total"];
    }
    $Ticket_ID = $Ticket_ID." ".$var;
    $Class=$_SESSION["Class_twostop"];
    $Airport_Id_Src=$_SESSION["Airport_Id_Src"];
    $Airport_Id_Dst=$_SESSION["First_Stop_Airport"];
    $Flight_no=$_SESSION["Start_Flight_no_twostop"];
    $Passenger_name_=$_SESSION["Passenger_name_".$x.""];
    $Passenger_email_=$_SESSION["Passenger_email_".$x.""];
    $Passenger_contact_=$_SESSION["Passenger_contact_".$x.""];
    $ArrivalTime=$_SESSION["First_Stop_ArrivalTime"];
    $DepartureTime=$_SESSION["Start_DepartureTime_twostop"];
    $Date_of_travelling=$_SESSION["Date_of_travelling"];
    $Account_No=$_POST["Account_No"];
    $Total_Price=0;
     $Total_Price=$newPrice;
    if($_SESSION["mul"]>=0)
              {
                $Total_Price = $Total_Price + ceil($Total_Price*$_SESSION["mul"]);
              }
    $sql = "insert into Ticket VALUES(1,0,0,NULL,'$Ticket_ID','$Class','$curr','$Airport_Id_Src','$Airport_Id_Dst','$Flight_no','$User_ID','$Passenger_name_','$Passenger_email_','$Passenger_contact_','$ArrivalTime','$DepartureTime','$Date_of_travelling')";
    $connection->query($sql);
   // var_dump($sql);
    $sql = "insert into Payment(Account_credited,Account_debited,TimeOfPayment,ModeOfPayment,Amount,Ticket_ID)
      VALUES('$Account_credited','$Account_No','$curr','online','$Total_Price','$Ticket_ID')";
    $connection->query($sql);
    }
    /*
    Second flight
    */
    for($x=1;$x<=$_SESSION["No_of_Seats_twostop"];$x++)
	{
	$Flight_no=$_SESSION["First_Stop_Flight_No"];
	$Class=$_SESSION["Class_twostop"];
    $col = $Class.'Price';
	$sql = "SELECT Airline_ID,Account_No,$col FROM Flights where Flight_no = '$Flight_no'";
	$result = $connection->query($sql);
	$Ticket_ID="";
	$Account_credited="";
    $newPrice=0;
	while($row = $result->fetch_assoc())
    {
       $Ticket_ID = $row["Airline_ID"];
       $Account_credited = $row["Account_No"];
       $newPrice=$row["$col"];
    }
    $sql = "SELECT count(*) as Total from Ticket ";
	$result = $connection->query($sql);
	$var="";
	while($row = $result->fetch_assoc())
    {
       $var = $row["Total"];
    }
    $Ticket_ID = $Ticket_ID." ".$var;
    $Class=$_SESSION["Class_twostop"];
    $Airport_Id_Src=$_SESSION["First_Stop_Airport"];
    $Airport_Id_Dst=$_SESSION["Second_Stop_Airport"];
    $Flight_no=$_SESSION["First_Stop_Flight_No"];
    $Passenger_name_=$_SESSION["Passenger_name_".$x.""];
    $Passenger_email_=$_SESSION["Passenger_email_".$x.""];
    $Passenger_contact_=$_SESSION["Passenger_contact_".$x.""];
    $ArrivalTime=$_SESSION["Second_Stop_ArrivalTime"];
    $DepartureTime=$_SESSION["First_Stop_DepartureTime"];
    $Date_of_travelling=$_SESSION["Date_of_travelling"];
    $Account_No=$_POST["Account_No"];
    $Total_Price=0;
     $Total_Price=$newPrice;
    if($_SESSION["mul"]>=0)
              {
                $Total_Price = $Total_Price + ceil($Total_Price*$_SESSION["mul"]);
              }
    $sql = "insert into Ticket VALUES(1,0,0,NULL,'$Ticket_ID','$Class','$curr','$Airport_Id_Src','$Airport_Id_Dst','$Flight_no','$User_ID','$Passenger_name_','$Passenger_email_','$Passenger_contact_','$ArrivalTime','$DepartureTime','$Date_of_travelling')";
    $connection->query($sql);
   // var_dump($sql);
    $sql = "insert into Payment(Account_credited,Account_debited,TimeOfPayment,ModeOfPayment,Amount,Ticket_ID)
      VALUES('$Account_credited','$Account_No','$curr','online','$Total_Price','$Ticket_ID')";
    $connection->query($sql);
    }
    /*
    Third Flight
    */
    for($x=1;$x<=$_SESSION["No_of_Seats_twostop"];$x++)
	{
	$Flight_no=$_SESSION["Start_Flight_no_twostop"];
$Class=$_SESSION["Class_twostop"];
  $col = $Class.'Price';
$sql = "SELECT Airline_ID,Account_No,$col FROM Flights where Flight_no = '$Flight_no'";
$result = $connection->query($sql);
$Ticket_ID="";
$Account_credited="";
  $newPrice=0;
while($row = $result->fetch_assoc())
  {
     $Ticket_ID = $row["Airline_ID"];
     $Account_credited = $row["Account_No"];
     $newPrice=$row["$col"];
  }
    $sql = "SELECT count(*) as Total from Ticket ";
	$result = $connection->query($sql);
	$var="";
	while($row = $result->fetch_assoc())
    {
       $var = $row["Total"];
    }
    $Ticket_ID = $Ticket_ID." ".$var;
    $Class=$_SESSION["Class_twostop"];
    $Airport_Id_Src=$_SESSION["Second_Stop_Airport"];
    $Airport_Id_Dst=$_SESSION["Final_Airport"];
    $Flight_no=$_SESSION["Second_Stop_Flight_No"];
    $Passenger_name_=$_SESSION["Passenger_name_".$x.""];
    $Passenger_email_=$_SESSION["Passenger_email_".$x.""];
    $Passenger_contact_=$_SESSION["Passenger_contact_".$x.""];
    $ArrivalTime=$_SESSION["Final_ArrivalTime_twostop"];
    $DepartureTime=$_SESSION["Second_Stop_DepartureTime"];
    $Date_of_travelling=$_SESSION["Date_of_travelling"];
    $Account_No=$_POST["Account_No"];
    $Total_Price=0;
     $Total_Price=$newPrice;
    if($_SESSION["mul"]>=0)
              {
                $Total_Price = $Total_Price + ceil($Total_Price*$_SESSION["mul"]);
              }
    $sql = "insert into Ticket VALUES(1,0,0,NULL,'$Ticket_ID','$Class','$curr','$Airport_Id_Src','$Airport_Id_Dst','$Flight_no','$User_ID','$Passenger_name_','$Passenger_email_','$Passenger_contact_','$ArrivalTime','$DepartureTime','$Date_of_travelling')";
    $connection->query($sql);
   // var_dump($sql);
    $sql = "insert into Payment(Account_credited,Account_debited,TimeOfPayment,ModeOfPayment,Amount,Ticket_ID)
      VALUES('$Account_credited','$Account_No','$curr','online','$Total_Price','$Ticket_ID')";
    $connection->query($sql);
    }
    echo "<script type='text/javascript'>window.location.href = 'payment_done.php';</script>";
    exit();
}

echo "<h2>Summary :- </h2>";

echo "Date_of_travelling: ".$_SESSION["Date_of_travelling"]."<br><br>";
echo "No_of_Seats_twostop: ".$_SESSION["No_of_Seats_twostop"]."<br><br>";
echo "Price_twostop: ".$_SESSION["Price_twostop"]."<br><br>";
echo "Duration_twostop: ".$_SESSION["Duration_twostop"]."<br><br>";
echo "Class_twostop: ".$_SESSION["Class_twostop"]."<br><br>";
echo "Start_Airport: ".$_SESSION["Start_Airport"]."<br><br>";
echo "Start_Flight_no_twostop: ".$_SESSION["Start_Flight_no_twostop"]."<br><br>";
echo "Start_DepartureTime_twostop: ".$_SESSION["Start_DepartureTime_twostop"]."<br><br>";
echo "First_Stop_ArrivalTime: ".$_SESSION["First_Stop_ArrivalTime"]."<br><br>";
echo "First_Stop_Airport: ".$_SESSION["First_Stop_Airport"]."<br><br>";
echo "First_Stop_Flight_No: ".$_SESSION["First_Stop_Flight_No"]."<br><br>";
echo "First_Stop_DepartureTime: ".$_SESSION["First_Stop_DepartureTime"]."<br><br>";
echo "Second_Stop_ArrivalTime: ".$_SESSION["Second_Stop_ArrivalTime"]."<br><br>";
echo "Second_Stop_Airport: ".$_SESSION["Second_Stop_Airport"]."<br><br>";
echo "Second_Stop_Flight_No: ".$_SESSION["Second_Stop_Flight_No"]."<br><br>";
echo "Second_Stop_DepartureTime: ".$_SESSION["Second_Stop_DepartureTime"]."<br><br>";
echo "Final_ArrivalTime_twostop: ".$_SESSION["Final_ArrivalTime_twostop"]."<br><br>";
echo "Final_Airport: ".$_SESSION["Final_Airport"]."<br><br>";

echo "<b>Total amount : </b>".$_SESSION['Price_twostop']*$_SESSION['No_of_Seats_twostop']."<br><br>";
for($x=1;$x<=$_SESSION["No_of_Seats_twostop"];$x++)
{
	echo "Passenger ".$x." Details : "."<br>";
	echo 'Name: "'.$_POST["Passenger_name_".$x.""].'"  Email:  "'.$_POST["Passenger_email_".$x.""].'" Contact : "'.$_POST["Passenger_contact_".$x.""];
	echo "<br><br>";
	$_SESSION["Passenger_name_".$x.""]=$_POST["Passenger_name_".$x.""];
	$_SESSION["Passenger_email_".$x.""]=$_POST["Passenger_email_".$x.""];
    $_SESSION["Passenger_contact_".$x.""]=$_POST["Passenger_contact_".$x.""];
}
echo "<br><br>";
echo '<form action="payment_twostop.php" method = "post">';
echo 'Account No : <input type="text" name="Account_No" required>';
echo '<input type="Submit" name="pay" value = "PAY!!">';

?>
<?php include('templates/footer.php'); ?>
