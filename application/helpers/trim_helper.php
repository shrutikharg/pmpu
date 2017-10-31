<?php
function trim_array($array_to_trim)
{$trimmed_array=array();
       foreach ($array_to_trim as $key => $value){
          $trimmed_array[$key]=preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $value) ;
       }
       return $trimmed_array;
}

