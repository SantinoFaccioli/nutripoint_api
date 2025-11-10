<?php

require_once 'app/model/ProductoModel.php';

class ProductosController {

    private $model;

    public function __construct(){
    
        $this->model = new ProductoModel;
        
    }

   public function listarOfertas($req, $res) {
 
    $productos = $this->model->listarTodos();

     // Responder con la colección de productos y el código 200 OK
    return $res->json($productos, 200); 
 }





}