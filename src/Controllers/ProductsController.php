<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Products;

class ProductsController extends Controller
{
    private $model;
    public function __construct(?Products $model = null)
    {
        $this->model = $model ?: new Products();
    }

    public function index()
    {
        $products = $this->model->findAll();
        $this->view('products/index', ['products' => $products]);
    }
    public function show($id)
    {
    }
    public function create()
    {
        $this->view('products/create');
    }
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
                'price' => floatval($_POST['price'] ?? 0),
                'description' => $_POST['description'] ?? ''
            ];

            $id = $this->model->create($data);

            if ($id) {
                $this->redirect('/products');
            }
        }
    }
    public function edit($id = null)
    {
        if (!$id) {
            $this->redirect('/products');
            return;
        }

        $product = $this->model->findById($id);
        if (!$product) {
            $this->redirect('/products');
            return;
        }

        $this->view('products/edit', ['product' => $product]);
    }
    public function update($id = null)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get ID from parameter or query string
            $id = $id ?: ($_GET['id'] ?? null);

            if (!$id) {
                $this->redirect('/products');
                return;
            }

            $data = [
                'id' => $id,
                'name' => $_POST['name'] ?? '',
                'price' => floatval($_POST['price'] ?? 0),
                'description' => $_POST['description'] ?? ''
            ];
            $success = $this->model->update($data);
            if ($success) {
                $this->redirect('/products');
            }
        }
    }
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['_method']) && $_POST['_method'] === 'DELETE') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                $success = $this->model->delete($id);
                if ($success) {
                    $this->redirect('/products');
                }
            }
        }
    }

}