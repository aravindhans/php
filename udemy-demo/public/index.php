<h1>PHP Demo</h1>
<?php
	require '../core/router.php';
	$router = new Router();

	$router->add('',['controller'=>'home','action'=>'index']);
	$router->add('posts',['controller'=>'posts','action'=>'index']);
	$router->add('posts/new',['controller'=>'posts','action'=>'new']);

	echo "<pre>";
	// var_dump($router->getRoutes());
	

	$url = $_SERVER['QUERY_STRING'];

	if($router->match($url)){
		var_dump($router->getParams());
	}else{
		echo("route is not found '$url'");
	}

	echo "</pre>";
	echo "Page Loaded....";
?>