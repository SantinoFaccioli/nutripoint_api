<?php

require_once 'app/model/ProductoModel.php';

class ProductosController {

    private $model;

    public function __construct(){
    
        $this->model = new ProductoModel;
        
    }

    public function error404($req, $res){
        $res->json(["error" => "Recurso no encontrado"], 404);
    }

   public function listarOfertas($req, $res) {
 
        $productos = $this->model->listarTodos();

        // Responder con la colección de productos y el código 200 OK
        return $res->json($productos, 200); 
    }

    public function listarProductoID($req ,$res){
        $id = $req->params->id;

        if(empty($id)){
            $res->json(['error' => 'ID de producto inválido'], 400);
            return;
        }else{
            $producto= $this->model->getProductoById($id);
        }

        if(!empty($producto)){
            return $res ->json($producto , 200);
        }else{
            return $res->json("producto en oferta con id=$id no existe", 404);
        }

    }

    public function crearProducto($req,$res){
        $data= $req->body;

        if(empty($data)|| empty($data->id_categoria) ||empty($data->nombre) ||empty($data->precio) ||empty($data->stock) ||empty($data->descripcion)){
            return $res->json(['error' => 'Solicitud mal formada. Faltan campos.'], 400);
        }
    

        try {
            $nuevoProducto = $this->model->addProducto($data);

            if ($nuevoProducto) {
                $res->json([
                    'message' => 'Producto creado con éxito.', 
                    'producto' => $nuevoProducto ], 201);
            }else{
                $res->json(['error' => 'Producto creado pero no pudo ser recuperado.'], 500);
            }

        } catch (Exception $e) {
             $res->json(['error' => 'Error al crear el producto: ' . $e->getMessage()], 500);
        };
    }

    public function listarProductoCategoria($req ,$res){
        $idCategoria = $req->params->id_categoria;

        if ($idCategoria !== null && !is_numeric($idCategoria)) {
            return $res->json(['error' => 'El ID de categoría para el filtro debe ser numérico.'], 400);
        }

        $productos = $this->model->getProductoByCategoria($idCategoria);

        return $res->json($productos, 200);
    }

    public function getListadoOrdenado($req, $res) {
        
        $sort = $req->query->sort ?? null;
        $order = $req->query->order ?? null;

        $productos = $this->model->getProductosOrdenados($sort, $order);

        return $res->json($productos, 200);
    }
    public function updateProducto($req, $res) {
        
        $id = $req->params->id;

        $data = $req->body;

        $productoExistente = $this->model->getProductoById($id);

        if (!$productoExistente) {
            return $res->json("El producto con id=$id no existe.", 404);
        }

        if (empty($data->nombre) || empty($data->precio) || empty($data->stock) || 
            empty($data->descripcion) || empty($data->id_categoria)) {
            
            return $res->json("Faltan datos obligatorios para la modificación.", 400);
        }

        $this->model->updateProductoModel($id, $data);

        return $res->json("Producto con id=$id actualizado con éxito.", 200);
    }

}