<?php 

require_once('./database.php');
require_once('./vendor/autoload.php');
$db=new DB();
if(array_key_exists('url', $_GET)){
	$array=explode('/',$_GET['url']);
	if(array_key_exists(0, $array)){
		// echo $array[0].'<br>';
		// echo './'.$array[0].'.php';
		require_once('./'.$array[0].'.php');
		$controller = new $array[0]($db);
		if(array_key_exists(1, $array)){
			$method = $array[1].'Method';
			if(array_key_exists(2, $array)){
			    $controller->$method($array[2]);
			}else{
				$controller->$method();
			}
		}else{
			$method ='DefaultMethod';
			$controller->$method();
		}
	}else{
	echo 'Please input the right url.';
	exit();
	}
}




 ?>