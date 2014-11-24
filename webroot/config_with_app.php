<?php
/**
 * Config file for pagecontrollers, creating an instance of $app.
 *
 */

// Get environment & autoloader.
require __DIR__.'/config.php'; 

// Create services and inject into the app. 
$di  = new \Anax\DI\CDIFactoryDefault();
$di->set('QuestionsController', function() use ($di) {
    $controller = new Anax\Anax\QuestionsController();
    $controller->setDI($di);
    return $controller;
});
$app = new \Anax\MVC\CApplicationBasic($di);
