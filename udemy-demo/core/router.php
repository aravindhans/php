<?php

class Router{
    protected $routes = [];
    protected $params = [];

    //get all routes
    public function getRoutes(){
        return $this->routes;
    }

    //get params
    public function getParams(){
        return $this->params;
    }

    //add route to the routing table
    public function add($route, $params){
        $this->routes[$route] = $params;
    }

    //match route and set params if the route is found
    public function match($url){
        foreach($this->routes as $route => $params){
            if($url == $route){
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

}

?>