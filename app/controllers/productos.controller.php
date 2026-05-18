<?php
    require_once './app/models/productos.model.php';
    require_once './app/views/productos.view.phtml';
    require_once './app/models/categorias.model.php';
    
    class ProductosController {
     
        public function __construct() {
            $this->Model = new ModelProductos();
            $this->View = new ProductosView();
            $this->modelCategoria = new CategoriasModel();
        }
        
        public function showProductos($request){
            $productos = $this->Model->getAllProductos();
            $categorias = $this->modelCategoria->getAllCategorias();
            $this->View->showAllProductos($productos,$categorias,"", $request->user);
        }

        public function showProductoByID($id, $request){
            $producto = $this->Model->getProducto($id);
            if (empty($producto)) {
                return $this->View->showError("No hay producto",$request->user);
            }
            $idCategoria = $producto->id_categoria;
            $categoria = $this->modelCategoria->getCategoria($idCategoria);
            $producto->categoria = $categoria;
            $this->View->showProductoByID($producto,"", $request->user);
        }

        public function showMenuABM($request){
            $productos = $this->Model->getAllProductos();
            $categorias = $this->modelCategoria->getAllCategorias();
            $this->View->showProductosABM($productos,$categorias,"", $request->user);
        }

        public function addProducto($request){
            if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
                return $this->View->showError('falta completar el nombre del producto',$request->user);
            }
            if (!isset($_POST['descripcion']) || empty($_POST['descripcion'])) {
                return $this->View->showError('falta completar la descripción del producto',$request->user);
            }
            if (!isset($_POST['precio']) || empty($_POST['precio'])) {
                return $this->View->showError('falta completar el precio del producto',$request->user);
            }
            if (!isset($_POST['stock']) || empty($_POST['stock'])) {
                return $this->View->showError('falta completar el stock del producto',$request->user);
            }
            if (!isset($_POST['fecha_alta']) || empty($_POST['fecha_alta'])) {
                return $this->View->showError('falta completar la fecha de alta del producto',$request->user);
            }
            if (!isset($_POST['idCategoria']) || empty($_POST['idCategoria'])) {
                return $this->View->showError('falta completar el nombre de la categoría',$request->user);
            }
            $noun = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $prices = $_POST['precio'];
            $amount = $_POST['stock'];
            $regDate = $_POST['fecha_alta'];
            $idCategoria = $_POST['idCategoria'];
            $categoria = $this->modelCategoria->getCategoria($idCategoria);

            if (empty($categoria)){
                return $this->View->showError('Error: no existe la categoría', $request->user);
            }
            $add = $this->Model->insertProducto($noun,$descripcion,$prices,$amount,$regDate,$idCategoria);
            if (!$add) {
                return $this->View->showError('Error al insertar tarea', $request->user);
            }
            header('Location: ' . BASE_URL);
        }   
        
        public function deleteProducto($request) {
            $id_product = $request->id;
            $product = $this->Model->getProducto($id_product);
            if (!$product) {
                return $this->View->showError('Error no existe ese producto', $request->user);
            }
            $this->Model->deleteProducto($id_product);
            header('Location: ' . BASE_URL);
        }

        public function editProducto($request) {
            $id_product = $request->id;
            $product = $this->Model->getProducto($id_product);
            $categorias = $this->modelCategoria->getAllCategorias();
            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                if (!empty($_POST['nombre']) && !empty($_POST['descripcion']) && !empty($_POST['precio']) && !empty($_POST['stock']) && !empty($_POST['fecha_alta']) && !empty($_POST['nombreCategoria'])) {
                    $noun = $_POST['nombre'];
                    $descripcion = $_POST['descripcion'];
                    $prices = $_POST['precio'];
                    $stocking = $_POST['stock'];
                    $regDate = $_POST['fecha_alta'];
                    $id_categoria = $_POST['nombreCategoria'];
                    $this->Model->updateProducto($id_product,$noun,$descripcion,$prices,$stocking,$regDate,$id_categoria);
                    header('Location: ' . BASE_URL);
                } else {
                    $this->View->showError('Error: faltan campos obligatorios', $request->user);
                }
            }
            if (!empty($categorias)) {
                $this->View->showFormEdit($product,$categorias,"",$request->user);
            } else {
                $this->View->showError('Error: no existe la categoría', $request->user);
            }
        }
    }
?>