//Función que valida los campos requeridos en el formulario de registro
function validarRegistro(){
  // Inicialización de variables
  var usuario, password, email, expresion_usuario, expresion_password, expresion_email;
  var terminos;

  //----------------------expresiones regulares--------------------------------|
  //Expresión regular para permitir solo letras minúsculas, mayúsculas y números
  expresion_sin_c_esp = /^[a-zA-Z0-9]*$/;
  //Expresión regular para el email  texto@texto.texto
  expresion_email = /\w+@\w+\.+[a-z]/;
  // Asignación de los valores ingresados por el usuario para su validación
  usuario = document.querySelector("#usuarioRegistro").value;
  password = document.querySelector("#passwordRegistro").value;
  email = document.querySelector("#emailRegistro").value;
  terminos = document.querySelector("#terminos").checked;

  //Impresion de los valores en consola *** !!!!!!SOLO PARA PRUEBAS !!!!******
  console.log('usuario', usuario);
  console.log('password', password);
  console.log('email', email);

  //Si alguno de los campos está vacío manda un alert al usuario

  if(usuario === "" || password === "" || email === ""){
    alert("Todos los campos son requeridos");
    return false;
  }

  //***********************Evaluando al usuario******************************

  else if (usuario.length > 6 ) {     //Que tenga menos de 6 caracteres
    alert("Nombre de usuario demasiado largo");
    return false;
  }

  else if (!expresion_sin_c_esp.test(usuario)) {    //Que cumpla con la expresión regular "expresion_sin_c_esp"
    document.querySelector("label[for='usuarioRegistro']").innerHTML += "<br>El usuario debe contener solo letras y números";
    return false;
  }

  //********************Evaluando la contraseña******************************
  else if (password.length < 6) {
    document.querySelector("label[for='passwordRegistro']").innerHTML += "<br>La contraseña debe contener mínimo 6 caracteres";
    return false;
  }

  else if (!expresion_sin_c_esp.test(password)) {
    document.querySelector("label[for='passwordRegistro']").innerHTML += "<br>No se permiten caracteres especiales";
    return false;
  }

  //**********************Evaluando email ***********************************
  else if (!expresion_email.test(email)) {      //Que cumpla con la expresión regular "expresion_email"
    document.querySelector("label[for='passwordRegistro']").innerHTML += "<br>El formato del e-mail no es válido";
    return false;
  }

  //**********************Evaluacion del checkbox terminos***************************
  else if (!terminos) {
    document.querySelector("form").innerHTML += "</br>Para registrarse debe aceptar los términos y condiciones";
    //Para no borrar la información que había escrito el usuario
    document.querySelector("#usuarioRegistro").value = usuario;
    document.querySelector("#passwordRegistro").value = password;
    document.querySelector("#emailRegistro").value = email;
    return false;
  }

  return true;
}
