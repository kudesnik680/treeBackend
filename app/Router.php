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
        $this->router = \Bit55\Litero\Router::fromGlobals();
        $this->router->add('/option',function (){
            return true;
        });
    }

    public function add($path, $handler, $method='GET') {
        $this->router->add($path,$handler, $method);
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