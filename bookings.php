<?php
  require_once('server.php');
  require_once('templates/header.php');

?>

<body>
  <?php include('templates/navbar.php'); ?>

<?php
   //connect to database
   require_once('connect.php');

  if(isset($_POST['reject'])){

    $id = trim($_GET['Ticket_ID']);
    $time = strftime('%I:%M:%S');
    $update_status_query = " UPDATE ticket SET Booking_Status='0',Cancellation_Status='1',CancellationTime_hours='$time'
    WHERE Ticket_ID='$id'";
    $update_status = sqlsrv_query($db,$update_status_query);
    if(!$update_status){
      echo '<div class="container"><div class="alert alert-warning alert-dismissible fade show" role="alert">' .
        'Failed to update. Please try again.' . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' .
        '<span aria-hidden="true">&times;</span></button></div></div>';
      die("QUERY FAILED ".sqlsrv_error($db));
    } else {
      echo '<div class="container"><div class="alert alert-success alert-dismissible fade show" role="alert">' .
          'Successfully Updated.<button type="button" class="close" data-dismiss="alert" aria-label="Close">' .
          '<span aria-hidden="true">&times;</span></button></div></div>';
    }
  }
?>

  <div class="container" style="margin: 50px 25px 100px 100px;">
    <div class="tab-content" id="TabContent">
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">S.No.</th>
              <th scope="col">User ID</th>
              <th scope="col">Passenger Name</th>
              <th scope="col">Source-Destination</th>
              <th scope="col">Flight Number</th>
              <th scope="col">Arrival</th>
              <th scope="col">Departure</th>
              <th scope="col">Date of Travel</th>
              <th scope="col">Cancel</th>
            </tr>
          
        
          </thead>

          <?php
         
       $username=   $_SESSION['username'] ;

            $query ="SELECT Ticket_ID, t.Userr_ID,Airport_ID_Src+' To '+Airport_ID_Dst as Src, f.Flight_no,p.ArrivalTime,p.DepartureTime, Date_of_departure from ticket t inner join flights f on t.Flight_no=f.Flight_no
            inner join passes p on f.Flight_no=p.Flight_no
            where Booking_Status =1 and t.Userr_ID='$username' order by Date_of_departure;";
            
          $q_passname =  "select First_Name+' '+Last_Name as passname from person
          where Person_ID = '$username'";
          $data_passname = sqlsrv_query($db, $q_passname,array(), array( "Scrollable" => 'keyset' ));

          $row_passname = sqlsrv_fetch_array($data_passname);
          $pass_name = $row_passname['passname'];
            $data = sqlsrv_query($db, $query,array(), array( "Scrollable" => 'keyset' ));
            if(sqlsrv_num_rows($data) != 0){
          ?>
          <tbody>
            <?php
              $curr = 1;
              while($row = sqlsrv_fetch_array($data)){
                if(date("Y-m-d")>$row['Date_of_departure'])
                {
                echo '<tr><th scope="row">' . $curr . '</th>' .
                          '<td>' . $row["Userr_ID"] . '</td>' .
                          '<td>' . $pass_name . '</td>' .
                          '<td>' . $row["Src"] . '</td>' .
                          '<td>' . $row["Flight_no"] . '</td>' .
                          '<td>' . date_format($row["ArrivalTime"] ,'H-i-s'). '</td>' .
                          '<td>' . date_format($row["DepartureTime"],'H-i-s') . '</td>' .
                          '<td>' . date_format($row["Date_of_departure"] ,'Y-m-d'). '</td>' .
                          '<td><form action="' . $_SERVER['PHP_SELF'] . '?Ticket_ID=' . $row["Ticket_ID"] . '&tab=1" method="post">' .
                          '<button type="reject" class="btn btn-outline-danger" name="reject" >Cancel</button></form></td>' .
                      '</tr>';
                    }
                    else {
                        echo '<tr><th scope="row">' . $curr . '</th>' .
                                  '<td>' . $row["Userr_ID"] . '</td>' .
                                  '<td>' . $pass_name . '</td>' .
                                  '<td>' . $row["Src"] .'</td>' .
                                  '<td>' . $row["Flight_no"] . '</td>' .
                                  '<td>' . date_format($row["ArrivalTime"] ,'H-i-s'). '</td>' .
                                  '<td>' . date_format($row["DepartureTime"],'H-i-s') . '</td>' .
                                  '<td>' . date_format($row["Date_of_departure"] ,'Y-m-d'). '</td>' .
                                  '<td><form action="' . $_SERVER['PHP_SELF'] . '?Ticket_ID=' . $row["Ticket_ID"] . '&tab=1" method="post">' .
                                  '<button type="reject" class="btn btn-outline-danger" name="reject">Cancel</button></form></td>' .
                              '</tr>';
                    }
                $curr = $curr + 1;
              }
            ?>
          </tbody>
          <?php } else { ?>
            <tr>
              <td>No data</td>
            </tr>
          <?php } ?>
        </table>
      </div>
  </div>


</body>

<?php require_once('templates/footer.php'); ?>
