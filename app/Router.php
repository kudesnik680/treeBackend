<?php
/**
 * Created by PhpStorm.
 * User: kudesnik680
 * Date: 21.01.2019
 * Time: 14:02
 */
namespace App;

class Router {

    private $router;

    public function __construct() {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: Content-Type');
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
        header('Content-Type: application/json; charset=utf-8');

        $this->router = \Bit55\Litero\Router::fromGlobals();
        
        $_POST = json_decode(file_get_contents('php://input'), true);
    }

    public function add($path, $handler) {
        $this->router->add($path,$handler);
    }

    public function start() {
        if ($this->router->isFound()) {
            $this->router->executeHandler(
                $this->router->getRequestHandler(),
                $this->router->getParams()
            );
        }
        else {
            $this->router->executeHandler(function () {
                http_response_code(404);
                echo '404 Not found';
            });
        }
    }
}