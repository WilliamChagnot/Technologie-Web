<?php
// This page lets people log into the site.

// Set two variables with defaut values.
$loggedin = false;
$error = false;

// Check if the form has been submitted.
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

  // Handle the form:
  if (!empty($_POST['email']) && !empty($_POST['password']))
  {
    if ((strtolower($_POST['email']) == 'me@example.com') && ($_POST['password'] == 'testpass'))
    {
      // Create the cookie:
      setcookie('ECAM', 'Info', time()+3600);

      // Indicate they are logged in.
      $loggedin = true;
    }
    else
    {
      $error = 'The submitted email address and password do not match those on file!';
    }
  }
  else //forgot a field.
  {
    $error = 'Please make sur you enter both an email address and a password!';
  }
}

// Set the page title and include the header file.
define('TITLE', 'Login');
include("templates/header.html");

// Print an error if one exists.
if ($error) {
  print "<p class='error'>" . $error . "</p>";
}

// Indicate the user is logged in, or show the form.
if ($loggedin)
{
  print "<p>You are now logged in!</p>";

} else {

  print "<h2>Login Form</h2>
  <form action='login.php' method='post'>
  <p><label>Email Address <input type='email' name='email'></label></p>
  <p><label>Password <input type='password' name='password'></label></p>
  <p><input type='submit' name='submit' value='Log In!'</p>
  </form>";

}

include("templates/footer.html"); // Need the footer.
?>
