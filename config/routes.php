<?php
return [
    '/products'              => 'ProductsController@index',
    '/products/create'       => 'ProductsController@create',
    '/products/show'         => 'ProductsController@show',  
    '/products/edit'         => 'ProductsController@edit',
    '/products/store'        => 'ProductsController@store',
    '/products/update'       => 'ProductsController@update',
    '/products/delete'       => 'ProductsController@destroy', 
    '/'                      => 'ProductsController@index'
];