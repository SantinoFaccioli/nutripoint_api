<?php
    require_once './libs/router.php';

    require_once './app/controller/ProductosController.php';


    $router = new Router();

    $router->addRoute('productos' , 'GET' , 'ProductosController' , 'listarOfertas'); // aca deberias hacer el listar todos xd


    $router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);