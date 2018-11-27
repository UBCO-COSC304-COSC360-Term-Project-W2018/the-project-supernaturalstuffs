function checkLogin(){
  //email validation
  var custEmail=true;

  var eInput = document.forms["login"]["email"];
  if(eInput.value == ""){
    alert("Insert email")
    return false;
  }else if(!custEmail){
    alert("This email is not registered create an account")
    return false;
  }

  //password validation
  var custPass=true;

  var pInput = document.forms["login"]["password"];
  if(pInput.value == ""){
    alert("Insert password")
    return false;
  }else if(!custPass){
    alert("This password does not match that email")
    return false;
  }
}
