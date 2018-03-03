<?php

class Paginas{

	public function enlacesPaginasModel($enlaces){
		if($enlaces == "ingresar" || $enlaces == "usuarios" || $enlaces == "editar" || $enlaces == "salir"){
			$module =  "views/modules/".$enlaces.".php";
		}

		else if($enlaces == "index"){
			$module = "views/modules/registro.php";
		}

		elseif($enlaces == "falloInicio"){
			$module = "views/modules/ingresar.php";
		}

		elseif($enlaces == "fallo3intentos"){
			$module = "views/modules/ingresar.php";
		}

		elseif($enlaces == "cambio"){
			$module = "views/modules/usuarios.php";
		}

		else{
			$module =  "views/modules/registro.php";
		}

		return $module;
	}
}
