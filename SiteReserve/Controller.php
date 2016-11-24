<?php
session_start();

include_once("model\Reservation.php");
include_once("model\Person.php");

if (!isset($_SESSION['Reservation']))
{
  $Reservation = new Reservation();
  $_SESSION['Reservation'] = serialize($Reservation);
}
else
{
  $Reservation = unserialize($_SESSION['Reservation']);
}

$error = false;
$array_people = (isset($_SESSION['Person'])) ? unserialize($_SESSION['Person']) : array();


#Reservation part.
if (isset($_POST['ReservSent']))
{
  if (!isset($_POST['Destination']) || !is_numeric($_POST['NbPlace']))
  {
    $error = true;
    include 'view/Reservation_view.php';
  }
  else
  {
    $Reservation->setDestination(htmlspecialchars($_POST['Destination']));
    $Reservation->setNbPerson(htmlspecialchars($_POST['NbPlace']));

    if(isset($_POST['Assurance']))
    {
      $Reservation->setAssurance(true);
    }
    else
    {
      $Reservation->setAssurance(false);
    }

    $_SESSION['Reservation']=serialize($Reservation);
    include 'view/Details_view.php';
  }
}


#Details Part.
elseif (isset($_POST['DetailsSent']))
{
  for ($i=0; $i<$Reservation->getNbPerson(); $i++)
  {
    if (checkEntries($_POST['name'][$i], $_POST['age'][$i]))
    {
      $new_person = new Person();
      $new_person->setName(htmlspecialchars($_POST['name'][$i]));
      $new_person->setAge(htmlspecialchars($_POST['age'][$i]));

      $array_people[$i] = $new_person;
    }
    else
    {
      $error = true;
      include 'view/Details_view.php';
    }
  }

  if(!$error)
  {
    $_SESSION['Person'] = serialize($array_people);

    $Assurance = ($Reservation->getAssurance()) ? 'oui' : 'non';

    include 'view/Validation_view.php';
  }
}


#Validation Part.
elseif (isset($_POST['ValidationSent']))
{
  session_unset();
  session_destroy();
  include 'view/Last_view.php';
}

elseif (isset($_POST['cancel']))
{
  session_unset();
  session_destroy();
  include 'view/Reservation_view.php';
}

elseif(isset($_POST['DetailsBack']))
{
    include 'view/Details_view.php';
}

#Launch website
else
{
  include 'view/Reservation_view.php';
}

#functions.
function checkEntries($name, $age)
{
  if(strlen($name) == 0)
  {
    return false;
  }
  if (!is_numeric($age) || $age<0 || $age>120)
  {
    return false;
  }
  return true;
}

?>
