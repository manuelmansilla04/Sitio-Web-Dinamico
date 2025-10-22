<?php
    require_once './app/models/productos.model.php';
    require_once './app/views/productos.view.phtml';
    require_once './app/models/categorias.model.php';
    
    class ProductosController {
        
        private $Model;
        private $View;
        private $modelCategoria;

        public function __construct(){
            //inicio Modelo y Vista
            $this->Model = new ModelProductos();
            $this->View = new ProductosView();
            $this->modelCategoria = new CategoriasModel();
        }
        
        public function showProductos($request){
            $productos = $this->Model->getAllProductos();
            $categorias = $this->modelCategoria->getAllCategorias();
            $this->View->showAllProductos($productos,$categorias,"", $request->user);
        }

        public function showProductoByID($id,$request){
            $producto = $this->Model->getProducto($id);
            if (empty($producto)){
                return $this->View->showError("No hay producto", $request->user);
            }
            $idCategoria = $producto->id_categoria;
            $categoria = $this->modelCategoria->getCategoria($idCategoria);
            $producto->categoria=$categoria;
            $this->View->showProductoByID($producto,"", $request->user);
        }

        public function showMenuABM($request){
            $productos = $this->Model->getAllProductos();
            $categorias = $this->modelCategoria->getAllCategorias();
            $this->View->showProductosABM($productos,$categorias,"", $request->user);
        }

        public function addProducto($request){
            if (!isset($_POST['idCategoria']) || empty($_POST['idCategoria'])){
                return $this->View->showError('falta completar la categoria',$request->user);
            }
            if (!isset($_POST['nombre']) || empty($_POST['nombre'])){
                return $this->View->showError('falta completar el nombre',$request->user);
            }
            if (!isset($_POST['descripcion']) || empty($_POST['descripcion'])){
                return $this->View->showError('falta completar la descripcion',$request->user);
            }
            if (!isset($_POST['precio']) || empty($_POST['precio'])){
                return $this->View->showError('falta completar el precio',$request->user);
            }
            if (!isset($_POST['stock']) || empty($_POST['stock'])){
                return $this->View->showError('falta completar el stock',$request->user);
            }
            if (!isset($_POST['fecha_alta']) || empty($_POST['fecha_alta'])){
                return $this->View->showError('falta completar la fecha de alta',$request->user);
            }
            $idCategoria = $_POST['idCategoria'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];
            $stock = $_POST['stock'];
            $fecha_alta = $_POST['fecha_alta'];
            $categoria = $this->modelCategoria->getCategoria($idCategoria);

            if (empty($categoria)){
                return $this->View->showError('Error: no existe la categoria', $request->user);
            }
            
            $add = $this->Model->insertProducto($idCategoria,$nombre,$descripcion,$precio,$stock,$fecha_alta);
            
            if(!$add){
                return $this->View->showError('Error la insertar tarea', $request->user);
            }

            header('Location: ' . BASE_URL);
        }   
        
        public function deleteProducto($request){
            $id_producto = $request->id;
            $producto = $this->Model->getProducto($id_producto);
            if (!$producto){
                return $this->View->showError('Error no existe ese producto', $request->user);
            }

            $this->Model->deleteProducto($id_producto);
            header('Location: ' . BASE_URL);
        }

        public function editProducto($request){
            $id_producto = $request->id;
            $producto = $this->Model->getProducto($id_producto);
            $categorias = $this->modelCategoria->getAllCategorias();
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            if (!empty($_POST['idCategoria']) && !empty($_POST['nombre']) && !empty($_POST['descripcion'])
                && !empty($_POST['precio']) && !empty($_POST['stock']) && !empty($_POST['fecha_alta'])) {
                //todos los campos tienen datos
                $idCategoria = $_POST['idCategoria'];
                $nombre = $_POST['nombre'];
                $descripcion = $_POST['descripcion'];
                $precio = $_POST['precio'];
                $stock = $_POST['stock'];
                $fecha_alta = $_POST['fecha_alta'];
                $this->Model->updateProducto($id_producto,$idCategoria,$nombre,$descripcion,$precio,$stock,$fecha_alta);
                header('Location: ' . BASE_URL);

            }else{
                $this->View->showError('Error: faltan campos obligatorios', $request->user);
            }
            }
            if (!empty($categorias)){
            $this->View->showFormEdit($producto,$categorias,"",$request->user);
            } else{
                $this->View->showError('Error: no existe la categoria', $request->user);
            }
           }
    }

?>