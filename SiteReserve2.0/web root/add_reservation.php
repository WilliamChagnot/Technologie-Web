<?php

// Define a page title and include the header:
define('TITLE', 'Add a Reservation');
include('templates/header.html');

// Restrict access to administrators only:
if (!is_connected())
{
  print '<h2>Access Denied!</h2><p classe="error">You do not have permission to access this page.</p>';
  include('templates/footer.html');
  exit();
}

// Check for a form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if (!empty($_POST['destination']) && !empty($_POST['nbpeople']))
  {
    // Need the database connection:
    include('../mysqli_connect.php');

    // Prepare the values for storing:
    $destination = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['destination'])));
    $nbpeople = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['nbpeople'])));

    // Create the "assurance" value:
    if (isset($_POST['assurance']))
    { $assurance = 1; }
    else
    { $assurance = 0; }

    // Define the query.
    $query = "INSERT INTO reservations (destination, nbpeople, assurance) VALUES ('$destination', '$nbpeople', '$assurance')";
    mysqli_query($dbc, $query);

    // The reservation has been made.
    if (mysqli_affected_rows($dbc) == 1)
    {
      print '<p>Your reservation has been stored.</p><p>Your ID is: ' . get_something('id') . '</p>';
      ?>
      <form action="add_reservation.php" method="post">
        <?php
        for($i=0; $i<$nbpeople; $i++)
        {
          // Trying to get the name and age of the users.
          print '<p><label>Name ' . $i . ': <input type="text" name="name[]"></label></p>';
          print '<p><label>Age <input type="number" name="age[]"></label></p>';
        }
        ?>
        <p><input type="submit" name="submit" value="Add this reservation!"></p>
     </form>
     <?php
    }

    // The reservation didn't works.
    else { print '<p class="error">Could not store the reservation please contact an administrator.<br></p>'; }

    // Close the connection:
    mysqli_close($dbc);
  }
  // Validation of the people doing the reservation. ("name" and "age" are array).
  elseif (!empty($_POST['name']) && !empty($_POST['age'])) {

    // Need the database connection:
    include('../mysqli_connect.php');

    // Get the ID and the number of people from the last user.
    $nbpeople = get_something('nbpeople');
    $id = get_something('id');

    for($i=0; $i<$nbpeople; $i++)
    {
      // Prepare the values for storing:
      $name = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['name'][$i])));
      $age = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['age'][$i])));
      $id = mysqli_real_escape_string($dbc, trim(strip_tags($id)));

      // Define the query.
      $query = "INSERT INTO peoples (name, age, id) VALUES ('$name', '$age', '$id')";
      mysqli_query($dbc, $query);
    }

    // Check if the reservation has been made.
    if (mysqli_affected_rows($dbc) == 1)
    {
      print 'Successful!';
    }
    else {
      print 'Something might went wrong.';
    }
    // Close the connection:
    mysqli_close($dbc);
  }
  else
  {
    print '<p class="error">Please enter a destination and a number of people!</p>';
  }
} // End of submitted IF.
else {
  ?>
  <h2>Add a Reservation</h2><p>
  Le prix de la place est de 10€ jusqu'à 12 ans et ensuite de 15€.<br />
  Le prix de l'assurance annulation est de 20€ quel que soit le nombre de voyageurs.</p>
  <form action="add_reservation.php" method="post">
   <p><label>Destination </label>
     <select name="destination" size=1 id="destination">;
       <?php
       $destinations = array('Amsterdam','Berlin','Bruxelles','Londres','Paris');
       foreach($destinations as $destine)
       {
         echo '<option>' . $destine . '</option><br/>';
       }
       ?>
     </select></p>
     <p><label>Number of people <input type="number" name="nbpeople"></label></p>
     <p><label>Assurance? <input type="checkbox" name="assurance" value="yes"></label></p>
     <p><input type="submit" name="submit" value="Add this reservation!"></p>
  </form>
  <?php
}
?>

<?php include('templates/footer.html'); ?>
