<?php

//This function checks if the user is an administrator.
//This function takes two optional values.
//This function returns a Boolean value.
function is_administrator($name = 'ECAM', $value = 'Info')
{
  if (isset($_COOKIE[$name]) && ($_COOKIE[$name] == $value))
  {
    return true;
  }
  else
  {
    return false;
  }
}

function is_connected($name = 'test', $value = 'test')
{
  if (isset($_COOKIE[$name]) && ($_COOKIE[$name] == $value))
  {
    return true;
  }
  else
  {
    return false;
  }
}

function get_something($value)
{
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
      $id = $row[$value];

    } // End of while loop.
    return $id;
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
}
?>
