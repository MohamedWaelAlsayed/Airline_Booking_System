  <nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Home</a>
    <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button> -->
    <!-- <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li>
      </ul>
      <span class="navbar-text">
        Navbar text with an inline element
      </span>
        <a class="nav-link" href="#">Pricing</a>
    </div> -->
    <?php if(!isset($_SESSION['username'])) { ?>

    <div class="dropdown">
      <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Sign In
      </a>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <a class="dropdown-item" href="login.php">Sign In</a>
        <a class="dropdown-item" href="register.php">Sign Up</a>
      </div>
    </div>
  <?php } else { ?>
      <div class="dropdown">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <?php echo $_SESSION['username']; ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          <a class="dropdown-item" href="bookings.php">Bookings</a>
          <a class="dropdown-item" href="index.php?logout='1'" style="color: red;">Logout</a>
        </div>
      </div>
  <?php } ?>

  </nav>
