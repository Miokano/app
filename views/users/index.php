<h2>USERS</h2>
<a href="users/login">Login</a>
<a href="users/add">Agregar usuario</a>
<a href="groups">Grupos</a>
<table border="1">
<tr>
<th> ID </th>
<th> Nombre </th>
<th> Apellido </th>
<th> Edad </th>
<th> Email </th>
<th> Usuario </th>
<th> Password </th>
<th> Opciones </th>
</tr>
<?php
foreach($users as $user){
?>
<tr>
	<td><?php echo $user['id'];?></td>
	<td><?php echo $user['first_name'];?></td>
	<td><?php echo $user['last_name'];?></td>
	<td><?php echo $user['age']; ?></td>
	<td><?php echo $user['email']; ?></td>
	<td><?php echo $user['username']; ?></td>
	<td><?php echo $user['password']; ?></td>
    <td><a href="users/edit/<?php echo $user['id']?>">Modificar</a> | <a href="users/delete/<?php echo $user['id']?>">Eliminar</a></td>
<?php
}
?>
</table>