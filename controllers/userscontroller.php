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
		private function sendMail(){

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
			if($_POST){
				$users = $this->User->delete('users', 'id = '.$id);
				$this->redirect(array("controller"=>"users", "action"=>"index"));
		    }
		}

		public function login(){
			if($_POST){
				$pass = new Seguridad();
				$filter = new Validations();
				$auth = new Authorization();

				$username = $filter->sanitizeText($_POST["username"]);
				$password = $filter->sanitizeText($_POST["Password"]);

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