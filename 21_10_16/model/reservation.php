<?php

class Reservation
{
  private destination;
  private assurance;
  private nbPerson;

  public function __construct($destination, $assurance)
  {
    $this->destination = $destination;
    $this->nbPerson = $nbPerson;
    $this->assurance = False;
  }

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
