<? 
    session_start();
    require "../app/config/settings.php";
    require "../vendor/autoload.php";
    use App\Core\Router;
    use App\Controllers\UserController;

    $uri = $_SERVER['REQUEST_URI'];

    $url = key($_GET);

    $router = new Router(); 

    $router->addRoute("/", "main.php");
    $router->addRoute("/public/login", "user-login.php");
    $router->addRoute("/public/registration", "user-reg.php");
    $router->addRoute("/public/profile", "user-profile.php");
    $router->addRoute("/public/article-create", "article-create.php");
    $router->addRoute("/public/article-delete", "article-delete.php");
    $router->addRoute("/public/article-page", "article-page.php");

    if($uri == '/registration' && isset($_POST['button']))
    {   
        $data = [
            'username' => trim(htmlspecialchars($_POST['username'])),
            'email' => trim(htmlspecialchars($_POST['email'])),
            'password' => trim(htmlspecialchars($_POST['password'])),
            'password_confirm'  => trim(htmlspecialchars($_POST['password_confirm']))
        ];
        $user_reg = new UserController($data);
        $user_reg->UserRegister();
    }
    elseif($uri == '/login' && isset($_POST['button']))
    {
        $data = [
            'username' => trim(htmlspecialchars($_POST['username'])),
            'password' => trim(htmlspecialchars($_POST['password']))
        ];

        $user_login = new UserController($data);
        $user_login->UserLogin();
    }
    
    $router->route("/".$url);