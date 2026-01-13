<?php

// interface allow which method class will implement

interface Animal {
  public function makeSound();
}

class Dog implements Animal {
  public function makeSound() {
    echo "Bark"."<br>";
  }

}
class Cat implements Animal {
  public function makeSound() {
    echo "meow";
  }

}

$dog = new Dog();
$cat = new Cat();
$dog->makeSound();
$cat->makeSound();