

<?php

// destructor will called when script will end 
class Cars {
  public $name;


  function __construct($name) {
    $this->name = $name;
  }
  function __destruct() {
    echo "The car is {$this->name}.";
  }
}

$car = new Cars("volvo");