<?php

namespace App\Tests;

use App\Model;
use PHPUnit\Framework\TestCase;
use PDO;

class ModelTest extends TestCase{
    public function testConnectionReturnsPdo()
    {
        $model = new Model();
        $this->assertInstanceOf(PDO::class, $model->getConnection());
    }
} 