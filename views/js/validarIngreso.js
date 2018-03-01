////Función que valida los campos requeridos en el formulario de ingreso
function validarIngreso(){
  var usuario, password;
  usuario = document.querySelector("#usuarioInicio").value;
  password = document.querySelector("#passwordInicio").value;

  //----------------------expresiones regulares--------------------------------|
  //Expresión regular para permitir solo letras minúsculas, mayúsculas y números
  expresion_sin_c_esp = /^[a-zA-Z0-9]*$/;
  //Expresión regular para el email  texto@texto.texto
  expresion_email = /\w+@\w+\.+[a-z]/;


  //validando que ambos campos estén llenos de información
  if(usuario === "" || password === ""){
    alert("Es necesario ingresar usuario y contraseña");
    return false;
  }

  //Validando al usuario ingresado
  if(usuario.length > 6){
    document.querySelector("label[for='usuarioInicio']").innerHTML += "</br>La cantidad de caracteres en el usuario es incorrecta";
    return false;
  }

  if (!expresion_sin_c_esp.test(usuario)) {      //Que cumpla con la expresión regular "expresion_sin_c_esp"
    document.querySelector("label[for='usuarioInicio']").innerHTML += "</br>Por favor no ingrese caracteres especiales";
    return false;
  }

  //Validando la contraseña ingresada
  if (password.length < 6) {
    document.querySelector("label[for='passwordInicio']").innerHTML += "</br>La cantidad de caracteres en la contraseña es incorrecta";
    return false;
  }

  if(!expresion_sin_c_esp.test(password)){
    document.querySelector("label[for='passwordInicio']").innerHTML += "</br>Por favor no ingrese caracteres especiales";
    return false;
  }




  return true;
}
