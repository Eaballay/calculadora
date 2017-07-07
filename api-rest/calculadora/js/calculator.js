
$( document ).ready(function() {
   $('.screen').prop('disabled', true);
    var values = "";
    var string ="";
    var result = "";
    var sessionCalculo ="";
    var lastClicked = "";
    $('.numbers').click(function() {
        var valueClicked = $(this).text();
        values += valueClicked  ;
        lastClicked = $(this);
        refreshScreen(values);
    });
    
    $('.clear').click(function() {
        clear();
    });
    
    $('.result').click(function() {
        if (values === ""){
            return;
        }
        
        $.post("http://localhost/api-rest/calculator", {'chain':values}, function(data){

                string = values + "="+ data; 
               
               
                 json = JSON.stringify(sessionCalculo);
;
                result = data;
                refreshScreen(result);
                lastClicked = "";
        });
    });
    
    $('.operator').click(function() {
         if ($(this).hasClass('operator') && lastClicked.hasClass('operator')){
            return;   
        }
        var valueClicked = $(this).text();
        lastClicked = $(this);
        values += valueClicked;
        refreshScreen(values);
    });
    
               
    $('.readsession').click(function(){
           $.post( "http://localhost/api-rest/getsession",{'--': $('.nameSessionread').val()}, function( data ) {
                

           var a = JSON.parse(data);
                for(var al=0 ; a.length>al; al++){
                 refreshScreen(a[al].result);
                }
    
});
});
    $('.session').click(function(){
        var nameSession = $('.nameSession').val();
       if (string !==""){
        $.post("http://localhost/api-rest/session",{'--':$('.nameSession').val()}, function(data){
            if (data[status] !== "success" ){
                        $.post("http://localhost/api-rest/result",{string}, function(data){
                         if (data[status] !== "success"){
                             alert ("Sesion-guardada");
                         }  
                         
                        });
            }
        });
           
       
    }else{
        alert ("No hay sesión de calculo para guardar");
    }
    });
    function clear(){
        values = "";
        lastClicked = "";
        refreshScreen(values);
    }
    
    function refreshScreen(val){
        $('.screen').val(val);
    }
});