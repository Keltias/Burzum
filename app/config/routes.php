<?php

return [
    '' => [
        'controller' => 'NewsController',
        'method' => 'NewsShow',
        'path' => './pages/main.php'
    ],
    '(profile-id=)*[0-9]*$' => [
        'controller' => 'UserController',
        'method' => 'UserProfile',
        'path' => './pages/user-profile.php'
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
    ],
    'logout' => [
        'controller' => 'UserController',
        'method' => 'UserLogout',
        'path' => ''
    ],
    '^(article-)*[a-zA-Z]*$' => [
        'controller' => 'NewsController',
        'method' => 'ShowArticle',
        'path' => './pages/article-page.php'
    ],
    'news-create' => [
        'controller' => 'NewsController',
        'method' => 'CreateArticle',
        'path' => './pages/article-create.php'
    ],
    'news-edit' => [
        'controller' => 'NewsController',
        'method' => 'ArticleEdit',
        'path' => './pages/article-edit.php'
    ],
    '(delete-)*[0-9]*' => [
        'controller' => 'NewsController',
        'method' => 'DeleteArticle',
        'path' => ''
    ]
];
