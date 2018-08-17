<?php

namespace core;

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
        $route = preg_replace('/\{([a-z]+)\}/','(?P<\1>[a-z-]+)',$route); //convert variables in route definition
        $route = preg_replace('/\{([a-z]+):([^\{]+)\}/','(?P<\1>\2)',$route); //replace numeric ID variables in route definition
        $route = "/^".$route."$/i"; //adding start and end
        $this->routes[$route] = $params;
    }

    //match route and set params if the route is found
    public function match($url){
        foreach($this->routes as $route => $params){
            //echo $route;
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

    /* parses url and dispatches based on the controller and action specified in the url */
    public function dispatch($url){
        $url = $this->removeQueryVariables($url);
        if($this->match($url)){
            $controller = $this->params['controller'];
            $controller = $this->convertToStudlyCase($controller);
            $controller = $this->getNamespace().$controller; //enables use of subdirs under controllers

            if(class_exists($controller)){
                $controller_object = new $controller($this->params);

                $action = $this->params['action'];
                $action = $this->convertToCamelCase($action);

                // fixes a security hole where a direct call to indexAction() / editAction() etc.. is prevented
                if(preg_match('/action$/i',$action)==0){ 
                    $controller_object->$action();
                }else {
                    echo "Controller ($controller) exists but method ($action) cannot be called";
                }
            }
            else{
                echo "Controller ($controller) does not exist";
            }
        }
        else{
            echo "URL ($url) cannot be matched with the regex.";
        }
    }

    /* remove query variables */
    protected function removeQueryVariables($url){
        if($url!=''){
            $parts = explode('&',$url);
            if(strpos($parts[0],'=')===false){
                $url=$parts[0];
            }else{
                $url='';
            }
        }
        return $url;
    }

    /* Replaces hyphens and spaces and updates string to Studly case */
    protected function convertToStudlyCase($string){
        return str_replace(' ','',ucwords(str_replace('-',' ',$string)));
    }

    /*  Same as convertToStudlyCase but first char will be lower */
    protected function convertToCamelCase($string){
        return lcfirst($this->convertToStudlyCase($string));
    }

    protected function getNamespace(){
        $namespace = 'app\controllers\\';
        if(array_key_exists('namespace',$this->params)){
            $namespace .= $this->params['namespace'].'\\'; //prefix call with the namespace
        }
        return $namespace;
    }
}

?>