<?php
/**
 * @author Moisés Canto Martin <moikano710@gmail.com>
 * Clase abstracta AppController.
 * Para todos los controladores.
**/
abstract class AppController{

	abstract public function index();

	/**
	 * Función Construct.
	 * Se inicializan las variables.
	 * @param $nameController El nombre de controlador.
	**/
	public function __construct(){
		$nameController = get_class($this);
		$this->$nameController = new ClassPDO();
	}

	/**
	 * Función protegida set.
	 * Para pasarle los valores a las variables.
	 * @param $name
	 * @param $value
	**/
	protected function set($name = null, $value = array()){
		$GLOBALS[$name] = $value;
	}
	/**
	 * Función redirect.
	 * Se redireccionará a la página principal.
	 * @param $url La dirección a la que se redireccionará.
	**/
	protected function redirect($url = array()){
		$path = "";
		if($url["controller"]){
			$path .= $url["controller"];
		}
		if($url["action"]){
			$path .= "/".$url["action"];
		}
		header("LOCATION: http://localhost/app/".$path);
	}
}