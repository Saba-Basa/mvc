<?php
namespace App\Tests\Controllers;

use PHPUnit\Framework\TestCase;
use App\Controllers\ProductsController;
use App\Models\Products;
use PDO;

class ProductsControllerTest extends TestCase
{
    private static PDO $pdo;
    private static ProductsController $controller;

    public static function setUpBeforeClass(): void
    {
        $config = require __DIR__ . '/../../config/database.php';
        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;charset=%s',
            $config['host'],
            $config['dbname'],
            $config['charset']
        );
        self::$pdo = new PDO($dsn, $config['username'], $config['password']);
        self::$pdo->exec('
            CREATE TABLE IF NOT EXISTS products (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                price DECIMAL(10,2) NOT NULL,
                description TEXT
            )
        ');

        $model = new Products();
        self::$controller = new ProductsController($model);
    }

    protected function tearDown(): void
    {
        self::$pdo->exec('TRUNCATE TABLE products');
    }
    
    public function testIndexShowsNoProducts(): void
    {
        ob_start();
        self::$controller->index();
        $output = ob_get_clean();
        $this->assertStringContainsString('No products found', $output);
    }
    public function testIndexShowsProducts(): void
    {
        self::$pdo->exec("
        INSERT INTO products (name, price, description) 
        VALUES ('Apple', 2.50, 'red'),
               ('Orange', 1.99, 'orange')
    ");
        ob_start();
        self::$controller->index();
        $output = ob_get_clean();

        $this->assertStringContainsString('Apple', $output);
        $this->assertStringContainsString('Orange', $output);
        $this->assertStringContainsString('2.50', $output);
        $this->assertStringContainsString('1.99', $output);
        $this->assertStringNotContainsString('No products found', $output);
    }
    
}