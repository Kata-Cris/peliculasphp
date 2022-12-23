<?php
	$objBD = new clsBD;
	$objConfiguracion = new clsConfiguracion;
	$objUtilidades = new clsUtilidades;
	$objConsultaSQL = new clsConsultaSQL();

	if(defined('TOKEN_WEBSERVICE')){

		if(constant('TOKEN_WEBSERVICE')==$objConfiguracion->obtenerTokenWebservices()){	

			//Recogemos los parámetros que lleguen por POST (raw y form-data)
			$parametrosRecibidos = $objUtilidades->obtenerParametrosPOST();

			$objConsultaSQL->addCampoSelect('actores.id', 'idactor');
			$objConsultaSQL->addCampoSelect('actores.nombre', 'nombreactor');
			$objConsultaSQL->addCampoSelect('actores.apellidos', 'apellidosactor');
			$objConsultaSQL->addCampoSelect('peliculas.id', 'id');
			$objConsultaSQL->addCampoSelect('peliculas.titulo', 'titulo');
			$objConsultaSQL->addCampoSelect('peliculas.pais', 'pais');
			$objConsultaSQL->addCampoSelect('peliculas.anio', 'anio');

			$objConsultaSQL->addTablaFrom('actores'); 
			$objConsultaSQL->addTablaLeftJoin('actores_peliculas', 'actores.id = actores_peliculas.idactor');
			$objConsultaSQL->addTablaLeftJoin('peliculas', 'peliculas.id = actores_peliculas.idpelicula');
			$objConsultaSQL->addCondicionWhere('actores.id', '= ' . $parametrosRecibidos['idactor']);
			$objConsultaSQL->addCampoOrderBy('peliculas.anio', 'ASC');
			
			//DEBUG. SOLO DESCOMENTAR SI QUERÉIS VER LA CONSULTA QUE SE EJECUTA
			//AL DESCOMENTAR, NO EJECUTARÁ LA CONSULTA, SOLO LA MOSTRARÁ
		    //echo $objConsultaSQL->obtenerConsultaSQL();die();

			//EJECUTAMOS LA CONSULTA
			$resultado= $objBD->ejecutarConsulta($objConsultaSQL->obtenerConsultaSQL()); 

			//Comprobamos si el resultado contiene filas
			if (!$resultado) {
					$response['code'] = 0;				
				    $response['status'] = $api_response_code[0]['HTTP Response'];
			        $response['message'] = $api_response_code[0]['Message'];
			    	$response['numero_filas']=0;
					$response['data']=array(
			       	 		'resultado' => 'error_servidor_bd',
							'datos' => array()
			        );
			}
			else{
				//Si la consulta se ha podido ejecutar  			
				//Si no se devuelven filas
				if (mysqli_num_rows($resultado) == 0){
					$response['code'] = 1;				
				   	$response['status'] = $api_response_code[ $response['code'] ]['HTTP Response'];
					$response['message'] = $api_response_code[$response['code'] ]['Message'];
			    	$response['numero_filas']=0;
					$response['data']=array(
						'resultado' => 'sin_resultados',
						'datos' => array()
					);
				}
				else{
					//Si se devuelven filas
					$response['code'] = 1;				
				   	$response['status'] = $api_response_code[ $response['code'] ]['HTTP Response'];
					$response['message'] = $api_response_code[$response['code'] ]['Message'];
			    	$response['numero_filas']=mysqli_num_rows($resultado);

					$fila = mysqli_fetch_assoc($resultado);

					$datos = [
						"idactor" => $fila["idactor"],
						"nombreactor" => $fila["nombreactor"],
						"apellidosactor" => $fila["apellidosactor"],
						"peliculas" => [
							$fila['id'] => [
								"titulo" => $fila["titulo"],
								"anio" => $fila["anio"],
								"pais" => $fila["pais"]
							]
						]
					];

					$indice=1;
					while ($fila = mysqli_fetch_assoc($resultado)) {
						$datos['peliculas'][$fila['id']] = 
						[
							"titulo" => $fila["titulo"],
							"anio" => $fila["anio"],
							"pais" => $fila["pais"]
						];

						$indice++;					
					}

					$response['data']=array(
						'resultado' => 'ok',
						'datos' => $datos
					);
				}
			}
		}
  		else{
			echo _("Token incorrecto");
		}
    }
    else{
		echo _("Llamada no autorizada");
	}
?>