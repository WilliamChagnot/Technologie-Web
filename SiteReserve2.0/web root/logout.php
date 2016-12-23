<?php

// Destroy the coockie, but only if it already exist:
if (isset($_COOKIE['ECAM']))
{
  setcookie('ECAM', FALSE, time()-4000);
}

// Define a page title and include the header:
define('TITLE', 'Logout');
include('templates/header.html');

// Print a message:
echo '<p>You are now logged out.</p>';

// Include the footer:
include('templates/footer.html');
?>
