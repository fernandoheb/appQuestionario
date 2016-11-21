/* Fernando R. H. Andade 10/07/2016 (MM/DD/yyyy)-  Based on (Niederauer,2007 - Web Interativa com Ajax e PHP)*/

var ajax;
var dadoUsuario;
//-- cria objeto e faz a requisição --/
function requisicaoHTTP(tipo,url,assinc){
    if(window.XMLHttpRequest){ // Mozila, safari...
        ajax = new XMLHttpRequest();
    } 
    else if (window.ActiveXObject){ // IE
        ajax = new ActiveXObject("Msxml2.XMLHTTP");
        if (!ajax) {
            ajax = ActiveXObject("Microsoft.XMLHTTP");            
        }
    }
    if(ajax) // iniciou com sucesso
        iniciaRequisicao(tipo,url,assinc);
    else
        alert("Seu navegador não possui suporte a essa aplicação");   
}

//-- Inicializa o objeto criado e envia dados (se existirem)--//
function iniciaRequisicao(tipo,url,bool){
    ajax.onreadystatechange=trataResposta();
    ajax.open(tipo,url,bool);
    ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded;charset=UTF-8");
    //ajax.overrideMimeType("text/XML"); //usado somente no mozila
    ajax.send(dadosUsuario);
}
//-- I nicia requisição com envio de dados--//
function enviaDados(url,formName){
    criaQueryString(formName);
    requisicaoHTTP("POST",url,true);
}

//-- Cria a String a ser enviada, formato campo1=valor&campo2=valor2--//
function criaQueryString(){
    dadosUsuario = "";    
    var frm = document.forms[0];
    if (arguments[0]){
        frm = document.getElementById(arguments[0]);
    }
    var numElementos = frm.elements.length;
    for(var i = 0; i < numElementos; i++){
        if(i < numElementos-1){
            if(frm.elements[i].type =="radio") {
                if (frm.elements[i].checked){
                    dadoUsuario += frm.elements[i].name+"=" +
                    encodedURIComponent(frm.elements[i].value)+"&";  
                }                          
            } else {
                dadoUsuario += frm.elements[i].name+"=" +
                    encodedURIComponent(frm.elements[i].value)+"&";  }          
        } else {
            if(frm.elements[i].type =="radio") {
                if (frm.elements[i].checked){
                    dadoUsuario += frm.elements[i].name+"=" +
                    encodedURIComponent(frm.elements[i].value);  
                }                          
            } else {
                dadoUsuario += frm.elements[i].name+"=" +
                    encodedURIComponent(frm.elements[i].value);  
            }          
        }
    }    
}

//--Trata a resposta do Servidor--//

function trataResposta(){
    if(ajax.readyState == 4) {
        if (ajax.status = 400) {
            tratadados();
        } else {
            alert("Problema na comunicação com o objeto XMLHttpRequest.");
        }
    }   
}
