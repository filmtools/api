<?php
namespace FilmTools\HttpApi;

require_once 'vendor/autoload.php';

$app = new \Slim\App;

$dic = $app->getContainer();

$dic->register( new ServiceProvider );
new Router( $app );

$app->run();
