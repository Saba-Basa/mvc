<?php

use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../src/Models/Products.php';

class ProductTest extends TestCase {
    private static $model;
    public static function setUpBeforeClass(): void {
        $config = require __DIR__ . '/../config/database.php';
        $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s',
            $config['host'],
            $config['dbname'],
            $config['charset']
        );
        
        $pdo = new PDO($dsn, $config['username'], $config['password']);
        $pdo->exec('
            CREATE TABLE IF NOT EXISTS products (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                price DECIMAL(10,2) NOT NULL,
                description TEXT
            )
        ');

        self::$model = new Products();
        $pdo->exec('TRUNCATE TABLE products');
    }
    
    public function testCreate()
    {
        $data = [
            'name' => 'Banana',
            'price' => 19.99,
            'description' => 'Brown'
        ];
        
        $id = self::$model->create($data);
        $this->assertIsInt($id);
        $this->assertGreaterThan(0, $id);
        $this->assertSame(19.99, $data['price']);
        $this->assertSame('Brown', $data['description']);
        $this->assertSame('Banana', $data['name']);
    }
}