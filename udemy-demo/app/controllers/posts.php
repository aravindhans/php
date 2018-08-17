<?php

namespace app\controllers;

class Posts extends \core\BaseController
{

    protected function before(){
        echo '(before)';
    }

    protected function after(){
        echo '(after)';
    }

    public function indexAction(){
        echo 'index() function called from Posts';
        echo '<p>Query String Parameters: <pre>'.\htmlspecialchars(print_r($_GET,true)).'</pre></p>';
    }

    public function addNewAction(){
        echo 'addNew() function called from Posts';
    }

    public function editAction(){
        echo '<p>Query String Parameters: <pre>'.\htmlspecialchars(print_r($this->route_params,true)).'</pre></p>';
    }

}

?>