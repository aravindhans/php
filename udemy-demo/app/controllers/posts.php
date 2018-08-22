<?php

namespace app\controllers;

use \core\view;
use \app\models\Post;

class Posts extends \core\BaseController
{

    protected function before(){
        echo '(before)';
    }

    protected function after(){
        echo '(after)';
    }

    public function indexAction(){
        //get all posts from database and pass that to the view
        $posts = Post::getAll();
        View::renderTemplate('Posts/index.html',[
            'posts'=>$posts
            ]);
    }

    public function addNewAction(){
        echo 'addNew() function called from Posts';
    }

    public function editAction(){
        echo '<p>Query String Parameters: <pre>'.\htmlspecialchars(print_r($this->route_params,true)).'</pre></p>';
    }

}

?>