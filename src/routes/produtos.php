<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

//Rotas Produtos
$app->group('/api/v1', function(){
    $this->get('/produtos', function($request, $response){
        return $response->withJson(['nome'=>'Moto G']);
    
    });

});