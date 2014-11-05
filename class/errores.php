<?php
/**
 * Ejemplo de manejo de errores.
 * -1 E_ERROR: Errores fatales en tiempo de ejecución.
 * -2 E_WARNING: Advertencia en tiempo de ejecución.
 * -4 E_PARSE: Errores de análisis en tiempo de compilación.
 * -8 E_NOTICE: Avisos en tiempo de ejecución.
 * -16 E_CORE_ERROR: Errores fatales que ocurre durante el aranque inicial de PHP.
 * -32 E_CORE_WARNING: Advertencias.
 * -64 E_COMPILE_ERROR: Errores fatales en tiempo de copilación.
 * -128 E_COPILE_WARNING: Advertencia en tiempo de copilación.
 * -256 E_USER_ERROR: Mensaje de error generado por el usuario.
 * -512 E_USER_WARNING: Mensaje de advertencia generado por el usuario.
 * -1024 E_USER_NOTICE: Mensaje de aviso generado por el usuario.
 */

/**
 * Clase Errores
 * Manejo de los diferentes tipos de errores.
 * @package app
 * @author Moisés Canto Martin
 * @author moikano710@gmail.com
 * @param array $errorTipos Los tipos de errores.
 * @param bool $mostrarErrores
 * @access private
 * @param bool $logearErrores
 * @access private
 * @param file $archivoErrores
 * @access private
 */
class Errores{
	public $errorTipos = array(
		1=>"EROOR",
		2=>"WARNING",
		4=>"PARSE EROOR",
		8=>"NOTICE",
		16=>"CORE EROOR",
		32=>"CORE WARNING",
		64=>"COMPILE EROOR",
		128=>"COMPILE WARNING",
		256=>"USER EROOR",
		512=>"USER WARNING",
		1024=>"USER NOTICE"
		);
	private $mostrarErrores = true;
	private $logearErrores = true;
	private $archivoErrores = "tmp/PHP_errores.log";

	/**
	 * Función Construct
	 * 
	 * @param $gestor Se encarga de controlar los errores que se produscan.
	 */
	public function __construct(){
		$gestor = set_error_handler(array($this, 'gestionErrores'));
		error_reporting(E_ALL);
	}
	/**
	* Función gestionErrores.
	* Gestiona los errores que se producen en un formato.
	* 
	* @param $errno Tipo del error.
	* @param $errstr Mensaje del error.
	* @param $file URL del archivo donde se encuentra el error.
	* @param $linea Linea donde se produjo el error.
	* @param $context
	*/
	public function gestionErrores($errno, $errstr, $file, $linea, $context){
		$strErr = "<pre>";
		$strErr .="--ERROR ".$this->errorTipos[$errno]." --".PHP_EOL;
		$strErr .="FECHA: ".date("y-m-d H:i:s").PHP_EOL;
		$strErr .="ARCHIVO: ".$file.PHP_EOL;
		$strErr .="LINEA: ".$linea.PHP_EOL;
		$strErr .="IP SERVIDOR: ".$_SERVER['SERVER_ADDR'].PHP_EOL;
		$strErr .="IP USUARIO: ".$_SERVER['REMOTE_ADDR'].PHP_EOL;
		$strErr .="MENSAJE: ".$errstr.PHP_EOL;
		$strErr .="--ERROR: ".$this->errorTipos[$errno]." --".PHP_EOL;
		$strErr .= "</pre>";

		if ($this->logearErrores) {
			if ($this->archivoErrores) {
				$logTxt = file_get_contents($this->archivoErrores);
				$logTxt .= $strErr.PHP_EOL;
				file_put_contents($this->archivoErrores, $logTxt);
			}
		}

		if ($this->mostrarErrores) {
			echo $strErr;
		} else {
			echo "ERROR".PHP_EOL;
		}
	} #Fin del método gestionErrores
}

$error = new Errores();
#echo $x; #Ejemplo para comprobar que funciona el manejo de errores.
?>