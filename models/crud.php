<?php

  require_once "connection.php";

  class Data extends Connection{

    #Registro de usuarios----------------------------
    public function registroUsuarioModel($datosModel, $tabla){
      $stmt = Connection::connect()->prepare("INSERT INTO $tabla(usuario, password, email) VALUES (:usuario, :password, :email)");
      $stmt -> bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
      $stmt -> bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
      $stmt -> bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
      if($stmt -> execute()){
        return "success";
      }
      else{
        return "error";
      }
      #Una vez hecha la conexión y manipulación de la info se cierra la conexión a la BD
      $stmt -> close();
    }
    #-------------------------------------------------
    #Ingreso del usuario -----------------------------
    public function ingresoUsuarioModel($datosModel, $tabla){
      $stmt = Connection::connect()->prepare("SELECT usuario, password, intentos FROM $tabla WHERE usuario = :usuario");
      $stmt -> bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
      $stmt -> execute();
      return $stmt -> fetch();
      $stmt -> close();
    }
    #--------------------------------------------------
    #Intentos usuario -----------------------------
    public function intentosUsuarioModel($datosModel, $tabla){
      $stmt = Connection::connect()->prepare("UPDATE $tabla SET intentos = :intentos WHERE usuario = :usuario");
  		$stmt->bindParam(":intentos", $datosModel["actualizarintentos"], PDO::PARAM_INT);
  		$stmt->bindParam(":usuario", $datosModel["usuarioactual"], PDO::PARAM_STR);
  		if($stmt->execute()){
  			return "success";
  		}
  		else{
  			return "error";
  		}
      $stmt -> close();
    }
    #---------------------------------------------------
    #Vista usuarios------------------------------------
    public function vistaUsuariosModel($tabla){
      $stmt = Connection::connect()->prepare("SELECT id, usuario, password, email FROM $tabla");
      $stmt -> execute();
      #fetchAll obtiene todas las filas de un conjunto de resultados
      #asociados al objeto PDOStatement.
      return $stmt -> fetchAll();
      $stmt -> close();
    }
    #------------------------------------------------------
    #Editar usuario----------------------------------------
    public function editarUsuarioModel($datosModel, $tabla){
  		$stmt = Connection::connect()->prepare("SELECT id, usuario, password, email FROM $tabla WHERE id = :id");
  		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);
  		$stmt->execute();
  		return $stmt->fetch();
  		$stmt->close();
  	}
    #-------------------------------------------------------
    #Actualizar usuario-------------------------------------
    public function actualizarUsuarioModel($datosModel, $tabla){
  		$stmt = Connection::connect()->prepare("UPDATE $tabla SET usuario = :usuario, password = :password, email = :email WHERE id = :id");
  		$stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
  		$stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
  		$stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
  		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);

  		if($stmt->execute()){
  			return "success";
  		}

  		else{
  			return "error";
  		}

  		$stmt->close();
  	}
    #------------------------------------------------------------
    #Borrar usuario----------------------------------------------
    public function borrarUsuarioModel($datosModel, $tabla){
      $stmt = Connection::connect()->prepare("DELETE FROM $tabla WHERE id = :id");
      $stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);
      if($stmt->execute()){
  			return "success";
  		}
  		else{
  			return "error";
  		}
  		$stmt->close();
    }
  }
