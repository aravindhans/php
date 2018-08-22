<?php

namespace core;

/**
 * Base controller will be inherited by all controller classes. 
 * Should containg functions that would be inherited by the extended classes.
 */
abstract class BaseController
{

    protected $route_params = []; //protected as only classes that extend this can access it

    /**
     * Contructor method.
     */
    public function __construct($route_params)
    {
        $this->route_params = $route_params;
    }

    /** 
     * This method is called before and after every 
     * function call within a controller.
     */
    public function __call($name, $args)
    {
        $method = $name.'Action';

        if (method_exists($this, $method))
        {
            if ($this->before() !== false)
            {
                call_user_func_array([$this, $method], [$args]);
                $this->after();
            }
        }
        else
        {
            // echo "method ($method) does not exist in class ($name)";
            throw new \Exception("method ($method) does not exist in class (".get_class($this).")");
        }

    }

    protected function before(){ //do nothing
    }

    protected function after(){ //do nothing
    }

}



?>