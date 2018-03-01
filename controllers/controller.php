<?php

class MvcController{

	#LLAMADA A LA PLANTILLA
	#-------------------------------------

	public function pagina(){

		include "views/template.php";

	}

	#ENLACES
	#-------------------------------------

	public function enlacesPaginasController(){
		if(isset( $_GET['action'])){
			$enlaces = $_GET['action'];
		}
		else{
			$enlaces = "index";
		}
		$respuesta = Paginas::enlacesPaginasModel($enlaces);
		include $respuesta;
	}

	#Registro de usuarios------------------------
	public function registroUsuarioController(){

		if(isset($_POST["usuarioRegistro"])){

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuarioRegistro"]) &&
				 preg_match('/^[a-zA-Z0-9]+$/', $_POST["passwordRegistro"]) &&
				 preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["emailRegistro"])){

				$cifrar = crypt($_POST["passwordRegistro"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$datosController = array('usuario' => $_POST["usuarioRegistro"],
											 'password' => $cifrar,
										 	 'email' => $_POST["emailRegistro"]);

				$respuesta = Data::registroUsuarioModel($datosController, "usuarios");

				if($respuesta == "success"){
					header("location:index.php?action=ok");
				}
				else{
					header("location:index.php");
				}
			}
		}
	}
		#-------------------------------------------

		#Ingreso de usuarios------------------------
		public function ingresoUsuarioController(){
			if(isset($_POST["usuarioInicio"])){

				if(preg_match('/^[a-zA-Z0-9]*$/', $_POST["usuarioInicio"]) && preg_match('/^[a-zA-Z0-9]*$/', $_POST["passwordInicio"])){

					$cifrar = crypt($_POST["passwordInicio"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

					$datosController = array('usuario' => $_POST["usuarioInicio"], 'password' => $cifrar);

					$respuesta = Data::ingresoUsuarioModel($datosController, "usuarios");
					$intentos = $respuesta["intentos"];
					$usuario = $_POST["usuarioInicio"];
					$maximo_intentos = 2;

					if($intentos <= $maximo_intentos){
						if($respuesta["usuario"] === $_POST["usuarioInicio"] && $respuesta["password"] === $cifrar){

							#Creación de la sesión
							session_start();
							#Creación de las variables de sesión
							$_SESSION["validar"] = true;

							#Regreso a 0 intentos si el usuario inicia sesión correctamente
							$intentos = 0;
							$datosController = array("usuarioactual" => $usuario, "actualizarintentos" => $intentos);
							$respuestaActualizarIntentos = Data::intentosUsuarioModel($datosController, "usuarios");

							#Redireccionamiento
							header("location:index.php?action=usuarios");
						}
						else {
							++$intentos;		//Incremento de la variable intentos si el usuario no ingresa correctamente usuario y contraseña
							$datosController = array("usuarioactual" => $usuario, "actualizarintentos" => $intentos);
							$respuestaActualizarIntentos = Data::intentosUsuarioModel($datosController, "usuarios");
 							header("location:index.php?action=falloInicio");
						}
					}

					#Si el usuario hace más de 3 intentos fallidos de inicio de sesión
					else{
						$intentos = 0;
						$datosController = array("usuarioactual" => $usuario, "actualizarintentos" => $intentos);
						$respuestaActualizarIntentos = Data::intentosUsuarioModel($datosController, "usuarios");
						header("location:index.php?action=fallo3intentos");
					}
				}
			}
		}
		#-------------------------------------------
		#Vista de usuarios--------------------------
		public function vistaUsuariosController(){
			$respuesta = Data::vistaUsuariosModel("usuarios");

			foreach ($respuesta as $row => $item) {
				echo'<tr>
					<td>'.$item["usuario"].'</td>
					<td>'.$item["password"].'</td>
					<td>'.$item["email"].'</td>
					<td><a href="index.php?action=editar&id='.$item["id"].'"><button>Editar</button></a></td>
					<td><a href="index.php?action=usuarios&idBorrar='.$item["id"].'"><button>Borrar</button></a></td>
				</tr>';
			}
		}
		#----------------------------------------------
		#Editar usuarios-------------------------------
		public function editarUsuarioController(){
			$datosController = $_GET["id"];
			$respuesta = Data::editarUsuarioModel($datosController, "usuarios");
			echo '<input type="hidden" value="'.$respuesta["id"].'" name="idEditar">
						<label for="usuarioEditar">Usuario</label>
						<input type="text" value="'.$respuesta["usuario"].'" id="usuarioEditar" name="usuarioEditar">
						<label for="passwordEditar">Contraseña</label>
						<input type="text" value="'.$respuesta["password"].'" id="passwordEditar" name="passwordEditar">
						<label for="emailEditar">Correo</label>
						<input type="email" value="'.$respuesta["email"].'" id="emailEditar" name="emailEditar">
						<input type="submit" value="Actualizar">';
		}
		#-----------------------------------------------
		#Actualizar usuario------------------------------------
		public function actualizarUsuarioController(){
			if(isset($_POST["usuarioEditar"])){

				if(preg_match('/^[a-zA-Z0-9]*$/', $_POST["usuarioEditar"]) && /*preg_match('/^[a-zA-Z0-9]*$/', $_POST["passwordEditar"]) && */ preg_match('/^\w+@\w+\.+[a-z]*$/', $_POST["emailEditar"])){

					$cifrar = crypt($_POST["passwordEditar"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

					$datosController = array(	"id"=>$_POST["idEditar"],
																		"usuario"=>$_POST["usuarioEditar"],
												 						"password"=>$cifrar,
												 						"email"=>$_POST["emailEditar"]);

					$respuesta = Data::actualizarUsuarioModel($datosController, "usuarios");

					if($respuesta == "success"){
						header("location:index.php?action=cambio");
					}
					else{
						echo "error";
					}
				}
			}
		}

		#-------------------------------------------------------------
		#Eliminar usuarios -------------------------------------------
		public function borrarUsuarioController(){
			if(isset($_GET["idBorrar"])){
				$datosController = $_GET["idBorrar"];
				$respuesta = Data::borrarUsuarioModel($datosController, "usuarios");

				if($respuesta == "success"){
					header("location:index.php?action=usuarios");
				}
			}
		}
}

?>
