<?php

use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../src/Models/Products.php';

class ProductTest extends TestCase
{
    private static $model;
    private static $pdo;
    public static function setUpBeforeClass(): void
    {
        $config = require __DIR__ . '/../config/database.php';
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

        self::$model = new Products();
    }

    protected function tearDown(): void
    {
        self::$pdo->exec('TRUNCATE TABLE products');
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

    public function testFindById()
    {
        $data = [
            'name' => 'Banana',
            'price' => 19.99,
            'description' => 'Brown'
        ];
        $id = self::$model->create($data);
        // echo "Created product with ID: $id\n";

        $product = self::$model->findById($id);
        // echo "Found product: ";
        // print_r($product);
        $this->assertEquals($data['name'], $product['name'], 'name should be equal');
        // echo "compared names: ";
        // print_r(['original' => $data['name'], 'found' => $product['name']]);
        $this->assertEquals($data['price'], $product['price']);
        $this->assertEquals($data['description'], $product['description']);
    }

    public function testfindAll()
    {
        $data = [
            [
                'name' => 'Banana',
                'price' => 19.99,
                'description' => 'Brown'
            ],
            [
                'name' => 'Apple',
                'price' => 14.99,
                'description' => 'Red'
            ]
        ]
        ;
        foreach ($data as $item) {
            self::$model->create($item);
        }
        $products = self::$model->findAll();
        // print_r($products);
        $this->assertCount(2, $products);
    }

    public function testDelete()
    {
        $data = [
            [
                'name' => 'Banana',
                'price' => 19.99,
                'description' => 'Brown'
            ],
            [
                'name' => 'Apple',
                'price' => 14.99,
                'description' => 'Red'
            ]
        ]
        ;
        foreach ($data as $item) {
            self::$model->create($item);
        }
        $this->assertCount(2, $data);
        $products = self::$model->findAll();
        $bananaID = $products[0]['id'];
        self::$model->delete($bananaID);
        $this->assertCount(1, self::$model->findAll());
        $appleID = self::$model->findAll()[0]['id'];
        self::$model->delete($appleID);
        $this->assertNull(self::$model->findAll());
    }

    public function testupdate()
    {
        $data = [
            [
                'name' => 'Banana',
                'price' => 19.99,
                'description' => 'Brown'
            ],
            [
                'name' => 'Apple',
                'price' => 14.99,
                'description' => 'Red'
            ]
        ]
        ;
        foreach ($data as $item) {
            self::$model->create($item);
        }
        $appleID = self::$model->findAll()[1]['id'];
        // print_r($appleID);
        $this->assertCount(2, $data);
        $updatedApple = [
            'id' => $appleID,
            'name' => 'Apple',
            'price' => 12.99,
            'description' => 'Orange'
        ];
        self::$model->update($updatedApple);
        // print_r(self::$model->findAll());
        $this->assertSame('Orange', self::$model->findAll()[1]['description']);
    }
}