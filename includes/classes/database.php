<?php
class Database
{
    private static $_mysqlUser = 'root';
    
    private static $_mysqlPass = '';
    
    private static $_mysqlDb = 'smithside2';
    
    private static $_hostName = 'localhost';
    
    private static $_connection = NULL;
    
    private function __construct(){
    }   
    
    public static function getConnection() {
            if (!self::$_connection) {
                self::$_connection = @new mysqli(self::$_hostName, self::$_mysqlUser, self::$_mysqlPass, self::$_mysqlDb);
                if (self::$_connection->connect_error){
                    die('Connect Error: ' .self::$_connection->connect_error);
                }
            }
            return self::$_connection;
        }
        public static function prep($value) {
            if (MAGIC_QUOTES_ACTIVE) {
                // If magic quotes is active, remove the slashes
                $value = stripslashes($value);
            }
            // Escape speceial characters to avoid SQL injections
            $value = self::$_connection->real_escape_string($value);
            return $value;
         }
    }
?>