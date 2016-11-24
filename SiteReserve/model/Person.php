<?php

class Person
{
  private $name;
  private $age;

  function __construct($name = "", $age = 0)
  {
    $this->name = $name;
    $this->age = $age;
  }

  public function getName()
  {
    return $this->name;
  }
  public function setName($name)
  {
    $this->name = $name;
  }

  public function getAge()
  {
    return $this->age;
  }
  public function setAge($age)
  {
    $this->age = $age;
  }
}

?>
