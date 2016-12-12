<?php

// Include the header:
define('TITLE', 'View All Reservations');
include('templates/header.html');

print '<h2>All Reservations</h2>';

// Restrict access to administrators only:
if (!is_administrator())
{
  print '<h2>Acces Denied!</h2><p class="error">You do not have permission to access this page.</p>';
  include('templates/footer.html');
  exit();
}

// Need the database connection:
include('../mysqli_connect.php');

// Define the query:
$query = 'SELECT id, destination, nbpeople, assurance FROM reservations ORDER BY date_entered DESC';

// Run the query:
if ($result = mysqli_query($dbc, $query))
{
  //Retrieve the returned records:
  while ($row = mysqli_fetch_array($result))
  {
    // Print the record:
    print "<div><blockquote>ID: {$row['id']}</blockquote><blockquote>{$row['destination']}</blockquote>NbPeople: {$row['nbpeople']}\n";

    // Is this a favorite?
    if ($row['assurance'] == 1)
    {
      print '<strong>Assurance!</strong>';
    }

    // Add administrative links:
    print "<p><b>Admin:</b> <a href=\"edit_reservation.php?id={$row['id']}\">Edit</a>
    <->
    <a href=\"delete_reservation.php?id={$row['id']}\">Delete</a></p></div>\n";
  } // End of while loop.
}
else
{
  // Query didn't run.
  print '<p class="error">Could not retrieve the data because:<br>' .
  mysqli_error($dbc) . '.</p><p>The query being run was: ' . $query .
  '</p>';
} // End of query IF.

// Close the connection.
mysqli_close($dbc);

// Include the footer.
include('templates/footer.html');
?>
