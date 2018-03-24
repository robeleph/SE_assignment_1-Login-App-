<?php
require_once('dbConnect.php');
	//starting Session
   session_start();



   //getting values from the form
   $username = $_POST['username'];
   $password = $_POST['password']; 
   $AccountType = $_POST['select']; 

   //query for cheking if username and password are stored in the database
   $mysqli_qry ="select *from login  where username like '$username'and password like '$password' and AccountType like '$AccountType';";
   
   //executing query
   $result = mysqli_query($con,$mysqli_qry);



   //if number of rows are greater than zero user exists, so setting and unsetting cookies according to the remember me checkbox
   if (mysqli_num_rows($result)>0) {

          // getting ;the class of the user loggged in
         $row = mysqli_fetch_assoc($result);
         $class = $row["Class"];    
         $_SESSION['Class']= $class;                    
                                 


    if ($AccountType=="Adminstrator") 
      {
        $_SESSION['Admin-logged-in']="true";
        header('location:Admin.php');
      }

else{

   $_SESSION['logged_in'] ="true";
   $_SESSION['Username'] = "$username";
  //if remember me is clicked set cookie for the username and password
  if (!empty($_POST['rememberme'])) 
  {
   setcookie("Username",$username,time()+(10*365*24*60*60));
   setcookie("Password",$password,time()+(10*365*24*60*60));
   header('location:main.php');
  }
  //if remember me is not clicked unset the values of cookie
  else
  {
   setcookie("Username","");
   setcookie("Password","");
   header('location:main.php');
 }
}
}
//if user name and password doesnt match setting the login status session and redirecting to login screen
  else 
{
      $_SESSION['login_failed'] ="failed";
      header("location:login.php");
} 
//closing connection with the db
   mysqli_close($con);	
   ?>
