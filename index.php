<?php
/**
 * @author Moisés Canto Martin <moikano710@gmail.com>
**/
	# Separador de direcciones para Windows y Linux.
	define('DS', DIRECTORY_SEPARATOR);
	# Para obtener el directorio de archivo de inclusión actual
	define('ROOT',dirname(__FILE__)) . DS;
	define('APP_PATH', ROOT);

	function __autoload($classname) {
    	$filename = "class/". $classname .".php";
    	include_once $filename;
	}

	include_once APP_PATH . DS . 'class'. DS . 'pdo.php';
	include_once APP_PATH . DS . 'class'. DS . 'errores.php';
	include_once APP_PATH . DS . 'class'. DS . 'validations.php';
	include_once APP_PATH . DS . 'controllers'. DS . 'appcontroller.php';

	//print_r(get_required_files());

	if(isset($_GET['url'])){
		$url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
		$url = explode("/", $url);
		$url = array_filter($url);

		$controller = array_shift($url);
		$action = array_shift($url);
		$args = $url;
	}

	if(!isset($controller)){
		$controller = "users";
	}
	if(!isset($action)){
		$action = "index";
	}
	if(empty($args)){
		$args = array(0=>null);
	}
	if($action=="login" or $action=="index"){
	}else{
		#Authorization::logged();
	}

	# La ruta o directorio de carpetas de la vista.
	$path = APP_PATH.DS."controllers".DS.$controller."controller.php";
	$view = APP_PATH.DS."views".DS.$controller.DS.$action.".php";
	$header = APP_PATH.DS."views".DS."layouts".DS."default".DS."header.php";
	$footer = APP_PATH.DS."views".DS."layouts".DS."default".DS."footer.php";

	if(file_exists($path)){
		include_once $path;

		$className = trim($controller, 's');
		$ob = new $className();

		if(isset($args)){
			$ob->$action($args[0]);
		}
		else{
			$ob->$action();
		}

		if(file_exists($view)){
			include_once $header;
			include_once $view;
			include_once $footer;
		}
		else{
			echo "La vista para la acción $action no existe";
		}
	}
	else{
		echo "El controlador $controller no existe";
	}
?>