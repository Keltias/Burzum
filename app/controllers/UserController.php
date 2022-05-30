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

    public $session;

    public function UserRegister()
    {
        $this->redirect_page = '/registration';
        $this->server_response = 'error';

        $email_pattern = '/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{1,}$/';
        $username_pattern = '/^[a-z0-9-_]{5,13}$/i';
        $password_pattern = '/^[a-z0-9-_$&!@#]{6,}+$/i';

        $user_check = new User();
        $user_check->UserCheck($this->data);

        $this->email = $user_check->dbHandler->array['email'];
        $this->username = $user_check->dbHandler->array['username'];

        if($this->email == $this->data['email'])
        {
            $this->server_message = 'Данная почта уже используется';
            $error = new SessionController;
            $error->SessionError($this->server_response,$this->server_message, $this->redirect_page);
            return;

        }
        elseif($this->username == $this->data['username'])
        {
            $this->server_message = 'Данный логин уже используется';
            $this->session = new SessionController;
            $this->session->SessionError($this->server_response, $this->server_message, $this->redirect_page);
            return;
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

                $register_user = new User();
                $register_user->CreateUser($this->data);

                $user_redirect = new RedirectController($this->redirect_page);
            }
        }
    }
    public function UserLogin()
    {
        $user_check = new User();
        $user_check->UserCheck($this->data);
        
        $this->username = $user_check->dbHandler->array['username'];
        $this->email = $user_check->dbHandler->array['email'];
        $this->password = $user_check->dbHandler->array['password'];

        if($this->data['username'] == $this->username && password_verify($this->data['password'], $this->password))
        {
            
            $this->data = [
                'username' => $this->data['username'],
                'email' => $this->email
            ];

            $this->server_response = 'user';
            $this->redirect_page = '/profile';

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