<?php
require_once './app/models/categorias.model.php';
require_once './app/views/categorias.view.phtml';
require_once './app/models/productos.model.php';

class CategoriasController{
    private $model;
    private $view;
    private $productosModel;

    public function __construct(){
        $this->model = new CategoriasModel();
        $this->view = new CategoriasView();
        $this->productosModel = new ModelProductos();
    }

    public function showCategorias($request){
        $categorias = $this->model->getAllCategorias();
        $this->view->showCategorias($categorias,"", $request->user);
    }

    public function showCategoriaByID($idCategoria,$request){
        $categoria = $this->model->getCategoria($idCategoria);
        if (!empty($categoria)){
            $producto = $this->productosModel->getProductos($idCategoria);
            $this->view->showCategoriaByID($categoria,$producto,"", $request->user);
        } else {
            $this->view->showError('Error: no existe la categoria', $request->user);
        }
    }

    function addCategoria($request){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            //uso empty en lugar de isset porque este ultimo acepta espacios en blanco
            if (!empty($_POST['nombre']) &&
            !empty($_POST['descripcion'])){
                //todos los campos tienen datos
                $nombre = $_POST['nombre'];
                $descripcion = $_POST['descripcion'];
                
                $this->model->insertCategoria($nombre, $descripcion);
                $this->view->showMsg('Categoria agregada con exito', $request->user);

            }else{
                $this->view->showError('Error: faltan campos obligatorios', $request->user);
            }
        }
        $this->view->showFormCategorias("", $request->user);
    }

    function editCategoria($categoriaId, $request){
        $categoria = $this->model->getCategoria($categoriaId);
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){

            if (!empty($_POST['nombre']) &&
            !empty($_POST['descripcion'])){
                //todos los campos tienen datos
                $nombre = $_POST['nombre'];
                $descripcion = $_POST['descripcion'];
                
                $this->model->updateCategoria($categoriaId, $nombre, $descripcion);
                $this->view->showMsg('Categoria actualizada con exito', $request->user);

            }else{
                $this->view->showError('Error: faltan campos obligatorios', $request->user);
            }
        }
        if (!empty($categoria)){
            $this->view->showFormEdit($categoria, $request->user);
        }else{
            $this->view->showError('Error: no existe la categoria', $request->user);            
        }
    }

    function deleteCategoria($categoriaId, $request){
        $categoria = $this->model->getCategoria($categoriaId);
        $productos = $this->productosModel->getProductos($categoriaId);
        if (!empty($categoria)){
            if (empty($productos)){
                $this->model->deleteCategoria($categoriaId);
                $this->view->showMsg('Categoria eliminada con exito', $request->user);
            } else {
                $this->view->showError('Error: hay productos asociados', $request->user);        
            }
        } else {
                $this->view->showError('Error: no existe la categoria', $request->user);     
        }
    }

}
