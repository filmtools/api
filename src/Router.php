<?php
namespace FilmTools\HttpApi;

use Slim\App;

class Router
{
    public function __construct( App $app )
    {
        $app->post('/developing', 'NDeviation.Developing.Controller');
    }
}
