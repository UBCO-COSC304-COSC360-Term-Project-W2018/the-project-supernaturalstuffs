function checkLogin(){
  //email validation

  var eInput = document.forms["login"]["email"];
  if(eInput.value == ""){
    alert("Insert email")
    return false;
  }

  //password validation

  var pInput = document.forms["login"]["password"];
  if(pInput.value == ""){
    alert("Insert password")
    return false;
  }
}
