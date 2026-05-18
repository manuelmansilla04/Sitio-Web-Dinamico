<?php
require_once './app/models/model.php';

class ModelProductos extends Model {
        
    function __construct() {
        parent::__construct();
    }

    public function getProductos($idCategoria) {
        $query = $this->db->prepare('SELECT * FROM productos WHERE id_categoria = ?');
        $query->execute([$idCategoria]);
        $productos = $query->fetchAll(PDO::FETCH_OBJ);
        return $productos;
    }

    function getAllProductos() {
        $query = $this->db->prepare('SELECT * FROM productos');
        $query->execute();
        $productos = $query->fetchAll(PDO::FETCH_OBJ);
        return $productos;
    }

    public function getProducto($id) {
        $query = $this->db->prepare('SELECT * FROM productos WHERE id_producto = ?');
        $query->execute([$id]);
        $producto = $query->fetch(PDO::FETCH_OBJ);
        return $producto;
    }
    
    public function insertProducto($noun,$descripcion,$prices,$amount,$regDate,$idCategoria) {
        $query = $this->db->prepare('SELECT * FROM productos WHERE id_categoria = ? AND stock = ?');
        $query->execute([$idCategoria,$amount]);
        $control = $query->fetch(PDO::FETCH_OBJ);
        if (empty($control)) {
            $query = $this->db->prepare('INSERT INTO productos(nombre, descripcion, precio, stock, fecha_alta, id_categoria) VALUES(?,?,?,?,?,?)');
            $query->execute([$noun,$descripcion,$prices,$amount,$regDate,$idCategoria]);
            return $this->db->lastInsertId();
        }
    }

    public function deleteProducto($id) {
        $query = $this->db->prepare('DELETE FROM productos WHERE id_producto = ?');
        $query->execute([$id]);
    }

    public function updateProducto($id_producto,$noun,$descripcion,$prices,$amount,$regDate,$idCategoria){
        $query = $this->db->prepare('UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, stock = ?, fecha_alta = ?, id_categoria = ? WHERE id_producto = ?');
        $query->execute([$noun,$descripcion,$prices,$amount,$regDate,$idCategoria,$id_producto]);
    }

    }
?>