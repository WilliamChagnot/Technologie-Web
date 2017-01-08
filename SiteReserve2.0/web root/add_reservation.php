<?php
session_start();

// Define a page title and include the header.
define('TITLE', 'Add a Reservation');
include('templates/header.html');

// Restrict access to connected people only.
if (!is_connected())
{
  print '<h2>Access Denied!</h2><p classe="error">You do not have permission to access this page.</p><p classe="error">Please go back to the Home page.</p>';
  include('templates/footer.html');
  exit();
}

// Check for a form submission.
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

  if (!empty($_POST['destination']) && !empty($_POST['nbpeople']))
  {
    $_SESSION['nbpeople'] = $_POST['nbpeople'];
    $_SESSION['destination'] = $_POST['destination'];

    // Set to get the price.
    $_SESSION['price'] = 0;

    // Need the database connection.
    include('../mysqli_connect.php');

    // Prepare the values for storing.
    $destination = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['destination'])));
    $nbpeople = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['nbpeople'])));

    // Create the "assurance" value.
    if (isset($_POST['assurance']))
    { $assurance = 1;
      $_SESSION['price'] += 20; }
    else
    { $assurance = 0; }

    // Define the query.
    $query = "INSERT INTO reservations (destination, nbpeople, assurance) VALUES ('$destination', '$nbpeople', '$assurance')";
    mysqli_query($dbc, $query);

    // The reservation has been made.
    if (mysqli_affected_rows($dbc) == 1)
    {
      // Get the ID from the user.
      $_SESSION['id'] = get_something('id');
      print '<p>Your reservation has been stored.</p><p>Your ID is: ' . $_SESSION['id'] . '</p>';

      // include the view.
      include('templates/people.html');
    }

    // The reservation didn't works.
    else { error(); }

    // Close the connection.
    mysqli_close($dbc);
  }
  // Validation of the people doing the reservation ("name" and "age" are array).
  elseif (!empty($_POST['name']) && !empty($_POST['age'])) {

    $_SESSION['name'] = $_POST['name'];
    $_SESSION['age'] = $_POST['age'];

    // Need the database connection.
    include('../mysqli_connect.php');

    for($i=0; $i<$_SESSION['nbpeople']; $i++)
    {
      // Get the right price.
      $_SESSION['price'] += price($_SESSION['age'][$i]);

      // Prepare the values for storing.
      $name = mysqli_real_escape_string($dbc, trim(strip_tags($_SESSION['name'][$i])));
      $age = mysqli_real_escape_string($dbc, trim(strip_tags($_SESSION['age'][$i])));
      $id = mysqli_real_escape_string($dbc, trim(strip_tags($_SESSION['id'])));

      // Define the query.
      $query = "INSERT INTO peoples (name, age, id) VALUES ('$name', '$age', '$id')";
      mysqli_query($dbc, $query);
    }

    // Check if the reservation has been made.
    if (mysqli_affected_rows($dbc) == 1)
    {
      // Prepare the value for storing.
      $price = mysqli_real_escape_string($dbc, trim(strip_tags($_SESSION['price'])));

      // Define the query.
      $querybis = "UPDATE reservations SET price = ('$price') WHERE id = ('$id')";
      mysqli_query($dbc, $querybis);
    }
    // Check if the reservation has been made.
    if (mysqli_affected_rows($dbc) == 1)
    {
      print '<p>Summary</p>
      <p>ID: ' . $_SESSION['id'] . '</p>
      <p>Destination: ' . $_SESSION['destination'] . '</p>
      <p>Number of people: ' . $_SESSION['nbpeople'] . '</p>
      <p>Please pay the amout of ' . $_SESSION['price'] . ' to the account 000-0000000-00.</p>';

      printpeople($_SESSION['id']);

      print '<p>We wish you a pleasant journey!</p>';
    }
    // Error.
    else { error(); }

    // Close the connection.
    mysqli_close($dbc);
  }
  else { print '<p class="error">Please enter a destination and a number of people!</p>'; }
} // End of submitted IF.
else { /*First page.*/ include('templates/destination.html'); }

include('templates/footer.html'); ?>
