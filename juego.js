$(document).ready(function () {

    $('#btnRe').attr("disabled", true);
    cargaJuego();
    
    function cargaJuego(){
        var action = 'logica';
        $.ajax({
            type: 'post',
            url: 'juego.php',
            data: {action},

            success: function(data){
                logica (data);
            },
            error: function(data){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
    }

    $('#btnRe').click(function(){
        // Capturamnos el boton de envío
        var btnEnviar = $("#btnEn");
        var aux = 1;

        $.ajax({
            type:'POST',
            url: 'juego.php',
            data: {aux}, 

            success: function(data){
                logica(data);
            },
            error: function(data){
                alert("Problemas al tratar de enviar el formulario");
            }
        });
        return false;//Para no recargar la pagina
    });
    
    
    $("#formulario").bind("submit",function(){
                
        $.ajax({
            type: $(this).attr("method"),
            url: $(this).attr("action"),
            data:$(this).serialize()+"&action=logica",

            success: function(data){
                logica(data);
                /* if (data['encontrado']==true){
                    console.log ("adadad");
                    document.getElementById ("respuesta").setAttribute("class","alert alert-success");
                }*/
            },
            error: function(data){
                /*
                * Se ejecuta si la peticón ha sido erronea
                * */
                alert("Problemas al tratar de enviar el formulario");
            }
        });

        return false;//Para no recargar la pagina
    });

    function logica( data ){
        var data = JSON.parse( data );
        
        if (data['encontrado']==true){
            $("#btnEn").attr("disabled", true);
            $('#btnRe').attr("disabled", false);
        }else{
            $("#btnEn").attr("disabled", false);
            $('#btnRe').attr("disabled", true);
        }
        console.log (data );
        $("#respuesta").html(data['alerta'] );
        $("#contador").html("Intentos: "+data['contador'] );
        $("#ultimo").html("Numero Digitado: "+data['digitado'] );
    }
});
