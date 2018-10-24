function preventDefault(){
    //first name validation
    var fName = document.forms["createAccount"]["fName"];
    if(fName.value == ""){
      fName.className = 'invalid';
      return false;
    }
    fName.addEventListener("change",function(){ fName.classList.remove('invalid') });

    //last name validation
    var lName = document.forms["createAccount"]["lName"];
    if(lName.value == ""){
      lName.className = "invalid";
      return false;
    }
    lName.addEventListener("change",function(){ lName.classList.remove("invalid") });

    //email validation
    var email = document.forms["createAccount"]["email"];
    if(email.value == ""){
      email.className = "invalid";
      return false;
    }
    email.addEventListener("change",function(){ email.classList.remove("invalid") });

    //email confirmation
    var cEmail = document.forms["createAccount"]["cEmail"];
    if(email.value != cEmail.value){
      alert("Emails do not match!");
      return false;
    }

    //password validation
    var password = document.forms["createAccount"]["password"];
    var contains = false;
    for(var i = 0; i < password.value.length; i++){
      var x = password.value.charAt(i);
      if(!isNaN(x)){
        contains = true;
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
    var cPassword = document.forms["createAccount"]["cPassword"];
    if(password.value != cPassword.value){
      alert("Passwords do not match!");
      cPassword.value = "";
      return false;
    }
}
