<?php

include_once("model/Reservation.php");

class Controller{
  public $model;

  public function __construct()
  {
    $this->model = new Reservation();
  }

  public function invoke()
  {
    if(!isset($_GET['nbPerson']) && !isset($_GET['destination']))
    {
      include 'view/Reservation_view.php';
    }
    else
    {
      $personne = $this->model->getNbPerson($_GET['nbPerson']);
      $destination = $this->model->getDestination($GET_['destination']);
      include 'view/Choix_view.php';
    }
  }
}
?>
