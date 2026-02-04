<?php

//abstraction with no argument

abstract class Car {
  public $name;
  public function __construct($name) {
    $this->name = $name;
  }
  abstract public function intro() : string;
}


class Audi extends Car {

  public function intro() : string {
    return "Choose $this->name!";
  }
}

$audi = new audi("Audi");
echo $audi->intro()."<br>";

// Abstract method with an argument

abstract class ParentClass {

  abstract protected function prefixName($name);
}

class ChildClass extends ParentClass {
  public function prefixName($name) {
    if ($name == "John Doe") {
      $prefix = "Mr.";
    } elseif ($name == "Jane Doe") {
      $prefix = "Mrs.";
    } else {
      $prefix = "";
    }
    return "{$prefix} {$name}";
  }
}

$class = new ChildClass;
echo $class->prefixName("John Doe")."<br>";

echo $class->prefixName("Jane Doe");