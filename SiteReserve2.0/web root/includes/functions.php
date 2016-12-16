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

//This function checks if the user have pass through the index page.
//This function takes two optional values.
//This function returns a Boolean value.
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

//This function is use to get the a value in the database from the last user.
//This function takes two optional values.
//This function returns a value.
function get_something($value, $sort = 'date_entered')
{
  // Need the database connection:
  include('../mysqli_connect.php');

  // Define the query:
  $query = 'SELECT id, destination, nbpeople, assurance FROM reservations ORDER BY " . $sort . " DESC';

  // Run the query:
  if ($result = mysqli_query($dbc, $query))
  {
    //Retrieve the returned records:
    while ($row = mysqli_fetch_array($result))
    {
      // Take the last value:
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

// Calculate the cost.
function price($age)
{
  $price = 0;

  if ($age <= 12)
  {
    $price += 10;
  }
  else {
    $price += 15;
  }
  return $price;
}

// Work in progress.
function clean()
{
  // Need the database connection:
  include('../mysqli_connect.php');



  // Define the query:
  $idR = 'SELECT id FROM reservations';
  $idP = 'SELECT id FROM peoples';

  // Run the query:
  if ($resultR = mysqli_query($dbc, $idR) && $resultP = mysqli_query($dbc, $idP))
  {
    $useless = true;

    //Retrieve the returned records:
    while ($rowR = mysqli_fetch_array($resultR))
    {
      while ($rowP = mysqli_fetch_array($resultP))
      {
        print 'ici';
        if ($rowR['id'] == $rowP['id'])
        {
          $useless = false;
        }
      }
      if ($useless)
      {
        // Define the query:
        $query = "DELETE FROM reservations WHERE id='$idR' LIMIT 1";
        $result = mysqli_query($dbc, $query); // Execute the query.

        // Report on the result:
        if (mysqli_affected_rows($dbc) == 1)
        {
          print '<p>Clean.</p>';
        }
        else
        {
          print '<p class="error">Could not delete the blog entry because:<br>' . mysqli_error($bdc) .
          '</p><p>The query being run was: ' . $query . '</p>';
        }
      }
    } // End of while loop.
  }

  // Close the connection.
  mysqli_close($dbc);
}
?>
