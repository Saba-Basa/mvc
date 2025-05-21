<?php

namespace App\Tests;

use App\Core\Controller;
use PHPUnit\Framework\TestCase;

class ControllerTest extends TestCase
{
    public function testView()
    {
        $controller = new class extends Controller {};
        $reflection = new \ReflectionClass($controller);
        $method = $reflection->getMethod("view");
        $method->setAccessible(true);
        $template = "products/index";
        $data = [
            'products' => [
                [
                'id' => 1,
                'name' => 'Banana',
                'price' => 19.99,
                'description' => 'Brown'
                ],
            ]
        ];
        ob_start();
        $method->invokeArgs($controller, [$template, $data]);
        $output = ob_get_clean();
        $this->assertStringContainsString('Banana', $output);
        $this->assertStringContainsString(19.99, $output);
        $this->assertStringContainsString('Brown', $output);
        // $this->assertStringContainsString('products/index', $output);
    }
}