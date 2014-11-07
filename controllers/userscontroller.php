<?php
/**
 * @author Moisés Canto <moikano710@gmail.com>
 *
 * Clase User.
 * Clase que hereda de la clase principal AppController.
 * Clase para agregar y editar un usuario.
**/
	class User  extends AppController{

		/**
		 * Función construct.
		 * Inicializar las variables heredadas a utilizar.
		**/
		public function __construct(){
			parent::__construct();
		}

		/**
	 	 * Función index.
	 	 * Se visualizarán los usuarios que se han creado, así como la opción de agregar, editar y eliminar usuario.
	 	 * @param $users Para visualizar los usuarios.
		**/
		public function index(){
			$users = $this->User->find("users","all");
			$this->set("users",$users);
		}
		/**
		 * Función sendMail.
		 * Serve para enviar un email.
		 */
		public function sendMail($email,$name){
			$mail = new PHPMailer;
			$mail->From = 'soporte@ut.com';
			$mail->FromName = 'Aplicaciones Web';
			$mail->addAddress($email, $name); // Add a recipient

			$mail->WordWrap = 50; // Set word wrap to 50 characters
			$mail->isHTML(true);  // Set email format to HTML

			$mail->Subject = 'Welcome to App';
			$mail->Body    = 'You are now part of the great world of <b>APP!</b>';

			if(!$mail->send()) {
			    echo 'Message could not be sent.';
			    echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
			    echo 'Message has been sent';
			}
		}

		/**
		 * Función edit.
		 * Para editar cualquier usuario creado anteriormente.
		 * @param $id El id del usuario que se va a modificar.
		**/
		public function edit($id=null){
			if($_POST){
				$filter = new Validations();
				$pass   = new Seguridad();
				$_POST["password"] = $filter->sanitizeText($_POST["password"]);
				$_POST["password"] = $pass->getPassword($_POST["password"]);
				if($this->User->update("users", $_POST)){
					$this->redirect(array("controller"=>"users", "action"=>"index"));
				}else{
					$this->redirect(array("controller"=>"users", "action"=>"edit"));
				}
			}

			$user = $this->User->find("users","first",
			array(
				"conditions"=>"users.id=$id"
			));
			$this->set("user", $user);

			//$groups = $this->User->find("groups", "all");
			//$this->set("groups", $groups);
		}

		/**
	 	 * Función add.
		 * Para agregar un nuevo usuario.
		**/
		public function add(){
			$filter = new Validations();
			if($_POST){
				$filter = new Validations();
				$pass   = new Seguridad();
				$_POST["password"] = $filter->sanitizeText($_POST["password"]);
				$_POST["edad"] = $filter->sanitizeText($_POST["edad"]);
				$_POST["password"] = $pass->getPassword($_POST["password"]);
				/*if($filter->isInt($_POST['edad'], 18, 40)){
					die("Edad fuera del rango");
				}else {
					echo "edad correcta";
				}*/
				if($this->User->save("users", $_POST)){
					$this->sendMail($_POST['email'],$_POST['first_name']);
					$this->redirect(array("controller"=>"users", "action"=>"index"));
				}else{
					$this->redirect(array("controller"=>"users", "action"=>"add"));
				}
			}
		}

		/**
		* Función delete.
		*
		* Función que sirve para eliminar usuarios de la base de datos.
		* @param  $id Identifica el usuario a eliminar.
		*/
     	public function delete($id = null){
			if($this->User->delete("users", $id)){
				$this->redirect(array("controller"=>"users","action"=>"index"));
			}
			$user = $this->User->find("users","all",
			array(
				"conditions"=>"users.id=$id"
			));
			$this->set("user", $user);
		}

		public function login(){
			if($_POST){
				$pass = new Seguridad();
				$filter = new Validations();
				$auth = new Authorization();

				$username = $filter->sanitizeText($_POST["username"]);
				$password = $filter->sanitizeText($_POST["password"]);

				$options['conditions'] = " username = '$username'";
				$user = $this->User->find("users", "first", $options);

				if($pass->isValid($password, $user['password'])){
					$auth->login($user);
					$this->redirect(array("controller"=>"users", "action"=>"index"));
				}else{
					echo "Usuario Invalido";
				}
			}
		}
		public function logout(){
			$auth = new Authorization();
			$auth->logout();
		}
	}
?>