<?php
namespace App\Controllers;
use App\Controllers\RedirectController;

class SessionController
{
    public $session;

    public function SessionError($session, $message, $page)
    {   
        $this->session = $session;
        $_SESSION[$this->session] = $message;
        $redirect = new RedirectController;
        $redirect->userRedirect($page);
    }

    public function CreateUserSession($session, $data, $page)
    {
        $this->session = $session;
        $_SESSION[$this->session] = [
            'username' => $data['username'],
            'email' => $data['email']
        ];
        $redirect = new RedirectController;
        $redirect->userRedirect($page);
    }
    public function CheckSession($session, $page)
    {
        $this->session = $_SESSION[$session];
        if(!isset($this->session))
        {
            $redirect = new RedirectController;
            $redirect->userRedirect($page);
        }
    }
    public function UnsetSession($session, $page)
    {
        $this->session = $_SESSION[$session];
        unset($this->session);
        $redirect = new RedirectController;
        $redirect->userRedirect($page);
    }
}