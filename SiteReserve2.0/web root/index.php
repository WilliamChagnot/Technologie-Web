<?php
session_start();
/* This is the home page for this site.*/

// Include the header:
include('templates/header.html');

if (!is_connected())
{
  setcookie('test', 'test', time()+3600);
}

print '<p><a href="add_reservation.php">Add Reservation</a></p>';

// Include the footer:
include('templates/footer.html');
?>
