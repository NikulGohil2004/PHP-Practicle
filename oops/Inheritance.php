<?php

//using inheritance we can access methods and and properties usind extend keyword
class Fruit {
  public $name;
  public function __construct($name) {
    $this->name = $name;
  }
  public function intro() {
    echo "The fruit is {$this->name}.";
  }
}


class Strawberry extends Fruit {
  public function message() {
    echo "Am I a fruit or a berry? ";
  }
}
$strawberry = new Strawberry("Strawberry");
$strawberry->message();
$strawberry->intro();

// using final keyword we can not inherit the class it will show fatal error