function checkPass(){
  //check if current pass is actually current pass database

  //password validation (6 characters and atleast is a number)
  var password = document.forms["changePassword"]["newPassword"];
  var hasNum = false;
  for(var i = 0; i < password.value.length; i++){
    var x = password.value.charAt(i);
    if(!isNaN(x)){
      hasNum = true;
      break;
    }
  }
  if(password.value.length < 6){
    alert("Password length must be atleast 6 characters!");
    return false;
  }else if(!contains){
    alert("Password must contain a number");
    return false;
  }

  //password confirmation
  var cPassword = document.forms["changePassword"]["cPassword"];
  if(password.value != cPassword.value){
    alert("Passwords do not match!");
    cPassword.value = "";
    return false;
  }
}
