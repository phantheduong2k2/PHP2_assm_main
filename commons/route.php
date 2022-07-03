<?php

use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\QuizController;
use App\Controllers\SubjectController;
use Phroute\Phroute\RouteCollector;

function applyRoute($url){
    $router = new RouteCollector();

    $router->get('test-layout', function(){
        return view('layouts.main');
    });

    // filter check login
    $router->filter('auth', function(){
        if(!isset($_SESSION['auth']) || empty($_SESSION['auth'])){
            header('location: ' . BASE_URL . 'login');
            die;
        }
    });

    $router->get('/', [HomeController::class, 'index']);

    // định nghĩa ra url mới
    $router->group(['prefix' => 'mon-hoc', 'before' => 'auth'], function($router){
        $router->get('/', [SubjectController::class, 'index']);
        $router->get('tao-moi', [SubjectController::class, 'addForm']);
        $router->post('tao-moi', [SubjectController::class, 'saveAdd']);
        $router->get('cap-nhat/{id}', [SubjectController::class, 'editForm']);
        $router->post('cap-nhat/{id}', [SubjectController::class, 'saveEdit']);
        
        $router->get(['/{id}?', 'subject.index'], [SubjectController::class, 'index']);
    });

    $router->group(['prefix' => 'quizs', 'before' => 'auth'], function($router){
        $router->get('add/{subjectId}?', [QuizController::class, 'addForm']);
        $router->get('/{subjectId}?', [QuizController::class, 'index']);
    });

    $router->get('login', [LoginController::class, 'loginForm']);
    $router->post('login', [LoginController::class, 'postLogin']);
    $router->get('logout', function(){
        unset($_SESSION['auth']);
        return "done";
    });


    $dispatcher = new Phroute\Phroute\Dispatcher($router->getData());
    $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($url, PHP_URL_PATH));
    // Print out the value returned from the dispatched function
    echo $response;
}


?>