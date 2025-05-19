<?php

use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../src/Model.php';

class ModelTest extends TestCase{
    public function testConnectionReturnsPdo()
    {
        $model = new Model();
        $this->assertInstanceOf(PDO::class, $model->getConnection());
    }
} 