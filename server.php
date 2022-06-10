<?php
session_start();

$username = "";
$email="";
$phone = "";
$firstname = "";
$lastname = "";
$gender="";
$dob="";
$errors = array();

//connect to database
require_once('connect.php');


//if the register button is clicked

if(isset($_POST['register']))
 {
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $dob=$_POST['dob'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];

    //checks if form fields are filled
    if(empty($username))
    {
      array_push($errors, "Username is required.");
    }
    if(empty($firstname))
    {
      array_push($errors, "Full Name is required.");
    }
    if(empty($email))
    {
      array_push($errors, "Email is required.");
    }
    if(empty($lastname))
    {
      array_push($errors, "Full Name is required.");
    }
    if(empty($phone))
    {
      array_push($errors, "Phone No. is required.");
    }
    if(empty($password_1))
    {
      array_push($errors, "Password is required.");
    }
    if($password_1!=$password_2)
    {
      array_push($errors,"The two passwords do not match.");
    }

    //if no errors are found, registration will be complete.
    if(count($errors)==0)
    {
      $password = $password_1;
      //password is encrypted before storing in the database.
      $result1 = sqlsrv_query( $db, "SELECT * FROM [airlineresvervationsystem].[dbo].[users] WHERE Email = '$email'", array(), array( "Scrollable" => 'keyset' ));  
      $result2 = sqlsrv_query( $db, "SELECT * FROM [airlineresvervationsystem].[dbo].[users] WHERE Userr_ID = '$username'", array(), array( "Scrollable" => 'keyset' ));

  	    $count1 = sqlsrv_num_rows($result1);
  	    $count2 = sqlsrv_num_rows($result2);

      if($count1+$count2==0)
        {
          // that means no user or email registerd before with same information
          $sql = "INSERT INTO [dbo].[person]
          ([Person_ID]
          ,[First_Name]
          ,[Last_Name]
          ,[DOB]
          ,[Gender]
          ,[Phone_No])
    VALUES('$username','$firstname','$lastname','$dob','$gender','$phone');
    INSERT INTO [dbo].[users]
           ([Userr_ID]
           ,[Email]
           ,[Pass_word])
     VALUES
           ('$username','$email','$password')
    
    ";


              
          $r_sql =sqlsrv_query($db,$sql);
          if($r_sql)
          {
            // Sending mail and then redirecting to homepage
            $_SESSION['username']=$username;
            $_SESSION['success'] = "You are now logged in.";

            //Heading to HOMEPAGE
            header('location: index.php');
            // echo 'done';
       
          }
        }
      else{
              	if($count1>=1)
              	{
                array_push($errors, "The email is exist already.");;
                }
                if($count2>=1)
                {
                array_push($errors, "The username already exists.");
                }
                // header("location: signup.php?type=null");
        }
    }
  }

//logging in (from loginpage)
if(isset($_POST['login']))
{
  $username = $_POST['username'];
  $password = $_POST['password'];
  //ensure fields are entered.
  if(empty($username))
  {
    array_push($errors, "Username is required.");
  }
  if(empty($password))
  {
    array_push($errors, "Password is required.");
  }
  if(count($errors)==0)
  {
    $password= $password; // encrypting password for security.
    $query= "SELECT * FROM [airlineresvervationsystem].[dbo].[users] WHERE Userr_ID= '$username' AND Pass_word='$password' ";
    $result = sqlsrv_query($db,$query, array(), array( "Scrollable" => 'keyset' ));

    $query1 = "SELECT Pass_word FROM [airlineresvervationsystem].[dbo].[users] WHERE Userr_ID = '$username'";
    $query2 = "SELECT Userr_ID FROM [airlineresvervationsystem].[dbo].[users] WHERE Pass_word = '$password'";
      $result1 = sqlsrv_query($db,$query1, array(), array( "Scrollable" => 'keyset' ));
      $result2 =  sqlsrv_query($db,$query2, array(), array( "Scrollable" => 'keyset' ));
      $row1 = sqlsrv_fetch_array($result1,SQLSRV_FETCH_ASSOC);
      $row2 = sqlsrv_fetch_array($result2,SQLSRV_FETCH_ASSOC);
      $count1 = sqlsrv_num_rows($result1);
      $count2 = sqlsrv_num_rows($result2);

    if(sqlsrv_num_rows($result)==1)
    {
      //log user in
      $_SESSION['username']=$username;
      $_SESSION['success'] = "You are now logged in.";
      header('location: index.php');
    }
    else
    {
      array_push($errors, "The username/password combination is incorrect.");
      if($count2==0)
      {
        array_push($errors," The Username does not exist.");
      }
      else if ($count1==1)
      {
        array_push($errors, "Incorrect password.");
      }
    }
  }
}


//logging in (from admin)
if(isset($_POST['adminlogin']))
{
  $username = $_POST['username'];
  $password = $_POST['password'];
  //ensure fields are entered.
  if(empty($username))
  {
    array_push($errors, "Username is required.");
  }
  if(empty($password))
  {
    array_push($errors, "Password is required.");
  }
  if(count($errors)==0)
  {
// encrypting password for security.
    $query= "SELECT * FROM [airlineresvervationsystem].[dbo].[admin]   WHERE username= '$username' AND password='$password' ";
    $result = sqlsrv_query($db,$query);

    $query1 = "SELECT password FROM [airlineresvervationsystem].[dbo].[admin]  WHERE username = '$username'";
    $query2 = "SELECT username FROM [airlineresvervationsystem].[dbo].[admin] WHERE password = '$password'";
      $result1 = sqlsrv_query($db,$query1,array(), array( "Scrollable" => 'keyset' ));
      $result2 =  sqlsrv_query($db,$query2,array(), array( "Scrollable" => 'keyset' ));
      $row1 = sqlsrv_fetch_array($result1,sqlsrv_ASSOC);
      $row2 = sqlsrv_fetch_array($result2,sqlsrv_ASSOC);
      $count1 = sqlsrv_num_rows($result1);
      $count2 = sqlsrv_num_rows($result2);

    if(sqlsrv_num_rows($result)==1)
    {
      //log user in
      $_SESSION['username']=$username;
      $_SESSION['success'] = "You are now logged in.";
      $home_url = 'http://' . $_SERVER['HTTP_HOST'] .'/airline-booking-system/admin/adminhome.php';
      header('Location: ' . $home_url);
    }
    else
    {
      array_push($errors, "The username/password combination is incorrect.");
      if($count1==0)
      {
        array_push($errors," The Username does not exist.");
      }
      else if ($count1==1)
      {
        array_push($errors, "Incorrect password.");
      }
    }
  }
}

  //Logout
  if(isset($_GET['logout']))
  {
    session_destroy();
    unset($_SESSION['username']);
    header('location: index.php');
    $home_url = 'http://' . $_SERVER['HTTP_HOST'] .'/airline-booking-system/index.php';
    header('Location: ' . $home_url);
  }

  ?>
