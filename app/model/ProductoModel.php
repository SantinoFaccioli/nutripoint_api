<?php
    class ProductoModel{
        private $db;

        function __construct() {
        
        $this->db = new PDO('mysql:host=localhost;dbname=nutripoint_bd;charset=utf8', 'root', '');
        
        }

        public function listarTodos(){
            $query = $this->db->prepare('SELECT * FROM productos WHERE en_oferta = 1');
            $query->execute();
            $productos = $query->fetchAll(PDO::FETCH_OBJ);

            return $productos;
        }
        
        public function getProductoById($id){
            $query = $this->db->prepare('SELECT * FROM productos WHERE id_producto = ? AND en_oferta = 1');
            $query ->execute([$id]);
            $producto = $query->fetch(PDO::FETCH_OBJ);

            return $producto;
        }

        public function addProducto($data){
            $enOferta = $data->en_oferta ?? 1;

            $query = $this->db->prepare( 'INSERT INTO productos 
            (id_categoria, nombre, precio, stock, descripcion, en_oferta, imagen_producto) 
            VALUES (?, ?, ?, ?, ?, ?, ?)');

            $query->execute([
                $data->id_categoria, 
                $data->nombre, 
                $data->precio, 
                $data->stock, 
                $data->descripcion,
                $enOferta, 
                $data->imagen_producto ?? null
            ]);

            $idProductoAgregado = $this->db->lastInsertId();

            return $this->getProductoById($idProductoAgregado);
        }

        public function getProductoByCategoria($idCategoria){

            $query= $this->db-> prepare('SELECT * FROM productos WHERE en_oferta = 1 AND id_categoria = ?');
            $query->execute([$idCategoria]);
            $productos = $query->fetchAll(PDO::FETCH_OBJ);
            
            return $productos;
        }
    }