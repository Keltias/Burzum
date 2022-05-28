<?php
namespace App\Controllers;

use App\Models\User;
use App\Controllers\SessionController;

class UserController
{
    public $data;
    public $redirect_page;

    public function userRegister()
    { 
        $email_pattern = '/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{1,}$/';
        $username_pattern = '/^[a-z0-9-_]{5,13}$/i';
        $password_pattern = '/^[a-z0-9-_$&!@#]{6,}+$/i';

        $this->redirect_page = '/user-register';

        if(isset($_POST['button'])) 
        {
            $this->data = [
                'username' => trim(htmlspecialchars($_POST['username'])),
                'email' => trim(htmlspecialchars($_POST['email'])),
                'password' => trim(htmlspecialchars($_POST['password'])),
                'password_confirm'  => trim(htmlspecialchars($_POST['password_confirm']))
            ];
            if(empty($this->data['email']))
            {
                $error = new SessionController;
                $error->SessionError('Пожалуйста, укажите почту', $this->redirect_page);
            }
            elseif(empty($this->data['username']))
            {
                $error = new SessionController;
                $error->SessionError('Пожалуйста, придумайте логин', $this->redirect_page);
            }
            elseif(empty($this->data['password']))
            {
                $error = new SessionController;
                $error->SessionError('Пожалуйста, придумайте пароль', $this->redirect_page);
            }
            elseif(empty($this->data['password_confirm']))
            {
                $error = new SessionController;
                $error->SessionError('Пожалуйста, подтвердите пароль', $this->redirect_page);
            }
            else
            {
                if(!preg_match($email_pattern, $this->data['email']))
                {
                    $error = new SessionController;
                    $error->SessionError('Пожалуйста, введите существующую почту', $this->redirect_page);
                }
                elseif(!preg_match($username_pattern, $this->data['username']))
                {
                    $error = new SessionController;
                    $error->SessionError('Пожалуйста, придумайте адекватный логин', $this->redirect_page);
                }
                elseif(!preg_match($password_pattern, $this->data['password']))
                {
                    $error = new SessionController;
                    $error->SessionError('Пожалуйста, придумайте хороший пароль', $this->redirect_page);
                }
                elseif($this->data['password'] !== $this->data['password_confirm'])
                {
                    $error = new SessionController;
                    $error->SessionError('Ваши пароли не совпадают', $this->redirect_page);
                }
                else
                {
                    $this->data['password'] = password_hash($this->data['password'], PASSWORD_BCRYPT, ['cost' => 12]);
                    $new_user = new User();
                    $new_user->userRegister($this->data);
                }
            }
        }
    }
}