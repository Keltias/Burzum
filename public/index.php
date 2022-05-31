<? 
session_start();

require "../app/config/settings.php";
require "../vendor/autoload.php";
$routes = require "../app/config/routes.php";

use App\Core\Router;

$router = new Router($routes);
$router->runRoute();