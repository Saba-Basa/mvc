<?php

namespace App\Tests;

use App\Core\Model;
use App\Core\Database;
use PHPUnit\Framework\TestCase;
use PDO;

class ModelTest extends TestCase
{
    public function testConnectionReturnsPdo()
    {
        $model = new Model();
        $this->assertInstanceOf(PDO::class, $model->getConnection());
    }
    public function testConnectionSame()
    {
        $mConnection = (new Model())->getConnection();
        $dbConnection = Database::getInstance();
        $this->assertSame($mConnection, $dbConnection);
    }

    public function testInjection()
    {
        $m = (new Model())->getConnection();
        $m->exec("CREATE TEMPORARY TABLE test (id INT, name VARCHAR(255))");
        $m->exec("INSERT INTO test (id, name) VALUES (1, 'user1'), (2, 'user2')");
        $rows = $m->query("SELECT * FROM test ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);
        // assert(count($rows) === 2, "should be two");
        $this->assertCount(2, $rows);
        $this->assertEquals(['id' => 1, 'name' => 'user1'], $rows[0]);
        $this->assertEquals(['id' => 2, 'name' => 'user2'], $rows[1]);
        $inject = "1 or 1=1";
        $statement = $m->prepare("SELECT * FROM test WHERE id = ?");
        $statement->execute([$inject]);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $this->assertLessThanOrEqual(1, count($result));
    }
}