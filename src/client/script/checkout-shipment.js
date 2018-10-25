function checkShipping(){
  //shipment form validation
    //first name validation
    var fName = document.forms["shipForm"]["fName"];
    if(fName.value == ""){
      fName.className = 'invalid2';
      return false;
    }
    fName.addEventListener("change",function(){ fName.classList.remove('invalid2') });

    //last name validation
    var lName = document.forms["shipForm"]["lName"];
    if(lName.value == ""){
      lName.className = "invalid2";
      return false;
    }
    lName.addEventListener("change",function(){ lName.classList.remove("invalid2") });

    //country validation
    var country = document.forms["shipForm"]["country"];
    if(country.value == ""){
      country.className = "invalid2";
      return false;
    }
    country.addEventListener("change",function(){ country.classList.remove("invalid2") });

    //province confirmation
    var province = document.forms["shipForm"]["province"];
    if(province.value == ""){
      province.className = "invalid2";
      return false;
    }
    province.addEventListener("change",function(){ province.classList.remove("invalid2") });

    //town validation
    var town = document.forms["shipForm"]["town"];
    if(town.value == ""){
      town.className = "invalid2";
      return false;
    }
    town.addEventListener("change",function(){ town.classList.remove("invalid2") });

    //street validation
    var street = document.forms["shipForm"]["street"];
    if(street.value == ""){
      street.className = "invalid2";
      return false;
    }
    street.addEventListener("change",function(){ street.classList.remove("invalid2") });

    //postal code validation
    var postalCode = document.forms["shipForm"]["postalCode"];
    if(postalCode.value == ""){
      postalCode.className = "invalid2";
      return false;
    }
    postalCode.addEventListener("change",function(){ postalCode.classList.remove("invalid2") });

    //phone number validation
    var phoneNum = document.forms["shipForm"]["phoneNum"];
    if(phoneNum.value == ""){
      phoneNum.className = "invalid2";
      return false;
    }
    phoneNum.addEventListener("change",function(){ phoneNum.classList.remove("invalid2") });

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

    //Write javascript to make payment come up andshipment disappear
    //add hide class to payment
      //document.getElementById("shipment").classList.add("hide");
      //document.getElementById("payment").classList.remove("hide");

  }
