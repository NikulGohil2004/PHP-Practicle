<?php

// oops concepts
// 1. class and object

//inside class using $this keyword
class Cars {

  public $name;

  function set_name($name) {
    $this->name = $name;
  }
}

$bmw = new Cars();
$f1 = new Cars();
$bmw->set_name('Bmw');
$f1->set_name('F1');

echo $f1->name."<br>";
echo $bmw->name."<br>";

//outside class

class City{
    public $name;
}
$london = new City();
$london -> name ="London";

echo $london -> name."<br>";

// check the obj belongs to the class?
var_dump($london instanceof City);




