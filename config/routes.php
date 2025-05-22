<?php
return [
    '/products'              => 'ProductsController@index',
    '/products/create'       => 'ProductsController@create',
    '/products/show'         => 'ProductsController@show',  
    '/products/edit/{id}' => 'ProductsController@edit',
    '/products/store'        => 'ProductsController@store',
    '/products/update'       => 'ProductsController@update',
    '/products/delete'       => 'ProductsController@delete', 
    '/'                      => 'ProductsController@index'
];