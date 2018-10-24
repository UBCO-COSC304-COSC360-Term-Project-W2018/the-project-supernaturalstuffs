function preventDefault(){
  //shipment form validation
    //first name validation
    var fName = document.forms["shipForm"]["fName"];
    if(fName.value == ""){
      fName.className = 'invalid';
      return false;
    }
    fName.addEventListener("change",function(){ fName.classList.remove('invalid') });

    //last name validation
    var lName = document.forms["shipForm"]["lName"];
    if(lName.value == ""){
      lName.className = "invalid";
      return false;
    }
    lName.addEventListener("change",function(){ lName.classList.remove("invalid") });

    //country validation
    var country = document.forms["shipForm"]["country"];
    if(country.value == ""){
      country.className = "invalid";
      return false;
    }
    country.addEventListener("change",function(){ country.classList.remove("invalid") });

    //province confirmation
    var province = document.forms["shipForm"]["province"];
    if(province.value == ""){
      province.className = "invalid";
      return false;
    }
    province.addEventListener("change",function(){ province.classList.remove("invalid") });

    //town validation
    var town = document.forms["shipForm"]["town"];
    if(town.value == ""){
      town.className = "invalid";
      return false;
    }
    town.addEventListener("change",function(){ town.classList.remove("invalid") });

    //street validation
    var street = document.forms["shipForm"]["street"];
    if(street.value == ""){
      street.className = "invalid";
      return false;
    }
    street.addEventListener("change",function(){ street.classList.remove("invalid") });

    //postal code validation
    var postalCode = document.forms["shipForm"]["postalCode"];
    if(postalCode.value == ""){
      postalCode.className = "invalid";
      return false;
    }
    postalCode.addEventListener("change",function(){ postalCode.classList.remove("invalid") });

    //phone number validation
    var phoneNum = document.forms["shipForm"]["phoneNum"];
    if(phoneNum.value == ""){
      phoneNum.className = "invalid";
      return false;
    }
    phoneNum.addEventListener("change",function(){ phoneNum.classList.remove("invalid") });

    //email validation
    //email validation(see if it has @)
    var email = document.forms["shipForm"]["email"];
    var hasAT = false;
    for(var i = 0; i < email.value.length; i++){
      var x = email.value.charAt(i);
      if(x == '@'){
        hasAT = true;
        break;
      }
    }
    if(!hasAT){
      alert("Invalid Email")
      return false;
    }

  //payment form validation
    //

}
