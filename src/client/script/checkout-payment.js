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
  var cardName = document.forms["payForm"]["cardNumber"];
  if(cardName.value == ""){
    cardName.className = 'invalid';
    return false;
  }
  cardName.addEventListener("change",function(){ cardName.classList.remove('invalid') });

  //security code validation
  var cardName = document.forms["payForm"]["secCode"];
  if(cardName.value == ""){
    cardName.className = 'invalid';
    return false;
  }
  cardName.addEventListener("change",function(){ cardName.classList.remove('invalid') });

}
