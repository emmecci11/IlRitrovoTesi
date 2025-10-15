<?php

namespace Utility;

require_once(__DIR__ . '/../../config.php');

/**
 * class to access to the $_SESSION superglobal array, you Must use this class instead of using directly the array
 */
class USessions {
    private static $istance=null;
    /**
     * Costructor
     */
    private function __construct() {
        
    }

    /**
     * Use this for having session istance
     */
    public static function getIstance() {
        if(self::$istance==null) {
            self::$istance=new USessions();
        }
        return self::$istance;
    }

    /**
     * Set a value in $_SESSION
     * 
     * @param $key
     * @param $value
     */
    function setValue($key, $value) {
        $_SESSION[$key]=$value;
    }

    /**
     * Delete a value in $_SESSION
     * 
     * @param $key
     */
    function deleteValue($key) {
        unset($_SESSION[$key]);
    }

    /**
     * Read a value in $_SESSION. If value is in $_SESSION true, false otherwhise
     * 
     * @param $key
     * @return false|mixed
     */
    function readValue($key) {
        if(isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    /**
     * Return true if a value's key is setted, false otherwhise
     */
    function isValueSet($key) {
        if(isset($_SESSION[$key])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Use this to start a session
     */
    function startSession() {
        session_start();
    }

    /**
     * Use this to stop a session
     */
    public function stopSession() {
        session_unset();
        session_destroy();
    }

    /**
     * Use this to verify if PHPSESSID cookie is comed
     * 
     * @return bool (true if cookie is comed, false otherwhise)
     */
    function isSessionSet(): bool {
        if(isset($_COOKIE['PHPSESSID'])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Use this to check session's status. If session's status NONE get true, false otherwhise
     */
    function isSessionNone(): bool {
        if(session_status()==PHP_SESSION_NONE) {
            return true;
        } else {
            return false;
        }
    }
}