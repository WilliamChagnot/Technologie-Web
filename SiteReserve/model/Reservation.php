<?php

class Reservation
{
  private $Destination;
  private $NbPlace;
  private $Assurance;

  public function __construct($destin = "", $place = 1, $insur = false)
  {
    $this->Destination = $destin;
    $this->NbPlace = $place;
    $this->Assurance = $insur;
  }

  public function getDestination()
  {
    return $this->Destination;
  }
  public function setDestination($destin)
  {
    $this->Destination = $destin;
  }

  public function getNbPerson()
  {
    return $this->NbPlace;
  }
  public function setNbPerson($place)
  {
    $this->NbPlace = $place;
  }

  public function getAssurance()
  {
    return $this->Assurance;
  }
  public function setAssurance($insur)
  {
    $this->Assurance = $insur;
  }
}
?>
