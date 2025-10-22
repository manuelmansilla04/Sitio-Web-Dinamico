<?php
    require_once './app/models/model.php';
    class ModelProductos extends Model {
        function __construct(){
            parent::__construct();
        }
    

    public function getProductos($idCategoria){
        $query = $this->db->prepare('SELECT * FROM producto WHERE id_categoria = ?');
        $query->execute([$idCategoria]);
        $productos = $query->fetchAll(PDO::FETCH_OBJ);
        return $productos;
    }

    function getAllProductos (){
        $query = $this->db->prepare('SELECT * FROM producto');
        $query->execute();
        $productos = $query->fetchAll(PDO::FETCH_OBJ);

        return $productos;
    }

    public function getProducto($id){
        $query = $this->db->prepare('SELECT * FROM producto WHERE id_producto = ?');
        $query->execute([$id]);
        $producto = $query->fetch(PDO::FETCH_OBJ);
        return $producto;
    }
    
    public function insertProducto($idCategoria,$fecha_alta,$stock,$precio,$descripcion,$nombre){
        $query = $this->db->prepare('SELECT * FROM producto WHERE id_categoria = ? AND nombre = ?');
        $query->execute([$idCategoria,$nombre]);
        $control = $query->fetch(PDO::FETCH_OBJ);
        if (empty($control)){
        $query = $this->db->prepare('INSERT INTO producto(id_categoria, fehca_alta, stock, precio, descripcion, nombre) VALUES(?,?,?,?,?,?)');
        $query->execute([$idCategoria,$fecha_alta,$stock,$precio,$descripcion,$nombre]);

        return $this->db->lastInsertId();
        }
    }

    public function deleteProducto($id){
        $query = $this->db->prepare('DELETE FROM producto WHERE id_producto = ?');
        $query->execute([$id]);
    }

    public function updateProducto($id_producto,$id_categoria,$fecha_alta,$stock,$precio,$descripcion,$nombre){
        $query = $this->db->prepare('UPDATE producto SET id_categoria = ?,fecha_alta = ?,stock = ?,precio = ?,descripcion = ?,nombre = ? WHERE id_productp = ?');
        $query->execute([$id_producto,$id_categoria,$fecha_alta,$stock,$precio,$descripcion,$nombre]);
    }

    }
?>