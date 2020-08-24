<?php

    session_start();

    $alerta = 'Encuentra el numero!';
    $arreglo = array();
    $arreglo['encontrado'] = false;
    $contador=0;

    if (!isset($_SESSION['aleatorio'])){
        srand( time() );
        #devuelve un numero entre el 1 y el 100
        $_SESSION['aleatorio'] = rand( 1, 100 );
        $_SESSION['contador'] = $contador;
    }

    if ( isset ($_POST['aux']) && $_POST['aux']==1){
        $arreglo['bloquea'] = false;
        $arreglo['alerta'] = $alerta;
        $arreglo['contador'] = $contador;
        echo json_encode ($arreglo);
    }

    //Verifica si hay una accion llamada logica
    if( isset ($_POST['action']) && $_POST['action']=='logica' ){
        
        $contador = $_SESSION['contador'];
        
        //Verifica si los campos no estan vacios
        if ( isset ($_POST['txtNumero'] ) && $_POST['txtNumero'] != ''){
            
            //Numero leido del teclado
            $numero = $_POST['txtNumero'];  

            if ($numero <= $_SESSION['aleatorio'] ){
                if ($numero == $_SESSION['aleatorio'] ){

                    $alerta = "!Felicidades Numero encontrado es: ".$numero."!";
                    $contador = $_SESSION['contador'];
                    $arreglo['encontrado'] = true;
                    unset( $_SESSION["contador"] ); 
                    unset( $_SESSION["aleatorio"] );
                }else{
                    $alerta = $numero." Numero debe ser mayor";
                    $_SESSION['contador'] += 1;
                    $contador = $_SESSION['contador'];
                }
            }else{
                $_SESSION['contador'] += 1;
                $contador = $_SESSION['contador'];
                $alerta = $numero." Numero debe ser menor";
            }
        }else
            $arreglo['vacio'] = true;
        
        $arreglo['alerta'] = $alerta;
        $arreglo['contador'] = $contador;
        
        echo json_encode ($arreglo);
    }
        
?>
 