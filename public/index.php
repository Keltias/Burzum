<? 
    session_start();
    require "../app/config/settings.php";
    require "../vendor/autoload.php";
    use App\Core\Router;

    $url = key($_GET);

    $router = new Router(); 

    $router->addRoute("/", "main.php");
    $router->addRoute("/public/user-login", "user-login.php");
    $router->addRoute("/public/user-register", "user-reg.php");
    $router->addRoute("/public/user", "user-profile.php");
    $router->addRoute("/public/article-create", "article-create.php");
    $router->addRoute("/public/article-delete", "article-delete.php");
    $router->addRoute("/public/article-page", "article-page.php");

    $router->route("/".$url);