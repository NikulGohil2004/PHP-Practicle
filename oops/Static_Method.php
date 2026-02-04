<?php
// static method is used to call the method  without creating object first.
// static properties will calles direct without calling object first.
class newmessage{

    public static $Value=3.14;
  public static function welcome() {  // to use in same class using self key word
    echo "Nikul Gohil";

  }

  public function __construct() {
    self::welcome();
  }
}
echo newmessage::$Value;
new newmessage()."<br>";
