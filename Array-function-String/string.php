<?php
  // convert to hexadecimal
  $str = bin2hex("Hello World!");
  echo($str)."=1<br>";

  //string length
  $stringLength="Nikul Gohil";
  echo (strlen($str))."=2<br>";
  
  //add slashes to the specified font
  $stringAddslash='nikul "G"ohil';
  echo (addslashes($stringAddslash))."=3<br>";

 //remove word from right side of string
 $StringChop = "Nikul gohil";
 echo chop($StringChop,"gohil")."=4<br>";

 //ascii to chr
 echo chr(52)."=5<br>";

 //after each split it will add .
 $stringSplit = "Nikul Gohil";
 echo chunk_split($stringSplit,2,'.')."=6<br>";

 //Decode a uuencoded string
 $strDecode= ",2&5L;&\@=V]R;&0A `";
 echo convert_uudecode($strDecode),"=7<br>";

 //encode a uudecoded str
 $strEncode= "Hello World";
 echo convert_uuencode($strEncode),"=8<br>";

 //count total char in string
 $strCountChar="Nikul Gohil";
 echo count_chars($strCountChar,3)."=9<br>";

 //check crc-32 bit for string
 $strCrc =crc32("Nikul Gohil")."=10<br>";
 print_r($strCrc);

 //string to array and array to string
 
$strExplode = "Hello world. It's a beautiful day.";
print_r (explode(" ",$strExplode));
echo "=11<br>";

$implodeArray=array("nikul","gohil");
echo implode(" ",$implodeArray);
echo "=12<br>";

//print transalation table used by htmlspecialchr
print_r (get_html_translation_table()); 
echo "=13<br>";

//rev a hebrew char
echo hebrev("á çùåï äúùñâ");
echo "=14<br>";

//convrt hexadecimal to ascii
echo hex2bin("48656c6c6f20576f726c6421");
echo "=15<br>";

//convert html entity to chr
$strEntityDecode= '&lt;a href=&quot;https://www.w3schools.com&quot;&gt;w3schools.com&lt;/a&gt;';
echo html_entity_decode($strEntityDecode);
echo "=16<br>";

//convert chr to html entity
$strEntityEncode= '<a href="https://www.w3schools.com">Go to w3schools.com</a>';
echo htmlentities($strEntityEncode);
echo "=17<br>";

//html predefined entity to chr
$strHtmlEntity = "This is some &lt;b&gt;bold&lt;/b&gt; text.";
echo htmlspecialchars_decode($strHtmlEntity);
echo "=18<br>";

//encode html entity
$strEncodeEntity = "This is some <b>bold</b> text.";
echo htmlspecialchars($strEncodeEntity);
echo "=19<br>";

//convert array to string and faster than implode
$joinArray=array("nikul","gohil","ravi");
echo join("",$joinArray);
echo "=20<br>";

//levenshtein distance between two string
echo levenshtein("Nikul","Gohil",20,20,20);
echo "=21<br>";

//for USA locale numeric formatting infromation
setlocale(LC_ALL,"US");
$locale_info = localeconv();
print_r($locale_info);
echo "=22<br>";

//remove space from left side
$strTrim = " Nikul Gohil ";
echo ltrim($strtrim,"Nikul");
echo rtrim($strTrim,"Gohil");
echo "=23<br>";

 //convert string into md5 hash same for md5_file to convert file
 $strMd5="Nikul";
 echo md5($strMd5)."=24<br>";

 //convert into metaphone of your string
 $strMetaphone = "Nikul";
 echo metaphone($strMetaphone)."=25<br>";

 //start with new line when \n occurs in string
 echo nl2br("nikul \nGohil");
 echo "=26<br>";

 //format number into redable format
 $number= 200000000;
 echo number_format($number) ."=27<br>";

 //retun ascii value of first chr of string
 $strOrd="Nikul";
 echo ord($strOrd)."=28<br>";

// print and printf=formatted string

$number = 9;
$strPrintf= "Beijing";
printf("There are %u million bicycles in %s.",$number,$strPrintf);
echo "=29<br>";

//decode quoted printable string
$strDecodePrintable = "Hello=0Aworld.";
echo quoted_printable_decode($strDecodePrintable);
echo "=30<br>";

// add baclslash infront of predefined chr
$strQuotemeta= "Hello world. (can you hear me?)";
echo quotemeta($strQuotemeta);
echo "=31<br>";

//convert string into sha1 nad sha1_file for file

$strSha1 = "nikul";
echo sha1($strSha1);
echo "=32<br>";

//compare two string and return match chr
echo similar_text("hello nikul","hello ravi")."=33<br>";

// clac soundex key of string
$strSoundx = "Nikul Gohil";
echo soundex($strSoundx);
echo "=34<br>";

//parse string
$strSscanf = "age:30";
sscanf($strSscanf,"age:%d",$age);
// show types and values
var_dump($age);
echo "=35<br>";

//check if the string spesific substring
$strContains ="Nikul Gohil";
echo str_contains($strContains,"Nikul");
echo "=36<br>";

// check end with specific word
$strEnd="Nikul Gohil";
echo str_ends_with($strEnd,"Gohil");
echo "=37<br>";

//replace the word with onther in string (case insentive)
echo str_ireplace("Nikul","Ravi","Nikul Gohil");
echo "=38<br>";

//pad to the right side of string
$strPad = "Nikul Gohil";
echo str_pad($strPad,15,'.');
echo "=39<br>";

//repeat the word *times
echo str_repeat("Nikul",5);
echo "=40<br>";

//replace the word in string which you specified the word
echo str_replace("Morning","evening","Good Morning");
echo "=41<br>";

//str_rot13 will encode and decode the string

echo str_rot13("hello world");
echo "=42<br>";

//randomly shufflr all the chr in string

echo str_shuffle("Nikul Gohil");
echo "=43<br>";

//split the string into array

print_r (str_split("Nikul"));
echo "=44<br>";

//start with specific sub string

$strsStartWith="Nikul Gohil";
echo str_starts_with($strsStartWith,"Nikul");
echo "=45<br>";


$strWordCount = "Nikul Gohil and i'm 21 year old.";
echo str_word_count($strWordCount)."=46<br>"; // count the word
echo strcasecmp("hello","HELLO")."=47<br>"; // compare two string return 0 if =

//find the Nikul in "Nikul gohil" and found thrn return Nikul

echo strcasecmp("Nikul","NIKUL")."=48<br>";
echo strchr("Nikul Gohil","Nikul")."=49<br>"; // find the string word in occurance
echo strcmp("Nikul","Nikul")."=50<br>"; //case sensitive

//find the numbe of chr found in str before G

$strCspn = "nikul Gohil";
echo strcspn("Nikul Gohil","G")."=51<br>";

//striped html tags

echo strip_tags("Nikul gohil <b> age is 21</b>")."=52<br>";

//remove back slashes from string
echo stripslashes("Nikul \Gohil")."=53<br>";
echo stripslashes("Nikul\ Gohil")."=54<br>";

echo stripos("Nikul Gohil","gohil")."=55<br>"; // find the first occurence of string

echo stristr("Nikul Gohil","Nikul")."=56<br>"; // find the Nikul word in string AND RETURN IT

echo strpbrk("Nikul Gohil","i")."=57<br>"; // break from the given and return it

echo strrpos("nikul gohil","l")."=58<br>"; // last accurenec of string return rest of it

echo strspn("Nikul Gohil","ul")."=59<br>"; // it will retrun the conntaining thw wrd and return

echo strstr("Nikul Gohil","Gohil")."=60<br>"; // it will find the first occurence of the word in string

echo strtr("Nikul Gohil","kul","mul")."=61<br>"; // replace the string with new one

echo substr("Goihl Nikul",6)."=62<br>"; // return the sub string

echo substr_compare("Nikul GOHIL","Nikul GOHIL",0)."=63<br>"; // compare sub string

echo substr_count("Nikul Gohil Gohil","Gohil")."=64<br>"; // return how many times substring occurence

// remove chr from both side
$strTrim = "Nikul Gohil";
echo trim($strTrim,"Nl")."=65<br>";

// write into new when reach specific length
$str = "An example of a long word is: Supercalifragulistic";
echo wordwrap($str,15,"<br>\n");
echo "=66<br>";


echo chr("71");
echo ord("G");







