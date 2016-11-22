<?php

class Reservation
{

  public function getDestination()
  {
    return $this->destination;
  }

  public function getNbPerson()
  {
    return $this->nbPerson;
  }

  public function getAssurance()
  {
    return $this->assurance;
  }

  public function validAssurance()
  {
    $this->assurance = True;
  }
}
?>
