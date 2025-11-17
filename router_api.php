<?php
    require_once './libs/router.php';

    require_once './app/controller/ProductosController.php';


    $router = new Router();

    $router->addRoute('productos' , 'GET' , 'ProductosController' , 'listarOfertas'); // ya se no necesito indicaciones como una nena :/

    $router->addRoute('productos/todos', 'GET', 'ProductosController', 'getListadoOrdenado');
    
    $router->addRoute('productos/:id', 'PUT', 'ProductosController', 'updateProducto');

    $router->addRoute('productos/:id' , 'GET' , 'ProductosController' , 'listarProductoID'); // obtener un producto a partir de su id 

    $router->addRoute('productos' , 'POST' , 'ProductosController' , 'crearProducto'); // agrega un producto en oferta

    $router->addRoute('productos/categoria/:id_categoria', 'GET' , 'ProductosController' , 'listarProductoCategoria');//filtro por categoria


    $router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);