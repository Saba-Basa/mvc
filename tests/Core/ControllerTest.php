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


    public function testRedirect()
    {
        $controller = new class extends Controller {
            protected function redirect(string $url): void
            {
                $GLOBALS['header_value'] = "Location: {$url}";
                $GLOBALS['exit_called'] = true;
            }
        };
        $reflection = new \ReflectionClass($controller);
        $method = $reflection->getMethod('redirect');
        $method->setAccessible(true);
        $GLOBALS['header_value'] = null;
        $GLOBALS['exit_called'] = false;
        $url = "/products/list";
        $method->invoke($controller, $url);
        $this->assertEquals("Location: {$url}", $GLOBALS['header_value'], 'Header was not set correctly');
        $this->assertTrue($GLOBALS['exit_called'], 'Exit was not called');
    }

    // public function testTerminate()
    // {
    //     $controller = new class extends Controller {
    //         protected function terminate(): void
    //         {
    //             $GLOBALS['exit_called'] = true;
    //         }
    //     };

    //     $reflection = new \ReflectionClass($controller);
    //     $terminateMethod = $reflection->getMethod('terminate');
    //     $terminateMethod->setAccessible(true);
    //     $GLOBALS['exit_called'] = false;
    //     $terminateMethod->invoke($controller);
    //     $this->assertTrue($GLOBALS['exit_called'], 'Exit was not called');
    // }



}