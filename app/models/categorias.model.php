<?php 

require_once './app/models/model.php';

class CategoriasModel extends Model {
    
    function __construct() {
        parent::__construct();
    }

    function getCategoria ($id) {
        $query = $this->db->prepare('SELECT * FROM categorias WHERE id_categoria=?');
        $query->execute([$id]);
        $categoria = $query->fetch(PDO::FETCH_OBJ);
        return $categoria;
    }

    function getAllCategorias () {
        $query = $this->db->prepare('SELECT * FROM categorias');
        $query->execute();
        $categorias = $query->fetchAll(PDO::FETCH_OBJ);
        return $categorias;
    }
    
    function insertCategoria ($title, $synopsis, $img) {
        $query = $this->db->prepare('INSERT INTO `categorias` (`nombre`, `descripcion`, `img`) VALUES (?,?,?)');
        $query->execute([$title, $synopsis, $img]);
    }

    function updateCategoria ($id, $title, $synopsis, $img) {
        $query = $this->db->prepare('UPDATE `categorias` SET nombre = ?, descripcion = ?, img = ? WHERE id_categoria = ?');
        $query->execute([$title, $synopsis, $img, $id]);
    }

    function deleteCategoria ($id) {
        $query = $this->db->prepare('DELETE FROM `categorias` WHERE id_categoria=?');
        $query->execute([$id]);
    }

    function getCategoriaByName ($name) {
        $query = $this->db->prepare('SELECT * FROM categorias WHERE nombre LIKE ?');
        $query->execute(['%'.$name.'%']);
        $categoria = $query->fetch(PDO::FETCH_OBJ);
        return $categoria;
    }

}