<?php
trait first1 {
public function msg1() {
    echo "Traits working";
  }
  public function msg2() {
    echo "Traits working toooooo";
  }
}

class Welcome {
  use first1;
}
class Nikul{
    use first1;
}

$obj = new Welcome();
$obj->msg1();
$obj->msg2();
$objj = new Nikul();
$objj->msg2();