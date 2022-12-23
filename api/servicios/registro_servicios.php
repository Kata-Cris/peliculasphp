<?php
    switch ($servicio) {
        //================================================     
        //CONSULTAS
        //================================================    
        case 'obtener_peliculas':
            include_once('servicios/obtener_peliculas.php');
            break;

        case 'obtener_pelicula':
            include_once('servicios/obtener_pelicula.php');
            break;

        case 'obtener_director':
            include_once('servicios/obtener_director.php');
            break;

        case 'obtener_actor':
            include_once('servicios/obtener_actor.php');
            break; 
        default:
            $response['code'] = 5;
            $response['status'] = $api_response_code[ $response['code'] ]['HTTP Response'];
            $response['data'] = $api_response_code[$response['code']]['Message'];
            break;
        }
