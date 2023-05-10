<?php
function noIterate($strArr) {

  // code goes here
  $len1 = strlen($strArr[0]);
  $len2 = strlen($strArr[1]);
  $len3 = $len1 - $len2;
  $arr = str_split($strArr[1]);

  $found_str = $strArr[0];
  for($i=0; $i<=$len3; ++$i) {
    $found = false;
    for($j=$len2; $j<=$len1-$i && $found === false; ++$j) {
      $sub = substr($strArr[0], $i, $j);
      $found = contains($sub, $arr);
      if($found && strlen($sub) < strlen($found_str)) {
        $found_str = $sub;
      }
    }
  }

  return $found_str;

}


function contains($str, $arr) {
  $all = true;
  foreach($arr as $c) {
    $pos = strpos($str, $c);
    if($pos === false) {
      $all = false;
    }
    else {
      $str = substr_replace($str, "", $pos, 1);
    }
  }
  return $all;
}

   
// keep this function call here  

echo noIterate(["ahffaksfajeeubsne", "jefaa"]);
echo '<br>';
echo noIterate(["aaffhkksemckelloe", "fhea"]);

 
?>