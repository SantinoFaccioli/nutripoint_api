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

    }