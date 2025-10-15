<?php
namespace Utility;
/**
 * Class to access to SUPERGLOBAL arrays for the HTTP request like $_POST, $_FILES, You must use this class to access theese arrays (in this class are implemented only $_POST and $_FILES) 
 */
class UHTTPMethods{

    /**
     * can access to $_POST superglobal
     */
    public static function post($param){
        return $_POST[$param];
    }
}