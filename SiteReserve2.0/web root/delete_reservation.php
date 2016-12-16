<?php

// Define a page title and include the header:
define('TITLE', 'Delete a Reservation');
include('templates/header.html');

print '<h2>Delete a Reservation</h2>';

// Restrict acces to administrators only:
if (!is_administrator())
{
  print '<h2>Acces Denied!</h2><p class="error">You do not have permission to access this pasge.</p>';
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

    // Make the form:
    print '<form action="delete_reservation.php" method="post">
    <p>Are you sure you want to delete this reservation?</p>
    <div><blockquote>' . $row['destination'] . '</blockquote> ' . $row['nbpeople'];

    // Assurance?
    if ($row['assurance'] == 1)
    {
      print ' <strong>Assurance!</strong>';
    }

    print '</div><br><input type="hidden" name="id" value="' . $_GET['id'] . '">
    <p><input type="submit" name="submit" value="Delete this Reservation!"></p>
    </form>';
  }
  else
  {
    // Couldn't get the information.
    print '<p class="error">Cloud not retrieve the reservation because:<br>' . mysqli_error($bdc) .
    '.</p><p>The query being run was: ' . $query . '</p>';
  }
} elseif (isset($_POST['id']) && is_numeric($_POST['id']) && ($_POST['id'] > 0))
{
  // Define the query:
  $query = "DELETE FROM reservations WHERE id={$_POST['id']} LIMIT 1";
  $result = mysqli_query($dbc, $query); // Execute the query.

  // Report on the result:
  if (mysqli_affected_rows($dbc) == 1)
  {
    print '<p>The reservation has been deleted.</p>';
  }
  else
  {
    print '<p class="error">Could not delete the blog entry because:<br>' . mysqli_error($bdc) .
    '</p><p>The query being run was: ' . $query . '</p>';
  }
}
else
{ // No ID received.
  print '<p class="error">This page has been accessed in error.</p>';
} // End of main IF.

// Close the connection.
mysqli_close($dbc);

// Include the footer.
include('templates/footer.html');
?>
