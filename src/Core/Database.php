<?php
namespace App\Core;

use PDO;
use PDOException;

class Database
{

    private static $instance = null;
    private function __construct()
    {
    }


    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            $root = dirname(__DIR__, 2);
            $configFile = $root . '/config/database.php';
            $example = $root . '/config/database.example.php';

            $config = file_exists($configFile)
                ? require $configFile
                : require $example;

            $dsn = sprintf(
                'mysql:host=%s;dbname=%s;charset=%s',
                $config['host'],
                $config['dbname'],
                $config['charset']
            );

            try {
                $pdo = new PDO($dsn, $config['username'], $config['password']);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance = $pdo;
            } catch (PDOException $e) {
                die('DB Connection failed: ' . $e->getMessage());
            }
        }

        return self::$instance;
    }

    /** no clonen */
    public function __clone()
    {
    }

    /** no serialization */
    public function __wakeup()
    {
    }
}
