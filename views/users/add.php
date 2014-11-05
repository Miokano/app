<!-- <h1>Agregar Usuario</h1>
<form action="users" method="POST">
	<p>First Name: <input type="text" name="first_name"></p>
   	<p>Last Name: <input type="text" name="last_name"></p>
	<p>Email: <input type="text" name="email"></p>
    <p><input type="submit" value="save"></p>
</form> -->

<h1>Agregar Usuario</h1>
<form action="Users/add" method="POST">
	<p>First name: <input type="text" name="first_name"></p>
	<p>Last name: <input type="text" name="last_name"></p>
	<p>Email: <input type="text" name="email"></p>
    <p>Edad: <input type="text" name="age"></p>
    <p>Password: <input type="text" name="password"></p>
	<p><input type="submit" value="Save"></p>
</form>