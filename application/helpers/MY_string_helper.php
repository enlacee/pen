<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Limpia el caracter q esta al final de la cadena
 * @param type $str string 1,2,3,,,,
 * @param type $caracter a eliminar al ultimo
 */
if (!function_exists('clear_string_final'))
{
    function clear_string_final($str, $caracter)
    {
        do {
            $part = substr($str, strlen($str)-1);
            if ($part == $caracter) {
                $str = substr($str, 0, strlen($str)-1);	
            }
        } while ($part == $caracter);
        return $str;
    }
}

