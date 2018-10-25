function checkPayment(){
//payment form validation
  //Name on card validation
  var cardName = document.forms["payForm"]["cardName"];
  if(cardName.value == ""){
    cardName.className = 'invalid';
    return false;
  }
  cardName.addEventListener("change",function(){ cardName.classList.remove('invalid') });

  //card number validation
  var cardType = document.getElementById("payMethod").value;
  var cNumber = document.forms["payForm"]["cardNumber"];
  var firstNum = cNumber.value.charAt(0);

  var hasNonNum = false;
  for(var i = 0; i < cNumber.value.length; i++){
    var x = cNumber.value.charAt(0);
    if(isNaN(x)){
      hasNonNum = true;
      break;
    }
  }

  if(cNumber.value == ""){
    cNumber.className = 'invalid';
    return false;
  }else if( firstNum == 4 && cardType != "Visa"){
    alert("Card number and type do not match")
    return false;
  }else if( firstNum == 5 && cardType != "Mastercard"){
    alert("Card number and type do not match")
    return false;
  }else if( firstNum == 3 && cardType != "American Express"){
    alert("Card number and type do not match")
    return false;
  }else if(hasNonNum){
    alert("Card Number can only contain numbers")
    return false;
  }
  cNumber.addEventListener("change",function(){ cNumber.classList.remove('invalid') });

  //security code validation
  var secCode = document.forms["payForm"]["secCode"];
  if(secCode.value == ""){
    secCode.className = 'invalid';
    return false;
  }else if(secCode.value.length != 3){
    alert("Security code must have a length of 3");
    return false;
  }
  secCode.addEventListener("change",function(){ secCode.classList.remove('invalid') });
  //make sure they choose a date
}
