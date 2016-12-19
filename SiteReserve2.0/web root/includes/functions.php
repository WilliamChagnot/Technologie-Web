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

//This function clean the database by deleting the rows in reservations who don't have peoples link with.
//This function don't take value.
//This function don't return value.
function clean()
{
  // Need the database connection:
  include('../mysqli_connect.php');

  // Define the query for the resrvations table:
  $queryR = 'SELECT id, destination, nbpeople, assurance FROM reservations ORDER BY date_entered';

  // Run the query:
  if ($resultR = mysqli_query($dbc, $queryR))
  {
    //Retrieve the returned records:
    while ($rowR = mysqli_fetch_array($resultR))
    {
      // Check if the id's matches, if they match -> it's usefull, if not -> is useless.
      $usefull = false;
      $queryP = 'SELECT name, age, id FROM peoples ORDER BY date_entered';

      // Run the query:
      if ($resultP = mysqli_query($dbc, $queryP))
      {
        //Retrieve the returned records:
        while ($rowP = mysqli_fetch_array($resultP))
        {
          // The id's matches?
          if ($rowP['id'] == $rowR['id'])
          {
            $usefull = true;
          }
        }
      }

      // If the row in reservation don't have peoples associate.
      if (!$usefull)
      {
        print 'useless';
        $query = "DELETE FROM reservations WHERE id={$rowR['id']} LIMIT 1";
        $result = mysqli_query($dbc, $query);

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
    } // End of while loop.
  }

  // Close the connection.
  mysqli_close($dbc);
}
?>
