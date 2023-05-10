<?php

function findPoint($strArr)
{
    // primero separo ambos arreglos
    $array1 =  explode(",",$strArr[0]);
    $array2 =  explode(",",$strArr[1]);
    $coma = "";
    $resultado ="";

    // recorro cada elemento array1
    foreach ($array1 as $key => $value) {
    // busco si existe el elemento $value en array2
      if(in_array($value, $array2)) 
      {
        $resultado .= $coma.$value; 
        $coma = ",";
      } 
    }

    //devuelve el resultado concatenado o false
    return ($resultado?$resultado:'false');
}

// keep this function call here
echo findPoint(['1, 3, 4, 7, 13', '1, 2, 4, 13, 15']);
echo '<br>';
echo findPoint(['1, 3, 9, 10, 17, 18', '1, 4, 9, 10']);

