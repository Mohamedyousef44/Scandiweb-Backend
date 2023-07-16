<?php

namespace Core;

class Router{
    protected $routes=[];

    public function add($uri , $method , $controller){
        $this->routes[] = [
            'uri' => $uri,
            'method'=> $method,
            'controller'=> $controller

        ];
        return $this ;
    }

    public function get($uri , $controller){
        return $this->add($uri, 'GET', $controller);
    }

    public function post($uri, $controller){
        return $this->add($uri, 'POST', $controller);
    }

    public function delete($uri, $controller){
        return $this->add($uri, 'DELETE', $controller);
    }

    public function route($uri, $method){
        foreach($this->routes as $route){
            if($route['uri'] === $uri && $route['method'] === strtoupper($method)){
                return require __DIR__.'/../Http/controllers/'.$route['controller']  ;
            }
        }
    }

}

?>