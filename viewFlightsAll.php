<?php
session_start();
require_once('templates/header.php');
?>
<body>

<?php
include('templates/navbar.php');
$Date_of_travelling =$_POST['Date'];
$_SESSION["Date_of_travelling"]=$Date_of_travelling;

require_once('connect.php');
$day_number = date("N", strtotime($Date_of_travelling));

$sql = "SELECT Flight_no,DepartureTime,ArrivalTime FROM passes where ArrivalDays = $day_number AND  DepartureDays =$day_number )";

$col = 'Class Price';

echo "<table style='float : left' border='4' cellspacing='0' >
<tr>
<td  colspan='8'>ALL DIRECT FLIGHTS</td>
</tr>
<tr>
<th>Flight_no</th>
<th>DepartureTime</th>
<th>ArrivalTime</th>
<th>TOTAL DURATION</th>
<th>PRICE</th>
<th><b>BOOK</b><th>
</tr>";
$result = sqlsrv_query($db,$sql,array(), array( "Scrollable" => 'keyset' ));
while($row =sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
{
              $var = $row["Flight_no"];
              $sql1 = "SELECT $col from flights where Flight_no='$var'";
              $result1 = $connection->query($sql1);
              $price =0;
              while($row1 = $result1->fetch_assoc())
              {
                 $price = $row1["$col"];
              }
              echo "<tr>";
              echo "<td>" . $row["Flight_no"]. "</td>";
              echo "<td>" . $row["DepartureTime"] . "</td>";
              echo "<td>" . $row["ArrivalTime"] . "</td>";
              $datetime1 = new DateTime($Date_of_travelling.$row["DepartureTime"]);
              $datetime2 = new DateTime($Date_of_travelling.$row["ArrivalTime"]);
              $interval = $datetime1->diff($datetime2);
              if(strtotime($row["ArrivalTime"])<=strtotime($row["DepartureTime"]))
              {
               $datetime2 = new DateTime(date('Y-m-d', strtotime($Date_of_travelling. ' + 1 days')).$row["ArrivalTime"]);
               $interval = $datetime1->diff($datetime2);
              }
              $duration = $interval->format('%h')." Hours ".$interval->format('%i')." Minutes";
              echo "<td>" .$interval->format('%h')." Hours ".$interval->format('%i')." Minutes". "</td>";
              echo "<td>". $price."</td>";
              echo "<td>";
              echo '<form action="ticketInformation.php" method="post">';
              echo '<input type="hidden" name="DepartureTime" value= '.$row["DepartureTime"].' > ';
              echo '<input type="hidden" name="ArrivalTime" value= '.$row["ArrivalTime"].' > ';
              $x = $row["Flight_no"];
              echo '<input type="hidden" name="Flight_no" value="'.$x.'" >';
              echo '<input type="hidden" name="Duration" value= "'.$duration.'" > ';
              echo '<input type="hidden" name="No_of_Seats" value= '.$No_of_Seats.' > ';
              echo '<input type="hidden" name="Price" value= '.$price.' > ';
              echo '<input type="hidden" name="Class" value= '.$Class.' > ';
              echo '<input type="submit" name="submit" value ="submit">';
              echo '</form>';
              echo "</td>";
              echo "</tr>";
}
echo "</table>";
$result->free();
$connection->close();
?>
</body>
<?php
require_once('templates/footer.php');
?>
