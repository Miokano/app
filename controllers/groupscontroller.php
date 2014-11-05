<?php
/**
 * @author Moisés Canto <moikano710@gmail.com>
 *
 * Clase Group.
 * Clase que hereda de la clase principal AppController.
 * Clase para agregar y editar un grupo.
**/
class Group extends AppController{

	/**
	 * Función index.
	 * Se visualizarán los grupos que se han creado, así como la opción de agregar, editar y eliminar grupo.
	 * @param $groups Para visualizar los grupos.
	**/
	public function index(){
		$groups = $this->Group->find("groups","all");
		$this->set("groups",$groups);
	}

	/**
	 * Función add.
	 * Para agregar un nuevo grupo.
	**/
	public function add(){
		if($_POST){
			if($this->Group->save("groups", $_POST)){
				$this->redirect(array("controller"=>"groups","action"=>"index"));
			}else{
				$this->redirect(array("controller"=>"groups","action"=>"add"));
			}
		}
	}

	/**
	 * Función edit.
	 * Para editar cualquier grupo creado anteriormente.
	 * @param $id El id del grupo que se va a modificar.
	**/
	public function edit($id = null){

		if($_POST){
			if($this->Group->update("groups", $_POST)){
				$this->redirect(array("controller"=>"groups","action"=>"index"));
			}else{
				$this->redirect(array("controller"=>"groups","action"=>"edit/".$_POST['$id']));
			}
		}else{
			if(!isset($id)){
				$this->redirect(array("controller"=>"groups","action"=>"index"));
			}
			$group= $this->Group->find("groups","first",array(
				"conditions"=>"id=".$id
			));
			if(empty($group)){
				$this->redirect(array("controller"=>"groups","action"=>"index"));
			}
			$this->set("group",$group);
		}
	}

	/**
	* Funcion delete.
	*
	* Funcion que sirve para eliminar grupos de la base de datos.
	* @param $id Identifica el grupo a eliminar.
	*/
	public function delete($id = null){
		if($_GET){
			$groups = $this->group->delete('groups', 'id = '.$id);
			$this->redirect(array("controller"=>"groups", "action"=>"index"));
		}
	}
}
?>