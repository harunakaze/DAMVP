<?php
// This *probably* should not be a singleton, but well one things leads to another...
class DB
{
        protected static $instance = null;

        protected function __construct() {}
        protected function __clone() {}

        public static function instance()
        {
            if (self::$instance === null)
            {
                $opt  = array(
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => FALSE,
                );

                try {
                    $dsn = 'pgsql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME;
                    self::$instance = new PDO($dsn, DB_USER, DB_PASS, $opt);
                    self::$instance->query("SET search_path TO ".DB_SCHEMA);
                } catch(PDOException $ex) {
                    die(json_encode(array('db_isconnected' => false, 'message' => 'Unable to connect : ' . $ex)));
                }
            }

            return self::$instance;
        }

        public static function __callStatic($method, $args)
        {
            return call_user_func_array(array(self::instance(), $method), $args);
        }

        
        public static function run($sql, $args = [])
        {
            if (!$args)
            {
                return self::instance()->query($sql);
            }
            $stmt = self::instance()->prepare($sql);
            $stmt->execute($args);
            return $stmt;
        }
    }
?>