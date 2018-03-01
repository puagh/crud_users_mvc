<?php

class Paginas{

	public function enlacesPaginasModel($enlaces){
		if($enlaces == "ingresar" || $enlaces == "usuarios" || $enlaces == "editar" || $enlaces == "salir"){
			$module =  "views/modules/".$enlaces.".php";
		}

		elseif($enlaces == "falloInicio"){
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

?>