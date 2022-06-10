<?php
  require_once('server.php');
  require_once('templates/header.php');
?>

<body>

  <?php include('templates/navbar.php'); ?>

  <div class="container-fluid">
    <span>
    <h1 class="display-4" style="text-align:center; margin: 50px 0px 30px 0px">AIRLINE BOOKING SYSTEM</h1>
    <h1 class="display-5" style="text-align:center;">Book Now</h1>
    </span>

    <!-- <div class="container px-lg-5">
      <div class="row mx-lg-n5">
        <div class="col py-3 px-lg-5 border bg-light">Custom column padding</div>
        <div class="col py-3 px-lg-5 border bg-light">Custom column padding</div>
        <div class="col py-3 px-lg-5 border bg-light">Custom column padding</div>
        <div class="col py-3 px-lg-5 border bg-light">Custom column padding</div>
      </div>
    </div> -->


 <div class="container" style="margin:50px 100px 100px 100px;">
   <h1><b>Search Flights</b></h1>
   <br />
   <p><b>Choose your flight option</b></p>
   <div class="btn-group btn-group-justified">
     <div class="btn-group">
       <button id="button1" type="button" href="#oneway" class="btn btn-dark">One-way</button>
     </div>
     <!-- <div class="btn-group">
       <button id="button2" type="button" href="#roundtrip" class="btn btn-dark">Round-trip</button>
     </div> -->
     <!-- <div class="btn-group">
       <button id="button3" type="button" href="#all" class="btn btn-dark">Search all flights</button>
     </div> -->
   </div>
   <hr />
   <div id="oneway">
     <form role="form" action="viewFlights.php" method="post">
       <div class="row">
         <div class="col-sm-6">
           <label for="Source">From:</label>
           <input type="text" class="form-control" id="Source" name="Source" placeholder="City or Code" required>
         </div>
         <div class="col-sm-6">
           <label for="Destination">To:</label>
           <input type="text" class="form-control" id="Destination" name="Destination" placeholder="City or Code" required>
         </div>
       </div>
       <hr >
       <div class="row">
         <div class="col-sm-6">
           <label for="Date">Depart:</label>
           <input type="date" class="form-control" id="Date" name="Date" required min=<?php echo date('Y-m-d');?>>
         </div>
         <hr >
         <div class="col-sm-6">
           <label for="no_of_seats">Number Of Seats:</label>
           <input type="number" class="form-control" id="no_of_seats" name="no_of_seats" min="1" required>
         </div>
         <hr >
         <div class="col-sm-6">
           <label for="Class">Class:</label>
           <select class="form-control" name="Class">
             <option value="Economy">Economy</option>
             <option value="Buisness">Business</option>
             <option value="FirstClass">First Class</option>
           </select>
         </div>
       </div>
       <br>
       <div class="row">
         <div class="col-sm-6">
           <label class="radio-inline">
             <input type="radio" name="Via" value="DIRECT" checked>Non-Stop
           </label>
           <label class="radio-inline">
             <input type="radio" name="Via" value="ONE STOP">1 Stop
           </label>
           <label class="radio-inline">
             <input type="radio" name="Via" value="TWO STOP">2 Stop
           </label>
         </div>
       </div>
       <br>
       <div class="btn-group btn-group-justified">
         <div class="btn-group">
           <button type="submit" class="btn btn-success">Submit</button>
         </div>
         <div class="btn-group">
           <button type="reset"  class="btn btn-info" value="Reset">Reset</button>
         </div>
       </div>
     </form>
   </div>
   <div id="roundtrip">
     <form role="form" action="roundTrip.php" method="post">
       <div class="row">
         <div class="col-sm-6">
           <label for="Source">From:</label>
           <input type="text" class="form-control" id="Source" name="Source" placeholder="Code " required>
         </div>
         <div class="col-sm-6">
           <label for="Destination">To:</label>
           <input type="text" class="form-control" id="Destination" name="Destination" placeholder="Code" required>
         </div>
       </div>
       <hr >
       <div class="row">
         <div class="col-sm-6">
           <label for="Date">Depart:</label>
           <input type="date" class="form-control" id="Date" name="Date" required min=<?php echo date('Y-m-d');?>>
         </div>
         <div class="col-sm-6">
           <label for="returnDate">Return:</label>
           <input type="date" class="form-control" id="returnDate" name="returnDate" required min=<?php echo date('Y-m-d');?>>
         </div>
       </div>
       <hr >
       <div class="row">
          <div class="col-sm-6">
            <label for="no_of_seats">Number Of Seats:</label>
            <input type="number" class="form-control" id="no_of_seats" name="no_of_seats" min="1" required>
          </div>
          <hr >
         <div class="col-sm-6">
           <label for="Class">Class:</label>
           <select class="form-control" name="Class">
             <option value="Economy">Economy</option>
             <option value="Buisness">Business</option>
             <option value="FirstClass">First Class</option>
           </select>
         </div>
       </div>
       <br>
       <div class="form-group">
         <label class="radio-inline">
           <input type="radio" name="stop" value="nonstop" checked>Non-Stop
         </label>
       </div>
       <div class="btn-group btn-group-justified">
         <div class="btn-group">
           <button type="submit" class="btn btn-success">Submit</button>
         </div>
         <div class="btn-group">
           <button type="reset"  class="btn btn-info" value="Reset">Reset</button>
         </div>
       </div>
     </form>
   </div>
   <div id="all">
     <form role="form" action="viewFlightsAll.php" method="post">
       <div class="row">
         <div class="col-sm-6">
           <label for="Date">Select a date:</label>
           <input type="date" class="form-control" id="Date" name="Date" required>
         </div>
       </div>
       <br>
       <div class="row">
         <div class="col-sm-6">
           <button type="submit" class="btn btn-primary">Show ALL</button>
         </div>
       </div>
     </form>

   </div>
 </div>

</div>


<?php
  require_once('templates/footer.php');
?>
