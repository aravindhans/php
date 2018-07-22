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
    public function add($route, $params = []){
        // // $this->routes[$route] = $params;
        
        //Use only singly quotes when using regex
        $route = preg_replace('/\//','\\/',$route); //replace / with \/ to escape it in route definition
        $route = preg_replace('/\{([a-z]+)\}/','(?P<\1>[a-z]+)',$route); //convert variables in route definition
        $route = preg_replace('/\{([a-z]+):([^\{]+)\}/','(?P<\1>\2)',$route); //replace numeric ID variables in route definition
        $route = "/^".$route."$/i"; //adding start and end
        $this->routes[$route] = $params;
    }

    //match route and set params if the route is found
    public function match($url){
        // //preg_match("/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/", $input_line, $output_array);

        // // foreach($this->routes as $route => $params){
        // //     if($url == $route){
        // //         $this->params = $params;
        // //         return true;
        // //     }
        // // }

        // // $reg_exp = "/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/";

        foreach($this->routes as $route => $params){
            echo $route;
            if(preg_match($route,$url,$matches)){
                foreach($matches as $key => $match){
                    if(is_string($key)){
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

}

?>