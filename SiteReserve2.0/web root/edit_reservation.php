<?php

// Define a page title and include the header:
define('TITEL', 'Edit a Reservation');
include('templates/header.html');

print '<h2>Edit a Reservation</h2>';

// Restrict access to administrators only:
if (!is_administrator())
{
  print '<h2>Access Denied!</h2><p class="error">You do not have permission to access this page.</p>';
  include('templates/footer.html');
  exit();
}

// Need the database connection:
include('../mysqli_connect.php');

if (isset($_GET['id']) && is_numeric($_GET['id']) && ($_GET['id'] > 0))
{
  // Define the query.
  $query = "SELECT destination, nbpeople, assurance FROM reservations WHERE id={$_GET['id']}";
  if ($result = mysqli_query($dbc, $query))
  {
    // Retrieve the information.
    $row = mysqli_fetch_array($result);

    // Make the form: the input values are less secure because you are suppose to be a good admin.
    print '<form action="edit_reservation.php" method="post">
      <p><label>ID: ' . $_GET['id'] . '</label></p>
      <p><label>Destination <input type="text" name="destination" value="' .
      htmlentities($row['destination']) . '"></label></p>
      <p><label>Number of people <input type="number" min="1" name="nbpeople" value="' .
      htmlentities($row['nbpeople']) . '"></label></p>
      <p><label>Assurance? <input type="checkbox" name="assurance" value="yes"';

    // Check the box for the assurance:
    if ($row['assurance'] == 1)
    { print ' checked="checked"'; }

    // Complete the form:
    print '></label></p>
      <input type="hidden" name="id" value="' . $_GET['id'] . '">
      <p><input type="submit" name="submit" value="Update This Reservation!"></p>
      </form>';
  }
  else
  {
    // Couldn't get the information. Only an admin can see this.
    print '<p class="error">Could not retrieve the reservation because:<br>' . mysqli_error($dbc) .
    '.</p><p>The query being run was: ' . $query . '</p>';
  }
} elseif (isset($_POST['id']) && is_numeric($_POST['id']) && ($_POST['id'] > 0))
{ // Handle the form.
  // Validate and secure the form data:
  $problem = FALSE;
  if (!empty($_POST['destination']) && !empty($_POST['nbpeople']))
  {
    // Prepare the values for storing:
    $destination = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['destination'])));
    $nbpeople = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['nbpeople'])));

    // Create the assurance value:
    if (isset($_POST['assurance']))
    { $assurance = 1; }
    else
    { $assurance = 0; }
  }
  else
  {
    print '<p class="error">Please submit both a destination and a nbpeople.</p>';
    $problem = TRUE;
  }

  if (!$problem)
  {
    // Define the query.
    $query = "UPDATE reservations SET destination='$destination', nbpeople='$nbpeople', assurance=$assurance WHERE id={$_POST['id']}";
    if ($result = mysqli_query($dbc, $query))
    {
      print '<p>The reservation has been update.</p>';
    }
    else
    {
      // Couldn't get the information. Only an admin can see this.
      print '<p class="error">Could not update the reservation because:<br>' . mysqli_error($dbc) .
      '.</p><p>The query being run was: ' . $query . '</p>';
    }
  }
}
else
{ // No ID set.
  print '<p class="error">This page has been accessed in error.</p>';
} // End of main IF.

// Close the connection.
mysqli_close($dbc);

// Include the footer.
include('templates/footer.html');
?>
