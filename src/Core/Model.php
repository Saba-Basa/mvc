<?php
namespace App\Core;
use PDO;
use App\Core\Database;

class Model
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

    public function getConnection(): PDO
    {
        return $this->pdo;
    }
}