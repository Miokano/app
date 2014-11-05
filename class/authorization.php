<?php
class Authorization{
	static function logged(){
		session_start();
		if (!$_SESSION['logged']) {
			header("Location: http://localhost/app/users/login");
			exit;
		}
	}

	public function login(){
		session_start();
		$_SESSION['logged'] = true;
		$_SESSION['username'] = $user["username"];
		$_SESSION['start'] = time();
		$_SESSION['expire'] = $_SESSION['start'] + (5 * 60);
	}

	public function logout(){
		#Remove all sesion variables
		session_unset();

		#Destroy the session
		session_destroy();
		echo "<script type='text/javascript'>
		alert('Ha salido correctamente');
		windows.location='users/login'
		</script>";
	}
}

?>