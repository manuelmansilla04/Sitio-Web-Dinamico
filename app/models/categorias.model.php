<?php 

require_once './app/models/model.php';

class CategoriasModel extends Model{
    
    function __construct() {
        parent::__construct();
    }

    function getCategoria ($id){
        
        $query = $this->db->prepare('SELECT * FROM categoria WHERE id_categoria=?');
        
        $query->execute([$id]);
        $categoria = $query->fetch(PDO::FETCH_OBJ);
        
        return $categoria;

    }

    function getAllCategorias (){
        $query = $this->db->prepare('SELECT * FROM categoria');
        $query->execute();
        $categorias = $query->fetchAll(PDO::FETCH_OBJ);

        return $categorias;
    }

    function insertCategoria ($nombre, $descripcion){
        $query = $this->db->prepare('INSERT INTO `categoria` (`nombre`, `descripcion`)
                VALUES (?,?)');
        $query->execute([$nombre, $descripcion]);
    }

    function updateCategoria ($id,$nombre, $descripcion){
        $query = $this->db->prepare('UPDATE `categoria` SET nombre = ?, descripcion = ? WHERE id_categoria = ?');
        $query->execute([$nombre, $descripcion, $id]);
    }


    function deleteCategoria ($id){
        $query = $this->db->prepare('DELETE FROM `categoria` WHERE id_categoria=?');
        $query->execute([$id]);
    }

    function getCategoriaByName ($name){
        $query = $this->db->prepare('SELECT * FROM categoria WHERE nombre LIKE ?');
        $query->execute(['%'.$name.'%']);
        $categoria = $query->fetch(PDO::FETCH_OBJ);
        
        return $categoria;
    }

}