<?php
require_once './app/controllers/home.controller.php';
require_once './app/controllers/productos.controller.php';
require_once './app/controllers/categorias.controller.php';
require_once './app/controllers/auth.controller.php';
require_once './app/middlewares/guard.middleware.php';
require_once './app/middlewares/session.middleware.php';
session_start();
define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');

if (!empty($_GET['action'])){
    $action = $_GET['action'];
} else {
    $action = 'home';
}

$params = explode('/', $action);

$request = new StdClass();
$request = (new SessionMiddleware())->run($request);


switch ($params[0]) {
//manejo de pagina principal
    case 'home':
        $controller = new HomeController();
        $controller->showHome($request);
        break;
    case 'about':
    $controller = new HomeController();
    $controller->about($request);
        break;
//Listado de categorias y productos
    case 'list_categorias':
        $controller = new CategoriasController();
        if (isset($params[1])){
            $idCategoria = $params[1];
            $controller->showCategoriaByID($idCategoria,$request);
        }else{
            $controller->showCategorias($request);
        }
        break;
    case 'productos':
        $controller = new ProductosController();
        if (isset($params[1])){
            $id = $params[1];
            $controller->showProductoByID($id,$request);
        }
        else{
            $controller->showProductos($request);
        }
        break;
/* ABM categorias */
    case 'panel_admin':
        $request = (new GuardMiddleware())->run($request);
        $controller = new HomeController();
        $controller->ABM($request);
        break;
    case 'addCategoria':
        $request = (new GuardMiddleware())->run($request);
        $controller = new CategoriasController();
        $controller->addCategoria($request);
        break;
    case 'editCategoria':
        $request = (new GuardMiddleware())->run($request);
        $controller = new CategoriasController();
        if (isset($params[1])){
            $categoriaId = $params[1];
        }
        $controller->editCategoria($categoriaId,$request);
        break;
    case 'deleteCategoria':
        $request = (new GuardMiddleware())->run($request);
        $controller = new CategoriasController();
        if (isset($params[1])){
            $categoriaId = $params[1];
        }
        $controller->deleteCategoria($categoriaId,$request);
        break;
/* ABM productos */
    case 'administrarProductos':
        $request = (new GuardMiddleware())->run($request);
        $controller = new ProductosController();
        $controller->showMenuABM($request);
        break;    
    case 'addProducto':
        $request = (new GuardMiddleware())->run($request);
        $controller = new ProductosController();
        $controller->addProducto($request);
        break;
    case 'deleteProducto':
        $request = (new GuardMiddleware())->run($request);
        $controller = new ProductosController();
        $request->id = $params[1];
        $controller->deleteProducto($request);
        break;
    case 'editProducto':
        $request = (new GuardMiddleware())->run($request);
        $controller = new ProductosController();
        if (isset($params[1])){
            $request->id = $params[1];
        }
        $controller->editProducto($request);
        break;
/* Manejo de sesion */
    case 'login':
        $controller = new AuthController();
        $controller->showLogin($request);
        break;
    case 'do_login':
        $controller = new AuthController();
        $controller->doLogin($request);
        break;
    case 'logout':
        $request = (new GuardMiddleware())->run($request);
        $controller = new AuthController();
        $controller->logout($request);
        break;
    default:
        echo 'error 404 page not found';
        break;
}

?>
