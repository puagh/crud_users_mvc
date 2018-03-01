//
function validarCambio(){
  var usuario, password, email;
  usuario = document.querySelector("#usuarioEditar").value;
  password = document.querySelector("#passwordEditar").value;
  email = document.querySelector("#emailEditar").value;

  console.log('usuario', usuario);
  console.log('password', password);
  console.log('email', email);

  return true;
}
