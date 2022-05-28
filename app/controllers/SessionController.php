<?php
namespace App\Controllers;
use App\Controllers\RedirectController;

class SessionController
{
    public $session;
    
    public function SessionError($message, $page)
    {   
        $_SESSION['error'] = $message;
        $this->session = $_SESSION['error'];
        $redirect = new RedirectController;
        $redirect->userRedirect($page);
    }

    public function CreateUserSession($data, $page)
    {
        $_SESSION['user'] = [
            'username' => $data['username'],
            'email' => $data['email']
        ];
        $redirect = new RedirectController;
        $redirect->userRedirect($page);
    }

    public function CreateAdminSession($data, $page)
    {
        $_SESSION['admin'] = [
            'username' => $data['username'],
            'email' => $data['email']
        ];
        $redirect = new RedirectController;
        $redirect->userRedirect($page);
    }

    public function CheckUserSession($page)
    {
        $this->session = $_SESSION['user'];

        if(!isset($this->userSession))
        {
            $redirect = new RedirectController;
            $redirect->userRedirect($page);
        }
    }
    public function CheckAdminSession($page)
    {
        $this->session = $_SESSION['admin'];

        if(!isset($this->adminSession))
        {
            $redirect = new RedirectController;
            $redirect->userRedirect($page);
        }
    }
    public function UnsetSession($session, $page)
    {
        unset($session);
        $redirect = new RedirectController;
        $redirect->userRedirect($page);
    }
}