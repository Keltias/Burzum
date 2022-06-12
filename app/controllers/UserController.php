<?php
namespace App\Controllers;

use App\Models\User;
use App\Controllers\RedirectController;
use App\Controllers\SessionController;
use App\Core\Controller;

class UserController extends Controller
{
    public $redirect_page;
    public $server_message;
    public $server_response;

    public $password;
    public $email;
    public $username;
    public $public_id;

    public $session;

    public function UserRegister()
    {
        $this->view->RenderHTML('Регистрация','');

        $this->redirect_page = '/registration';
        $this->server_response = 'error';

        $email_pattern = '/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{1,}$/';
        $username_pattern = '/^[a-z0-9-_]{5,13}$/i';
        $password_pattern = '/^[a-z0-9-_$&!@#]{6,}+$/i';

        $this->public_id = rand(1, 50000);

        if(isset($_POST['button'])) {
            $this->data = [
                'username' => trim(htmlspecialchars($_POST['username'])),
                'email' => trim(htmlspecialchars($_POST['email'])),
                'password' => trim(htmlspecialchars($_POST['password'])),
                'password_confirm'  => trim(htmlspecialchars($_POST['password_confirm'])),
                'generated_id' => $this->public_id
            ];
            
            $this->action = new User();
            $this->action->UserCheck($this->data);

            if($this->action->dbHandler->array !== false) {

                $this->email = $this->action->dbHandler->array['email'];
                $this->username = $this->action->dbHandler->array['username'];

                if ($this->email == $this->data['email']) {
                    $this->server_message = 'Данная почта уже используется';
                    $this->session = new SessionController;
                    $this->session->SessionError($this->server_response, $this->server_message, $this->redirect_page);
                    return;

                } elseif ($this->username == $this->data['username']) {
                    $this->server_message = 'Данный логин уже используется';
                    $this->session = new SessionController;
                    $this->session->SessionError($this->server_response, $this->server_message, $this->redirect_page);
                    return;
                }
            }
            if(empty($this->data['email']))
            {
                $this->server_message = 'Пожалуйста, укажите почту';
                $this->session = new SessionController;
                $this->session->SessionError($this->server_response,$this->server_message, $this->redirect_page);

            }
            elseif(empty($this->data['username']))
            {
                $this->server_message = 'Пожалуйста, придумайте логин';
                $this->session = new SessionController;
                $this->session->SessionError($this->server_response,$this->server_message, $this->redirect_page);

            }
            elseif(empty($this->data['password']))
            {
                $this->server_message = 'Пожалуйста, придумайте пароль';
                $this->session = new SessionController;
                $this->session->SessionError($this->server_response,$this->server_message, $this->redirect_page);

            }
            elseif(empty($this->data['password_confirm']))
            {
                $this->server_message = 'Пожалуйста, подтвердите пароль';
                $this->session = new SessionController;
                $this->session->SessionError($this->server_response,$this->server_message, $this->redirect_page);
            }
            else
            {
                if(!preg_match($email_pattern, $this->data['email']))
                {
                    $this->server_message = 'Пожалуйста, укажите существующую почту';
                    $this->session = new SessionController;
                    $this->session->SessionError($this->server_response,$this->server_message, $this->redirect_page);
                }
                elseif(!preg_match($username_pattern, $this->data['username']))
                {
                    $this->server_message = 'Пожалуйста, придумайте соответствующий логин';
                    $this->session = new SessionController;
                    $this->session->SessionError($this->server_response,$this->server_message, $this->redirect_page);
                
                }
                elseif(!preg_match($password_pattern, $this->data['password']))
                {
                    $this->server_message = 'Пожалуйста, придумайте сильный пароль.';
                    $this->session = new SessionController;
                    $this->session->SessionError($this->server_response,$this->server_message, $this->redirect_page);
                
                }
                elseif($this->data['password'] !== $this->data['password_confirm'])
                {
                    $this->server_message= 'Пароли не совпадают';
                    $this->session = new SessionController;
                    $this->session->SessionError($this->server_response,$this->server_message, $this->redirect_page);
                }
                else
                {
                    $this->redirect_page = '/login';
                    $this->data['password'] = password_hash($this->data['password'], PASSWORD_BCRYPT, ['cost' => 12]);  

                    $this->action = new User();
                    $this->action->CreateUser($this->data);

                    $this->action = new RedirectController($this->redirect_page);
                }
            }
        }
    }
    public function UserLogin()
    {  
        $this->view->RenderHTML('Авторизация','');

        if(isset($_POST['button'])) {
            $this->data = [
                'username' => $_POST['username'],
                'password' => $_POST['password']
            ];
            $this->action = new User();
            $this->action->UserCheck($this->data);
        
            $this->username = $this->action->dbHandler->array['username'];
            $this->email = $this->action->dbHandler->array['email'];
            $this->public_id = $this->action->dbHandler->array['public_id'];
            $this->password = $this->action->dbHandler->array['password'];

            if($this->data['username'] == $this->username && password_verify($this->data['password'], $this->password))
            {
                $this->data = [
                    'username' => $this->data['username'],
                    'email' => $this->email
                ];

                $this->server_response = 'user';
                $this->redirect_page = '/profile-id='.$this->public_id;

                $this->session = new SessionController();
                $this->session->CreateSession($this->server_response,$this->data,$this->redirect_page);
            }
            else
            {
                $this->server_message = 'Неверные данные.';
                $this->server_response = 'error';
                $this->redirect_page = '/login';

                $this->session = new SessionController();
                $this->session->SessionError($this->server_response,$this->server_message,$this->redirect_page);
            }
        }
    }
    public function UserLogout()
    {
        $this->redirect_page = '/login';
        if(isset($_SESSION['user']))
        {
            unset($_SESSION['user']);
            $this->action = new RedirectController($this->redirect_page);
            return;
        }
        elseif(isset($_SESSION['admin']))
        {
            unset($_SESSION['admin']);
            $this->action = new RedirectController($this->redirect_page);
            return;
        }
        else
        {
            $this->action = new RedirectController($this->redirect_page);
            return;
        }
    }
    public function UserProfile()
    {
        $this->uri = $_SERVER['REQUEST_URI'];
        $uri_pattern = '~(^profile-id=$)*[0-9]{0,}$~';
        preg_match($uri_pattern, $this->uri, $matches);
        $this->data = $matches;

        $this->action = new User();
        $this->action->GetUser($this->data);

        if ($this->action->dbHandler->array !== false)
        {
            $this->email = $this->action->dbHandler->array['email'];
            $this->username = $this->action->dbHandler->array['username'];
            $this->public_id = $this->action->dbHandler->array['public_id'];
            $this->data = [
                'username' => $this->username,
                'email' => $this->email,
                'id' => $this->public_id,
            ];
            $this->view->RenderHTML('Регистрация',$this->data);
        }
        else {
            echo 'Пользователя не существует';
        }
    }
}