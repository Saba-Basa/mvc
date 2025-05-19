<?php
class Model
{
    protected $pdo;

    public function __construct()
    {
        $config = file_exists(__DIR__ . '/../config/database.php')
            ? require __DIR__ . '/../config/database.php'
            : require __DIR__ . '/../config/database.example.php';

        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;charset=%s',
            $config['host'],
            $config['dbname'],
            $config['charset']
        );
        $this->pdo = new PDO($dsn, $config['username'], $config['password']);
    }

    public function getConnection(): PDO
    {
        return $this->pdo;
    }
}