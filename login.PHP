<!DOCTYPE html>
<?php 

  session_start();
//if user has logged in redirect back to the main page
  if (isset($_SESSION['logged_in'])) 
  {
    header('location:main.php'); 
  }
  // if admin is logged in redirect back to admin page
  if (isset($_SESSION['Admin-logged-in'])) {
    header('location:Admin.php');
  }
 ?>

<html>
  
   <head>
	    <meta name="viewport" width="device-width,initial-scale=1">
	    <!-- importing stylesheet -->
	    <link rel="stylesheet" type="text/css" href="login.css">
	    <title> Ip Project</title>
       <!--changing the title image-->
      <link rel="shortcut icon" href="theHat.png"/>
	 </head>
   
   <body>
         <br><br><br><br><br><br>    
         
         <!-- Login form-->
         <form action="Iplogin.php" method="POST">
             <header id="login-header">Login Form</header>
             
             <label for="username">Username:</label>
             
             <!--get the values from the cookie if the cookies are set for both username and password-->
             <input type="text" name="username" placeholder="Username" id="username" value="<?php  
                 if (isset($_COOKIE['Username'])) 
                  {
                      echo $_COOKIE['Username'];
                  } ?>"
                      required>
             <label for="password">Password:</label>
             
             <input type="password" name="password" placeholder="Password" id="password" value="<?php  
                  if (isset($_COOKIE['Password']))
                   { 
                     echo $_COOKIE['Password'];
                   } ?>" required>
         
             <input type="checkbox" name="rememberme" id="checkbox">
             <label for="checkbox" id="RememberMe">RememberMe</label>
          
             <!--Select for the account type-->
             <label for="select" id="label_select">Account Type:</label>
             <select id="select" name="select">
                  <option value="user">User</option>
                  <option value="Adminstrator">Adminstrator</option>
             </select>
           
             <input type="submit" name="login" value="Login" id="login-button">
         
              <!--Checks if Username and password has matched if not displays error -->
              <?php
            
                  //display error if username and password dont match
                  if(isset($_SESSION['login_failed'])):?>
                     <label id="error">INVALID USERNAME OR PASSWORD PLEASE TRY AGAIN!!! </label>
                  <?php 
                   unset($_SESSION['login_failed']);
                   endif; ?>
       </form>

    </body>
</html>		