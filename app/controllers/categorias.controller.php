<?php
require_once './app/models/categorias.model.php';
require_once './app/views/categorias.view.phtml';
require_once './app/models/productos.model.php';

class CategoriasController {
    private $model;
    private $view;
    private $productosModel;

    public function __construct() {
        $this->model = new CategoriasModel();
        $this->view = new CategoriasView();
        $this->productosModel = new ModelProductos();
    }

    public function showCategorias($request) {
        $categorias = $this->model->getAllCategorias();
        $this->view->showCategorias($categorias,"", $request->user);

    }

    public function showCategoriaByID($idCategoria, $request) {
        $categoria = $this->model->getCategoria($idCategoria);
        if (!empty($categoria)) {
            $producto = $this->productosModel->getProductos($idCategoria);
            $this->view->showCategoriaByID($categoria,$producto,"", $request->user);
        } else {
            $this->view->showError('Error: no existe la categoría', $request->user);
        }
    }

    function addCategoria($request){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //empty acepta espacios al contrario de isset!
            if (!empty($_POST['title']) && !empty($_POST['synopsis']) && !empty($_POST['img'])) {
                $title = $_POST['title'];
                $synopsis = $_POST['synopsis'];
                $img = $_POST['img'];
                $this->model->insertCategoria($title, $synopsis, $img);
                header('Location: ' . BASE_URL);
            } else {
                $this->view->showError('Error: faltan campos obligatorios', $request->user);
            }
        }
        $this->view->showFormCategorias("", $request->user);
    }

    function editCategoria($categoriaId, $request){
        $categoria = $this->model->getCategoria($categoriaId);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['title']) && !empty($_POST['synopsis']) && !empty($_POST['img'])){
                $title = $_POST['title'];
                $synopsis = $_POST['synopsis'];
                $img = $_POST['img'];
                $this->model->updateCategoria($categoriaId, $title, $synopsis, $img);
                header('Location: ' . BASE_URL);
            } else {
                $this->view->showError('Error: faltan campos obligatorios', $request->user);
            }
        }
        if (!empty($categoria)) {
            $this->view->showFormEdit($categoria, $request->user);
        } else {
            $this->view->showError('Error: no existe la categoría', $request->user);            
        }
    }

    function deleteCategoria($categoriaId, $request) {
        $categoria = $this->model->getCategoria($categoriaId);
        $productos = $this->productosModel->getProductos($categoriaId);
        if (!empty($categoria)) {
            if (empty($productos)){
                $this->model->deleteCategoria($categoriaId);
                //$this->view->showMsg('Categoria eliminada con éxito', $request->user);
                header('Location: ' . BASE_URL);
            } else {
                $this->view->showError('Error: hay productos en esta categoría. Retirelos antes de eliminar la presente categoría.', $request->user);        
            }
        } else {
                $this->view->showError('Error: no existe la categoría', $request->user);     
        }
        
    }

}
