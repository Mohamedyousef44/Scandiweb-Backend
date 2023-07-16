<?php

namespace Core;
use InvalidArgumentException;

class Validator{

    public static function validateString($str, $attr = 'Input', $exception=false){
        $isStr = is_string($str);
        if (!$isStr && $exception) {
            throw new InvalidArgumentException($attr.' must be a string');
        }
        
        return $isStr;
    }
     public static function validateFloat($num, $attr = 'Input' , $exception=false){
    
        $floatVal = is_numeric($num) && filter_var($num, FILTER_VALIDATE_FLOAT);
        if (!$floatVal && $exception) {
            throw new InvalidArgumentException($attr.' must be a number');
        }
        
        return $floatVal;
    }

}



?>