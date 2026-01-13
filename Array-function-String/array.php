<?php

//do -1
//normal array 1
$fruit_Count= array("apple", "banana", "orange");
echo count($fruit_Count);
echo "=1<br/>";

//index array 2
echo $fruit_Count[0];
echo "=2<br/>";

//change value of second item 3
$fruit_Count[1]="pineple";
echo $fruit_Count[1];
echo "=3<br/>";

//iterate the element of array using forEach loop 4

foreach($fruit_Count as $x){
    echo "$x,";
}
echo "=4<br/>";

//associative array 5

$assoArray = array(1=>"maths",2=>"physics",3=>"chemistry");
echo $assoArray[1];
echo "=5<br/>";

//multidimensional array 6

$multiArray= array("apple", "banana", "orange",array(1,2,3));
echo $multiArray[3][0];
echo "=6<br/>";

//all keys to uppercase 7

$keyUppercase=array("Peter"=>"35","Ben"=>"37","Joe"=>"43");
print_r(array_change_key_case($keyUppercase,CASE_UPPER));
echo "=7<br/>";

//split array into chunks of two 8
$splitArray = array("apple", "banana", "orange","pineple");
print_r(array_chunk($splitArray,2));
echo "=8<br/>";

//key of current position 9
$keyPosition= array("apple", "banana", "orange");
echo key($keyPosition);
echo "=9<br/>";

//combine two array 10

$firstName=array("Peter","Ben","Joe");
$age=array("35","37","43");

$combineArray=array_combine($firstName,$age);

echo $firstName[1];
echo "=10<br/>";

// count values of array 11

$countValue = array("apple", "banana", "orange");
print_r(array_count_values($countValue));
echo "=11<br/>";

// diff ele in both array 12

$firstArray=array("a"=>"red","b"=>"green");
$secondArray=array("a"=>"red","b"=>"green","c"=>"blue");

$diffrenceArray=array_diff_assoc($firstArray,$secondArray);
print_r($diffrenceArray);
echo "=12<br/>";

//fill the array 13
$fillArray=array_fill(3,4,"blue");
print_r($fillArray);
echo "=13<br/>";
 
// fill array with values,specified keys 14
$keyArray=array("a","b","c","d");
$fillArray=array_fill_keys($keyArray,"blue");
print_r($fillArray);
echo "=14<br/>";

//filter values using call back function 15
function test_odd($var)
  {
  return($var & 1);
  }

$filter=array(1,3,2,3,4);
print_r(array_filter($filter,"test_odd"));
echo "=15<br/>";

// flip values to key 16
$flipArray=array("a"=>"red","b"=>"green");
$resultArray=array_flip($flipArray);
print_r($resultArray);
echo "=16<br/>";

//intersect array 17->16
$firstArray=array("a"=>"red","b"=>"green","c"=>"blue","d"=>"yellow");
$secondArray=array("e"=>"red","f"=>"green","g"=>"blue");

$intersectArray=array_intersect($firstArray,$secondArray);
print_r($intersectArray);
echo "=17<br/>";

//multi each value  byit self and return new value
function multiply($v)
{
  return($v*$v);
}

$multiArray=array(1,2,3,4,5);
print_r(array_map("multiply",$multiArray));
echo "=18<br/>";

//merge two array into one array

$mergeFirstArray=array("red","green");
$mergeSecondArray=array("blue","yellow");
print_r(array_merge($mergeFirstArray,$mergeSecondArray));
echo "=19<br/>";

// not override th array key and create new array of value
$firstArray=array("a"=>"red","b"=>"green");
$secondArray=array("c"=>"blue","b"=>"yellow");
print_r(array_merge_recursive($firstArray,$secondArray));
echo "=20<br/>";

//retrun sorted array in asc order
$sortArray=array("Dog","Cat","Horse");
array_multisort($sortArray);
print_r($sortArray);
echo "=21<br/>";

//return 2 ele and add "nikul" new element
$padArray=array("red","green");
print_r(array_pad($padArray,3,"nikul"));
echo "=22<br/>";

//delete las ele of array
$popArray=array("red","green");
array_pop($popArray);
print_r($popArray);
echo "=23<br/>";

//send value in array to udf and return string
function reduce($v1,$v2)
{
return $v1 . "-" . $v2;
}
$reduceArray=array("Dog","Cat","Horse");
print_r(array_reduce($reduceArray,"reduce"));
echo "=24<br/>";

//replace values from first array to second array
$replaceFirstArray=array("red","green");
$replaceSecondArray=array("blue","yellow");
print_r(array_replace($replaceFirstArray,$replaceSecondArray));
echo "=25<br/>";

//serach array value key
$searchArray=array("a"=>"red");
echo array_search("red",$searchArray);
echo "=26<br/>";

//remove first ele of array and return it
$removeFirstArray=array("a"=>"red","b"=>"green");
echo array_shift($removeFirstArray);
print_r ($removeFirstArray);
echo "=27<br/>";

//remove from the first you type the ele of array and return rest of it
$removeArray=array("red","green","blue");
print_r(array_slice($removeArray,1));
echo "=28<br/>";

//remove ele from array and replce it with ne one (rr=remove and replace)
$rrFirstArray=array("red","green");
$rrSecondArray=array("blue","yellow");
array_splice($rrFirstArray,0,2,$rrSecondArray);
print_r($rrFirstArray);
echo "=29<br/>";

//comapre two array and return diff
function cmp($a,$b)
{
if ($a===$b)
  {
  return 0;
  }
  return ($a>$b)?1:-1;
}

$a1=array("a"=>"red","b"=>"green","c"=>"blue");
$a2=array("a"=>"blue","b"=>"green","e"=>"blue");

$resultCompare=array_udiff($a1,$a2,"cmp");
print_r($resultCompare);
echo "=30<br/>";

//compare key and values and return the diff
$resultUdiffAssoc=array_udiff_assoc($a1,$a2,"cmp");
print_r($resultUdiffAssoc);
echo "=31<br/>";

//compare two array and return the matches

$resultUintersect=array_uintersect($a1,$a2,"cmp");
print_r($resultUintersect);
echo "=32<br/>";

//compare key and values and return the diff
$resultUintersectAssoc=array_uintersect_assoc($a1,$a2,"cmp");
print_r($resultUintersectAssoc);
echo "=33<br/>";

//insert ele to array

$insertArray=array("car","bike");
array_unshift($insertArray,"truck");
print_r($insertArray);
echo "=34<br/>";

//return all values from array not key

$allvalueArray=array("1"=>"car");
array_values($allvalueArray);
print_r($allvalueArray);
echo "=35<br/>";

//run each ele of array
function awalk($value,$key)
{
echo "The key $key has the value $value<br>";
}
$walkArray=array("a"=>"red","b"=>"green","c"=>"blue");
array_walk($walkArray,"awalk");
echo "=36<br/>";

//Sort an associative array in descending order, according to the value

$sortArray=array("Peter"=>"35","Ben"=>"37","Joe"=>"43");
arsort($sortArray);
asort($sortArray);

//create array from var and using values
$name="nikul";
$age="21";
 $result=compact("name","age");
 print_r($result);
 echo "=37<br/>";


//found ele in array
$name=array("nikul","parth");

if(in_array("nikul",$name)){
  echo "match found";

}else{
  echo "match not found";
}
echo "=38<br/>";

//assign var of thr array element
$listArray = array("Dog","Cat","Horse");

list($a, $b, $c) = $listArray;
echo "i have $a , $b , $c";
echo "=39<br/>";

//sort array using natcasesort() and natsort 
$tempFiles = array("temp15.txt","Temp10.txt",
"temp1.txt","Temp22.txt","temp2.txt");

natsort($tempFiles);
echo "Natural order: ";
print_r($tempFiles);
echo "<br />";

natcasesort($tempFiles);
echo "Natural order case insensitve: ";
print_r($tempFiles);
echo "=40<br/>";

// create range of ele
$rangeArray= range(0,5);
print_r ($rangeArray);
echo "=41<br/>";

//randomly shuffle the array
$shuffleArray = array("red","green","blue","yellow","purple");

shuffle($shuffleArray);
print_r($shuffleArray);
echo "=42<br/>";

//return numbers ele in array
echo sizeof($shuffleArray);
echo "=43<br/>";

// pointer to the current,next and reset wilpoint to the first element
$peopleArray = array("Peter", "Joe", "Glenn", "Cleveland");

echo current($peopleArray) . "=44<br>"; //current point to currenet element
echo next($peopleArray) . "=45<br>";   // next point to next element
echo reset($peopleArray)."=46<br>";   //reset will reset to the first element of array



//sorting
$sortingArray= array("Peter" => "35", "Ben" => "37", "Joe" => "43");
asort($sortingArray);
print_r($sortingArray); //sort by value in asc order
echo "=47<br>";

arsort($sortingArray);
print_r($sortingArray); //sort by value in dec order
echo "=47<br>";

sort($sortingArray);
print_r($sortingArray); //sort array by asc order
echo "=48<br>";

rsort($sortingArray);
print_r($sortingArray); // sort array by dec order
echo "=49<br>";