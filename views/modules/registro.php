<h1>REGISTRO DE USUARIO</h1>

<form method="post" onsubmit="return validarRegistro()">

	<label for="usuarioRegistro">Usuario</label>
	<input type="text" placeholder="Máximo 6 caracteres" maxlength="6" name="usuarioRegistro" id="usuarioRegistro" required>

	<label for="passwordRegistro">Contraseña</label>
	<input type="password" placeholder="Mínimo 6 caracters, incluir un numero y una letra mayúscula" name="passwordRegistro" id="passwordRegistro"
	pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" required>

	<label for="emailRegistro">Correo electrónico</label>
	<input type="email" placeholder="Escriba correctamente su correo electrónico" name="emailRegistro" id="emailRegistro" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
	required>
	
	<p style="text-align:center;"><input type="checkbox" id="terminos"><a href="">Acepta términos y condiciones</a></p>
	<input type="submit" value="Enviar">
</form>

<?php
	$registro = new MvcController();
	$registro -> registroUsuarioController();

	if(isset($_GET["action"]) && $_GET["action"] == "ok"){
		echo "Registro Exitoso";
	}
?>
