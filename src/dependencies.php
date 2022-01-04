<?php

use Slim\App;
use Illuminate\Database\Capsule\Manager as Capsule;

return function (App $app) {
    $container = $app->getContainer();

    // view renderer
    $container['renderer'] = function ($c) {
        $settings = $c->get('settings')['renderer'];
        return new \Slim\Views\PhpRenderer($settings['template_path']);
    };

    // monolog
    $container['logger'] = function($c) {
        $logger = new \Monolog\Logger('my_logger');
        $file_handler = new \Monolog\Handler\StreamHandler('../logs/app.log');
        $logger->pushHandler($file_handler);
        return $logger;
    };

    //db
    $container['db'] = function($c){

        $capsule = new Capsule;
        $capsule->addConnection($c->get('settings')['db']);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        return $capsule;
    };


};
