
<?php 
//php -S localhost:3000
require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminController;
use Controllers\APIController;
use Controllers\CitaController;
use Controllers\LoginController;
use Controllers\ServicioController;
use Controllers\PageController;
use Controllers\CartController;
use Controllers\AdministradorController;
use Controllers\ProductoController;
use Controllers\ColaboradoresController;
use Controllers\CategoriaController;
use Controllers\MarcaController;
use Controllers\ContactoController;
use Controllers\NosotrosController;
use Controllers\PagoFinalizado;
use MVC\Router;
$router = new Router();

///Iniciar pagina
$router->get('/', [PageController::class, 'inicio']);
$router->get('/cart', [CartController::class, 'cart']);
$router->post('/eliminarCarrito', [CartController::class, 'eliminarCarrito']);
$router->post('/actualizarCarrito', [CartController::class, 'actualizarCarrito']);
$router->get('/checkout', [CartController::class, 'checkout']);
$router->post('/crearVenta', [CartController::class, 'guardar']);
$router->get('/resumen', [CartController::class, 'resumen']);
$router->get('/contacto', [ContactoController::class, 'contacto']);
$router->get('/nosotros', [NosotrosController::class, 'nosotros']);
$router->get('/pagoFin', [PagoFinalizado::class, 'pagoFin']);

//Seccion Administrator
$router->get('/admin', [AdministradorController::class, 'home']);
$router->post('/report', [AdministradorController::class, 'report']);

$router->post('/getInfo', [AdministradorController::class, 'getInfo']);
$router->post('/updateEstado', [AdministradorController::class, 'updateEstado']);

$router->get('/viewProducto', [ProductoController::class, 'viewProducto']);
$router->get('/editProducto', [ProductoController::class, 'editProducto']);
$router->post('/editarProducto', [ProductoController::class, 'addEditarProducto']);
$router->post('/addProducto', [ProductoController::class, 'addEditarProducto']);
$router->get('/viewColaborador', [ColaboradoresController::class, 'ViewColaboradores']);
$router->post('/addEditarColaborador', [ColaboradoresController::class, 'addEditarColaborador']);
$router->get('/viewCategorias', [CategoriaController::class, 'viewCategoria']);
$router->post('/addEditarCategoria', [CategoriaController::class, 'addEditarCategoria']);
$router->get('/viewMarcas', [MarcaController::class, 'viewMarca']);
$router->post('/addEditarMarca', [MarcaController::class, 'addEditarMarca']);

//$router->post('/addColaborador', [ColaboradoresController::class, 'addColaborador']);
$router->post('/getInfoUser', [ColaboradoresController::class, 'getInfoUser']);
$router->get('/cuenta', [ColaboradoresController::class, 'cuenta']);
$router->post('/cuenta', [ColaboradoresController::class, 'cuenta']);

$router->post('/crear-cuenta', [LoginController::class, 'crear']);
$router->post('/crear-usuario', [LoginController::class, 'crearUser']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);

$router->get('/login', [AdministradorController::class, 'login']);
$router->post('/login', [AdministradorController::class, 'login']);
$router->get('/logout', [AdministradorController::class, 'logout']);

$router->get('/api/servicios', [APIController::class, 'index']);



// Iniciar Sesión
/*$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

// Recuperar Password
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);
$router->get('/recuperar', [LoginController::class, 'recuperar']);
$router->post('/recuperar', [LoginController::class, 'recuperar']);

// Crear Cuenta
$router->get('/crear-cuenta', [LoginController::class, 'crear']);
$router->post('/crear-cuenta', [LoginController::class, 'crear']);

// Confirmar cuenta
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);

// AREA PRIVADA
$router->get('/cita', [CitaController::class, 'index']);
$router->get('/admin', [AdminController::class, 'index']);

// API de Citas
$router->get('/api/servicios', [APIController::class, 'index']);
$router->post('/api/citas', [APIController::class, 'guardar']);
$router->post('/api/eliminar', [APIController::class, 'eliminar']);

// CRUD de Servicios
$router->get('/servicios', [ServicioController::class, 'index']);
$router->get('/servicios/crear', [ServicioController::class, 'crear']);
$router->post('/servicios/crear', [ServicioController::class, 'crear']);
$router->get('/servicios/actualizar', [ServicioController::class, 'actualizar']);
$router->post('/servicios/actualizar', [ServicioController::class, 'actualizar']);
$router->post('/servicios/eliminar', [ServicioController::class, 'eliminar']);
*/
// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();