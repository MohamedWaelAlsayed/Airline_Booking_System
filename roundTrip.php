<?php
require_once('server.php');
require_once('templates/header.php');
?>
<body>

<?php
include('templates/navbar.php');

$Airport_Id_Src = $_POST['Source'];
$Airport_Id_Dst = $_POST['Destination'];
$_SESSION["Airport_Id_Dst"]=$Airport_Id_Dst;
$_SESSION["Airport_Id_Src"]=$Airport_Id_Src;
$Date_of_travelling =$_POST['Date'];
$_SESSION["Date_of_travelling"]=$Date_of_travelling;
$Return_date_of_travelling =$_POST['returnDate'];
$_SESSION["returnDate_of_travelling"]=$Return_date_of_travelling;
$Class = $_POST['Class'];
$No_of_Seats = $_POST['no_of_seats'];
$Via = $_POST['stop'];
$connection = new mysqli("localhost","root","","airlineresvervationsystem");
if($connection->connect_error){
  die("Connection failed: ".$connection->connect_error."\n");}

$day_number = date("N", strtotime($Date_of_travelling));
$return_day_number = date("N", strtotime($Return_date_of_travelling));

$sql = "SELECT distinct Flight_no,DepartureTime,ArrivalTime FROM Passes where Airport_ID_Src='$Airport_Id_Src' && Airport_ID_Dst='$Airport_Id_Dst'  && Position('$day_number' in ArrivalDays) && Position('$day_number' in DepartureDays)";

$sql2 = "SELECT distinct Flight_no,DepartureTime,ArrivalTime FROM Passes where Airport_ID_Dst='$Airport_Id_Src' && Airport_ID_Src='$Airport_Id_Dst'  && Position('$return_day_number' in ArrivalDays) && Position('$return_day_number' in DepartureDays)";

$col = $Class.'Price';

?>

<div class="container" style="margin: 50px 0px 50px 125px;">
  <div class="row">
    <div class="col-sm">
      <form action="roundTripTicketInfo.php" method="post">
<?php
if($Via=='nonstop')
{
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
$result = $connection->query($sql);
while($row = $result->fetch_assoc())
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
              // echo '<form action="ticketInformation.php" method="post">';
              echo '<input type="hidden" name="DepartureTime" value= '.$row["DepartureTime"].' > ';
              echo '<input type="hidden" name="ArrivalTime" value= '.$row["ArrivalTime"].' > ';
              $x = $row["Flight_no"];
              echo '<input type="hidden" name="Flight_no" value="'.$x.'" >';
              echo '<input type="hidden" name="Duration" value= "'.$duration.'" > ';
              echo '<input type="hidden" name="No_of_Seats" value= '.$No_of_Seats.' > ';
              echo '<input type="hidden" name="Price" value= '.$price.' > ';
              echo '<input type="hidden" name="Class" value= '.$Class.' > ';
              echo '<input type="radio" name="radio" value ="'.$row["Flight_no"].'" required>';
              // echo '</form>';
              echo "</td>";
              echo "</tr>";
}
echo "</table>";
$result->free();
?>
</div>

    <div class="col-sm">
      <?php
        echo "<table style='float : left' border='4' cellspacing='0' >
        <tr>
        <td  colspan='8'>ALL DIRECT RETURN FLIGHTS</td>
        </tr>
        <tr>
        <th>Flight_no</th>
        <th>DepartureTime</th>
        <th>ArrivalTime</th>
        <th>TOTAL DURATION</th>
        <th>PRICE</th>
        <th><b>BOOK</b><th>
        </tr>";
        $result = $connection->query($sql2);
        while($row = $result->fetch_assoc())
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
                      // echo '<form action="ticketInformation.php" method="post">';
                      echo '<input type="hidden" name="returnDepartureTime" value= '.$row["DepartureTime"].' > ';
                      echo '<input type="hidden" name="returnArrivalTime" value= '.$row["ArrivalTime"].' > ';
                      $x = $row["Flight_no"];
                      echo '<input type="hidden" name="returnFlight_no" value="'.$x.'" >';
                      echo '<input type="hidden" name="returnDuration" value= "'.$duration.'" > ';
                      echo '<input type="hidden" name="returnNo_of_Seats" value= '.$No_of_Seats.' > ';
                      echo '<input type="hidden" name="returnPrice" value= "'.$price.'" > ';
                      echo '<input type="hidden" name="returnClass" value= '.$Class.' > ';
                      echo '<input type="radio" name="returnRadio" value ="'.$row["Flight_no"].'" required>';
                      // echo '</form>';
                      echo "</td>";
                      echo "</tr>";
        }
        echo "</table>";
        $result->free();
      ?>
    </div>
    <div class="col-sm" style="margin-top: 30px;">
      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        <!-- <input type="submit" name="submit" value="submit"> -->
    </div>

      </form>
   </div>
</div>
<?php
}
include('templates/footer.php');
?>
