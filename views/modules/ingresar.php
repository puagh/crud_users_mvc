<h1>INGRESAR</h1>

	<form method="post" onsubmit="return validarIngreso()">

		<label for="usuarioInicio">Usuario</label>
		<input type="text" placeholder="Usuario" id="usuarioInicio" name="usuarioInicio" maxlength="6">

		<label for="passwordInicio">Contraseña</label>
		<input type="password" placeholder="Contraseña" id="passwordInicio" name="passwordInicio" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}">
		<input type="submit" value="Enviar">
	</form>

	<?php
	$ingreso = new MvcController();
	$ingreso -> ingresoUsuarioController();

	if(isset($_GET["action"]) && $_GET["action"] == "falloInicio"){
		echo "usuario y/o contraseña no válidos";
	}

	if(isset($_GET["action"]) && $_GET["action"] == "fallo3intentos"){
		echo "Por favor complete el captcha";
	}
	?>
