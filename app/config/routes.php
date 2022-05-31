<?php

    return [
        '' => [
            'controller' => 'IndexController',
            'method' => 'IndexAction',
            'path' => './pages/main.php'
        ],

        'login' => [
            'controller' => 'UserController',
            'method' => 'UserLogin',
            'path' => './pages/user-login.php'
        ],

        'registration' => [
            'controller' => 'UserController',
            'method' => 'UserRegister',
            'path' => './pages/user-reg.php'
        ]
        // 'news/aritcle-create' => [
        //     'controller' => 'NewsController',
        //     'method' => 'CreateArticle'
        // ]
    ];