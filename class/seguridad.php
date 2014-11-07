<?php
/**
 * Clase Seguridad
 * Clase para el manejo de contraseñas.
 * @author Moisés Canto Martin <moikano710@gmail.com>
**/
class Seguridad{
	public function __construct(){
		$this->checkBlowfish();
	}

	/**
	 * Función checkBlowfish.
	 * Para saber si esta definiso o soporta el Blowfish.
	**/
	private function checkBlowfish(){
		if (!defined("CRYPT_BLOWFISH") && !CRYPT_BLOWFISH) {
			echo "Algoritmo Blowfish no soportado";
			die();
		}
	}

	/**
	 * Función getPassword.
	 * Para obtener y encriptar la contraseña.
	 * @param $password La contraseña.
	 * @param $dig La cantidad de caracteres a ingresar.
	 * @return $password y $salt Las regresa encriptadas.
	**/
	public function getPassword($password, $dig = 7){
		$set_salt = './0123456789ABCDFEGHIJKLMNOPQRSTUVWXYYZabcdefghijklmnopqrstuvwxyz';
		$salt = sprintf('$2a$%02d$', $dig);
		for ($i=0; $i < 22; $i++) {
			$salt .= $set_salt[mt_rand(0, 22)];
		}
		return crypt($password, $salt);
	}
	/**
	 * Función isValid.
	 * Para validar el password.
	 * @param $pass1 La primera contraseña.
	 * @param $pass2 La segunda contraseña.
	 * @return bool Valor boleano resultado de validación.
	**/
	public function isValid($pass1, $pass2){
		if (crypt($pass1, $pass2) == $pass2) {
			return true;
		}
		return false;
	}

	/**
	 * Función passworVerify.
	 * Para verificar que la contraseña este correcta.
	 * @param string $pass1 La primera contraseña.
	 * @param string $pass2 La segunda contraseña.
	 * @return true Regresa verdadero si coinciden las contraseñas.
	 * @return false Regresa falso si no coinciden las contraseñas.
	 * @version PHP 5.5
	**/
	public function passwordVerify($pass1, $pass2){
		if (password_verify($pass1, $pass2) == $pass2) {
			return true;
		}
		return false;
	}
}
$pass = new Seguridad();
#echo $pass->getPassword("Hola");
# hash generada en getPassword que es "Hola" es la que se comprueba que sean iguales.
$hashDB = '$2a$07$1C/C80GBA3A6.08994CC3.PVPP/CXY0kjygnGd0V.UVKh07vTuZQK';
if ($pass->isValid("Hola", $hashDB)) {
	echo "Usuario valido";
} else {
	echo "Usuario invalido";
}
?>