<?php
/**
 * @author Moisés Canto Martin <moikano710@gmail.com>
 *
 * Clase PDO
 *
 * Conexión a la base de datos y consultas a la misma.
 * @param private $connection Para realizar la conexión a la base de datos.
 * @param private $dns La dirección del host y la base de datos.
 * @param private $username El usuario de la base de datos.
 * @param private $password La contraseña de la base de datos.
**/
class ClassPDO{
	private $connection;
	private $dsn;
	private $username;
	private $password;

	/**
	 * Función Construct.
	 * Se inicializan las variables.
	 * @param $connection Para realizar la conexión a la base de datos.
	 * @param $dns La dirección del host y la base de datos.
	 * @param $username El usuario.
	 * @param $password La contraseña del usuario.
	**/
	public function __construct(){
		$this->dsn = 'mysql:host=localhost;dbname=test';
		$this->username = 'root';
		$this->password = '';
		$this->connection();
	}

	/**
	 * Función connection.
	 * Se hace la conexión a la base de datos utilizando PDO.
	 * @param $connection Para realizar la conexión a la base de datos.
	 * @param $dns La dirección del host y la base de datos.
	 * @param $username El usuario.
	 * @param $password La contraseña del usuario.
	**/
	private function connection(){
		try{
			$this->connection = new PDO(
				$this->dsn,
				$this->username,
				$this->password
			);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			echo "ERROR: " . $e->getMessage();
			die();
		}
	}

	/**
	 * Función find.
	 * Se hacen las diferentes consultas a la base de datos.
	 * @param $table La tabla en la que se hará la consulta.
	 * @param $query La sentecia que se va a realizar a la base de datos.
	 * @param $option Las diferentes opciones que hay para hacer la consulta.
	 * @return $result Devuelve el resultado dependiendo el tipo de consulta.
	**/
	public function find($table = null, $query = null, $options = array()){
		$fields = '*';
		$parameters = '';

		if(!empty($options['conditions'])){
			$parameters = ' WHERE '.$options['conditions'];
		}
		if(!empty($options['fields'])){
			$fields = $options['fields'];
		}
		if(!empty($options['group'])){
			$parameters .= ' Group By '.$options['group'];
		}
		if(!empty($options['order'])){
			$parameters .= ' Order By '.$options['order'];
		}
		if(!empty($options['limit'])){
			$parameters .= ' limit '.$options['limit'];
		}
		switch ($query){
			case 'all':{
				$sql = "Select $fields From ".$table.' '.$parameters;
				$this->result = $this->connection->query($sql);
				break;
			}
			case 'count':{
				$sql = "Select COUNT(*) From ".$table.' '.$parameters;
				$result = $this->connection->query($sql);
				$this->result = $result->fetchColumn();
				break;
			}
			case 'first':{
				$sql = "Select $fields From ".$table.' '.$parameters;
				$result = $this->connection->query($sql);
				$this->result = $result->fetch();
				break;
			}
			default:
				$sql = "Select $fields From ".$table.' '.$parameters;
				$this->result = $this->connection->query($sql);
				break;
		}

		#$sql = "Select $fields From ".$table.$parameters;
		#$this->result = $this->connection->query($sql);
		return $this->result;
	}
	#Add
	/**
	 * Función save.
	 * Se agrega y guarda la información(id, name) a la base de datos.
	 * @param $table La tabla en la que se hará la consulta.
	 * @param $data Los datos que serán guardados en la tabla users.
	 * @return $result Devuelve la información (id, name) de la tabla users con los nuevos datos insertados.
	**/
	public function save($table = null, $data = array()){
		$sql = "select * from $table";
		$result = $this->connection->query($sql);

		for($i=0;$i<$result->columnCount();$i++){
			$meta = $result->getColumnMeta($i);
			$fields[$meta['name']] = null;
		}
		$fieldsToSave="id";
		$valueToSave="null";

		foreach($data as $key => $value){
			if(array_key_exists($key,$fields)){
				$fieldsToSave .= ", ".$key;
				$valueToSave .= ", "."\"$value\"";
			}
		}

		$sql = "INSERT INTO $table ($fieldsToSave) VALUES ($valueToSave);";
		$this->result = $this->connection->query($sql);
		return $this->result;
	}
	#Update
	/**
	 * Función update.
	 * Se actualiza la información(id, name) en la tabla users.
	 * @param $table La tabla en la que se hará la consulta.
	 * @param $data Los datos que serán actualizados de la tabla users.
	 * @return $result Devuelve la información actualizada (id, name) de la tabla users.
	**/
	public function update($table = null, $data = array()){
		$sql = "select * from $table";
		$result = $this->connection->query($sql);

		for($i=0;$i<$result->columnCount();$i++){
			$meta = $result->getColumnMeta($i);
			$fields[$meta['name']] = null;
		}
		if(array_key_exists("id", $data)){
			//Update
			$fieldsToSave = "";
			$id = $data["id"];
			unset($data["id"]);
			$i = 0;
			foreach ($data as $key => $value) {
				if(array_key_exists($key, $fields)){
					if($i==0){
						$fieldsToSave .= $key."="."\"$value\"";
					}elseif($i == count($data)-1){
						$fieldsToSave .= ",".$key."="."\"$value\"";
					}else{
						$fieldsToSave .= ",".$key."="."\"$value\" ";
					}
				}
				$i++;
			}
			$sql = "UPDATE $table SET $fieldsToSave WHERE $table.id = $id";
		}
		$this->result = $this->connection->query($sql);
		return $this->result;
	}
	#Delete
	/**
	 * Función delete.
	 * Se elimina la información(id, name) de la tabla users.
	 * @param $table La tabla en la que se hará la consulta.
	 * @param $data Los datos que serán eliminado de la tabla users.
	 * @return $result Devuelve la información (id, name) de la tabla users menos el que se elimino.
	**/
	public function delete($table = null, $id){
		#$sql = "select * from $table";
		#$result = $this->connection->query($sql);
		#$id = $_POST['id'];

		$sql = "DELETE FROM $table WHERE id = $id";
		$this->result = $this->connection->query($sql);
		return $this->result;
	}

	/**
	 * Función getLastId.
	 * Se obtiene los ùltimos datos insertados de la tabla users.
	 * @param $table La tabla en la que se hará la consulta.
	 * @param $data Los datos que serán visualizados de la tabla users.
	 * @return $result Devuelve la última información (id, name) de la tabla users.
	**/
	public function getLastId($table = null, $data = array()){
		$sql = "select * from $table";
		$result = $this->connection->query($sql);
	}
}

$db = new ClassPDO();
$datos = array();
?>