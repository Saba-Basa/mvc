<?php
require_once __DIR__ . "/../../src/Model.php";

class Products extends Model
{
    public function create(array $data): int
    {
        $t = $this
            ->pdo
            ->prepare('INSERT INTO products (name, price, description)
                        VALUES (?,?,?)');
        $t->execute([$data['name'], $data['price'], $data['description']]);
        return (int) $this->pdo->lastInsertId();
    }
}