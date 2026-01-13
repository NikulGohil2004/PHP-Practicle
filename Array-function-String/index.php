<?php
// sudo chmod +x /opt/lampp/lampp
// sudo /opt/lampp/lampp start
// cd /opt/lampp/htdocs


function myMessage($surname,$age){
    echo "my name is $surname Gohil and $age year old!";
}
myMessage("Nikul","21");

echo "<br/><br/>";

//return type

function sum(float $a,float $b){
    return $a+$b;
}
echo sum(100,100);

echo "<br/><br/>";

//default type

function setAge($age=20){
    echo "$age <br/>";
}
setAge(30);
setAge();

?>
