function calculation(){
    var first = parseInt(document.getElementById("first").value);
    var second = parseInt(document.getElementById("second").value);
    if (first >=0 && second>=0) {

      var multi = first * second ;
      var secondone = parseFloat(document.getElementById("percent").value);
          if (multi >0 || secondone>=0) {

            var roundup = (secondone/100)*multi + multi;
            var totalist = document.getElementById('total');
            totalist.value = roundup;
          }else{

            totalist.value = firstone ;
        
          }

    }else {
      document.getElementById('total').value = "Invalid input!!!";
    }
  }






function check(){
  
  

  if (totalist >0 || secondone>=0) {

    var totalist = document.getElementById('total');
    totalist.value = (secondone/100)*totalist + totalist ;

  }else{

    totalist.value = firstone ;

  }


  }

  
















  // function addup(){
  //   var first = parseInt(document.getElementById("pos").value);
  //   var second = parseInt(document.getElementById("cash").value);
  //   var third = parseInt(document.getElementById("trans").value);
  //   var fourth = parseInt(document.getElementById("exp").value);
  //   var fifth = parseInt(document.getElementById("others").value);
  //   var sixth = parseInt(document.getElementById("excess").value);

  //   if (first >=0 || second>=0 || third>=0 || fourth>=0 || fifth>=0 || sixth>=0) {

  //     var total = document.getElementById('total');
  //     total.value =  first+second+third+fourth+fifth+sixth;

  //     // return total.innerHTML = total ;

  //   }else {
  //     // document.getElementById('total').value = "";
  //   }
  // }

  function minus(){
    var amtdue = parseInt(document.getElementById('amtdue').value);
    var payamt = parseInt(document.getElementById('payamt').value);
    var rem = document.getElementById("rem");
    if (payamt > 0  ) {
      

      rem.value = (amtdue-payamt);
      
    }else{}
    

    

      
      

      // return total.innerHTML = total ;

    
  }