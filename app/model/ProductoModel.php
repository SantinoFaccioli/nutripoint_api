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

        public function getProductosOrdenados($sort, $order) {
           
            $columnasPermitidas = ['id_producto', 'nombre', 'precio', 'stock', 'id_categoria'];

            $sql = "SELECT * FROM productos";

            if (isset($sort) && in_array(strtolower($sort), $columnasPermitidas)) {
                
                $sql .= " ORDER BY " . $sort;

                if (isset($order) && strtoupper($order) == 'DESC') {
                    $sql .= " DESC";
                } else {
                    $sql .= " ASC";
                }
            }
           
            $query = $this->db->prepare($sql);
            $query->execute();
            
            return $query->fetchAll(PDO::FETCH_OBJ);
        }
        public function updateProductoModel($id, $data) {
            
            $sql = "UPDATE productos SET 
                        nombre = ?, 
                        precio = ?, 
                        stock = ?, 
                        descripcion = ?, 
                        id_categoria = ?,
                        en_oferta = ?,
                        imagen_producto = ?
                    WHERE id_producto = ?";

            $query = $this->db->prepare($sql);

            $query->execute([
                $data->nombre,
                $data->precio,
                $data->stock,
                $data->descripcion,
                $data->id_categoria,
                $data->en_oferta ?? 0, 
                $data->imagen_producto ?? null, 
                $id
            ]);
        }
    }