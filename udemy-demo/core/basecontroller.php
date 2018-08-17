<?php

namespace core;

abstract class BaseController{

    protected $route_params = []; //protected as only classes that extend this can access it

    public function __construct($route_params){
        $this->route_params = $route_params;
    }

    /** This method is called before and after every function call within a controller **/
    public function __call($name, $args){
        $method = $name.'Action';

        if(method_exists($this,$method)){
            if($this->before() !== false){
                call_user_func_array([$this,$method],[$args]);
                $this->after();
            }
        }else{
            echo "method ($method) does not exist in class ($name)";
        }

    }

    protected function before(){ //do nothing
    }

    protected function after(){ //do nothing
    }

}



?>