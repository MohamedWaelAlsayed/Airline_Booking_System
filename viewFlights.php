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

$Airport_Id_Src = $_POST['Source'];
$Airport_Id_Dst = $_POST['Destination'];
$_SESSION["Airport_Id_Dst"]=$Airport_Id_Dst;
$_SESSION["Airport_Id_Src"]=$Airport_Id_Src;
$Date_of_travelling =$_POST['Date'];
$_SESSION["Date_of_travelling"]=$Date_of_travelling;
$Class = $_POST['Class'];
$No_of_Seats = $_POST['no_of_seats'];
$Via = $_POST['Via'];
$now = new DateTime();
$today= $now->format('Y-m-d');
$date1=date_create($today);
$date2=date_create($Date_of_travelling);
$diff=date_diff($date1,$date2);
$days_gap= $diff->format("%a");
$mul = (1.0 - $days_gap/(100.0));
$_SESSION["mul"]=$mul;

//connect to database
require_once('connect.php');

$day_number = date("N", strtotime($Date_of_travelling));
$col = $Class.'Price';

$sql = "select f.Flight_no, $col,DepartureDays,DepartureTime,ArrivalTime, DATEDIFF(HOUR,DepartureTime,ArrivalTime) as 'TOTAL DURATION' from flights f inner join passes p
on f.Flight_no = p.Flight_no
where $Class=1 and Airport_ID_Dst like '%$Airport_Id_Dst%' and Airport_ID_Src like '%$Airport_Id_Src%'
and DATEDIFF(day,'$today','$Date_of_travelling')>=0";





echo "<table style='float : left' border='4' cellspacing='0' >
<tr>
<td  colspan='8'>ALL DIRECT FLIGHTS</td>
</tr>
<tr>
<th>Flight_no</th>
<th>no of days before start flight</th>
<th>DepartureTime</th>
<th>ArrivalTime</th>
<th>TOTAL DURATION</th>
<th>PRICE</th>
<th><b>BOOK</b><th>
</tr>";
$result = sqlsrv_query($db,$sql, array(), array( "Scrollable" => 'keyset' ));
while($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
{
              $var = $row["Flight_no"];
        
              echo "<tr>";
              echo "<td>" . $row["Flight_no"]. "</td>";
              echo "<td>".$row["DepartureDays"]."</td>";
              echo "<td>" . date_format($row["DepartureTime"],'H-i-s').'</td>';
              echo "<td>" .date_format($row["ArrivalTime"] ,'H-i-s').'</td>';
              echo "<td>" . $row['TOTAL DURATION']. "</td>"; 
              echo "<td>". $row[$col]."</td>";
              echo "<td>";
              echo '<form action="ticketInformation.php" method="post">';
              echo '<input type="hidden" name="DepartureTime" value= '.date_format($row["DepartureTime"],'H-i-s').' > ';
              echo '<input type="hidden" name="ArrivalTime" value= '.date_format($row["ArrivalTime"] ,'H-i-s').' > ';
              $x = $row["Flight_no"];
              echo '<input type="hidden" name="Flight_no" value="'.$x.'" >';
              echo '<input type="hidden" name="Duration" value= "'.$row['TOTAL DURATION'].'" > ';
              echo '<input type="hidden" name="No_of_Seats" value= '.$No_of_Seats.' > ';
              echo '<input type="hidden" name="Price" value= '.$row[$col].' > ';
              echo '<input type="hidden" name="Class" value= '.$Class.' > ';
              echo '<input type="submit" name="submit" value ="submit">';
              echo '</form>';
              echo "</td>";
              echo "</tr>";
}
echo "</table>";
?>
  <?php include('templates/footer.php'); ?>
