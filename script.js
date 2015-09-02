// JavaScript Document

var hora = 60;
var minuto = 1;
var horaCheia = 100;
var save = [0,1,2];
var tempoEmpty = true;

function calculaMinutos(){
  
  var minutos = document.getElementById("intInput");
  
  var result = parseInt(minutos.value);
  
  var calculo = (result/hora)*10;
  
  var resultSt = (calculo/10).toFixed(2).toString();

  var result = "";
  
  var final = result+= resultSt;
  
  if(isNaN(minutos.value)){
    alert(minutos.value);
  }
  else{
    document.getElementById('res').innerHTML = final;  
  }
}

function calculaHoras(){
  
  var horas = document.getElementById("intInput");
  var result = parseInt(horas.value);
  var calculo = (result*60)/10;
  var resultSt = (calculo*10).toFixed(2).toString();
  var result = "";
  
  var final = result += resultSt;
  
  if(isNaN(horas.value)){
    alert('digite um numero');
  }
  else{
    document.getElementById('res').innerHTML = final;  
  }
}



function total(){
  
  var result =  document.getElementById("intInput");
  var divide = result.value.split(':');
  
  var horas = parseInt(divide[0]);
  var minutos = parseInt(divide[1]);
  
  /*
  var calcMinutos = Math.round(((minutos/60)*100));
  if(calcMinutos.toString().length == 1){
    calcMinutos = '0'+calcMinutos;
  }
  
  */
  var calcHoras = horas*60;
  var totaliza = (calcHoras+minutos).toString();

  if(isNaN(divide[0]) || isNaN(divide[1]) ){
    alert('digite um numero');
  }
  else{
    document.getElementById('res').innerHTML = totaliza;  
  }
  
}

var checkedValue = null; 


function calcula(){
  var inputElements = document.getElementsByClassName('radio');
  for(var i=0; inputElements[i]; ++i){
    if(inputElements[i].checked){
       checkedValue = inputElements[i].value;
       break;
    }
  }

  if(checkedValue == 'minutos'){
    calculaMinutos();
  }
  else{
    calculaHoras();
  }
}





/*
function checkTime(i) {
    if (i<10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}


function gravaTemp(){
    var today=new Date();
    var h=today.getHours();
    var m=today.getMinutes();
    var s=today.getSeconds();
    save = [h,m,s];
    
}

function loadTemp(){
    var today=new Date();
    var h=today.getHours();
    var m=today.getMinutes();
    var s=today.getSeconds();
    
    var hora = h-save[0];
    var minuto = m-save[1];
    var segundo = s-save[2];
    
    minuto = checkTime(minuto);
    segundo = checkTime(segundo);
    document.getElementById('tempoNumero').innerHTML = hora+":"+minuto+":"+segundo;
    
    var t = setTimeout(function(){loadTemp()},500);
}

function tempo(){
  if(tempoEmpty){
    gravaTemp();
    loadTemp();
    tempoEmpty = false;
  }else{
    document.getElementById('tempoNumero').innerHTML = "";
    
    tempoEmpty = true;
  }
}*/