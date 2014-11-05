<?php
/**
 * Clase para validar filtro de datos.
 * 
 * Coleccion de funciones para validar filtro de datos, rangos y valores.
 * @author Moisés Canto <moikano710@gmail.com>
**/
class Validations{
	/**
	 * Método isInt
	 *
	 * Método que sirve para determinar si un número es valido, opcionalmente dentro de un rango.
	 * @param $number Número a evaluar.
	 * @param $min_range Valor inferior del rango.
	 * @param $max_range Valor superior del rango.
	 * @return bool Valor boleano resultado de la validación.
	**/
	public function isInt($number, $min_range = null, $max_range = null){
		#Rango de números.
		$options = array();

		if ($min_range && $max_range) {
			$options = array(
				array(
					"min_range"=>$min_range,
					"max_range"=>$maxn_range
				)
			);
		}else{
			if ($min_range) {
				$options = array(
					array("min_range"=>$min_range
					)
				);
			}

			if ($max_range) {
				$options = array(
					array("max_range"=>$max_range
					)
				);
			}
		}
		if (filter_var($number, FILTER_VALIDATE_INT, $options)) {
			return true;
		}
		return false;
	}

	/**
	 * Método isEmail
	 *
	 * Método que sirve para determinar si el correo es valido.
	 * @param $email Correo a evaluar.
	 * @return bool Valor boleano resultado de la validación.
	**/
	public function isEmail($email){
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);

		#Aplicamos el filtro.
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return true;
		}
		return false;
	}
}
?>