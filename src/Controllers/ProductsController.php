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
    }
    public function store()
    {
    }
    public function edit($id)
    {
    }
    public function update($id)
    {
    }
    public function destroy($id)
    {
    }

}