<?php
return [
  'GET' => [
    '/products'           => ['ProductsController','index'],
    '/products/create'    => ['ProductsController','create'],
    '/products/{id}'      => ['ProductsController','show'],
    '/products/{id}/edit' => ['ProductsController','edit'],
  ],
  'POST' => [
    '/products'            => ['ProductsController','store'],
    '/products/{id}'       => ['ProductsController','update'],
    '/products/{id}/delete'=> ['ProductsController','destroy'],
  ],
];