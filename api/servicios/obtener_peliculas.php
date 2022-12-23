<?php

$objBD = new clsBD;
$objConfiguracion = new clsConfiguracion;
$objUtilidades = new clsUtilidades;
$objConsultaSQL = new clsConsultaSQL();

if (defined('TOKEN_WEBSERVICE')) {

	if (constant('TOKEN_WEBSERVICE') == $objConfiguracion->obtenerTokenWebservices()) {

		$parametrosRecibidos = $objUtilidades->obtenerParametrosPOST();

		// Título, Año, director y país.
		$objConsultaSQL->addCampoSelect('peliculas.id', 'id');
		$objConsultaSQL->addCampoSelect('peliculas.titulo', 'titulo');
		$objConsultaSQL->addCampoSelect('peliculas.pais', 'pais');
		$objConsultaSQL->addCampoSelect('peliculas.anio', 'anio');
		$objConsultaSQL->addCampoSelect('directores.id', 'iddirector');
		$objConsultaSQL->addCampoSelect('directores.nombre', 'nombredirector');
		$objConsultaSQL->addCampoSelect('directores.apellidos', 'apellidosdirector');
		$objConsultaSQL->addCampoSelect('actores.id', 'idactor');
		$objConsultaSQL->addCampoSelect('actores.nombre', 'nombreactor');
		$objConsultaSQL->addCampoSelect('actores.apellidos', 'apellidosactor');
		$objConsultaSQL->addTablaFrom('peliculas');
		$objConsultaSQL->addTablaLeftJoin('directores', 'directores.id = peliculas.director');
		$objConsultaSQL->addTablaLeftJoin('actores_peliculas', 'actores_peliculas.idpelicula = peliculas.id');
		$objConsultaSQL->addTablaLeftJoin('actores', 'actores.id = actores_peliculas.idactor');


		// Filtros
		if (isset($parametrosRecibidos['anio-inicio'])) {
			$anio = $parametrosRecibidos['anio-inicio'];
			$objConsultaSQL->addCondicionWhere('anio', ">= $anio", "AND");
		}

		if (isset($parametrosRecibidos['anio-fin'])) {
			$anio = $parametrosRecibidos['anio-fin'];
			$objConsultaSQL->addCondicionWhere('anio', "<= $anio", "AND");
		}

		if (isset($parametrosRecibidos['titulo'])){
			if (strlen($parametrosRecibidos['titulo']) > 0) {
				$objConsultaSQL->addCondicionWhere('titulo', "LIKE '%$parametrosRecibidos[titulo]%'", "AND");
			}
		}

		if (isset($parametrosRecibidos['director'])){
			if (strlen($parametrosRecibidos['director']) > 0) {
				$objConsultaSQL->addCondicionWhere('CONCAT(directores.nombre, " ", directores.apellidos) ', "LIKE '%$parametrosRecibidos[director]%'", "AND");
			}
		}

		if (isset($parametrosRecibidos['genero'])){
			if (strlen($parametrosRecibidos['genero']) > 0) {
				$objConsultaSQL->addCondicionWhere('genero', "LIKE '%$parametrosRecibidos[genero]%'", "AND");
			}
		}

		if (isset($parametrosRecibidos['actor'])){
			if (strlen($parametrosRecibidos['actor']) > 0) {
				$objConsultaSQL->addCondicionWhere('CONCAT(actores.nombre, " ", actores.apellidos)', "LIKE '%$parametrosRecibidos[actor]%'", "AND");
			}
		}




		//DEBUG. SOLO DESCOMENTAR SI QUERÉIS VER LA CONSULTA QUE SE EJECUTA
		//AL DESCOMENTAR, NO EJECUTARÁ LA CONSULTA, SOLO LA MOSTRARÁ
		// echo $objConsultaSQL->obtenerConsultaSQL(); die();

		//EJECUTAMOS LA CONSULTA
		$resultado = $objBD->ejecutarConsulta($objConsultaSQL->obtenerConsultaSQL());

		//Comprobamos si el resultado contiene filas
		if (!$resultado) {
			$response['code'] = 0;
			$response['status'] = $api_response_code[0]['HTTP Response'];
			$response['message'] = $api_response_code[0]['Message'];
			$response['numero_filas'] = 0;
			$response['data'] = array(
				'resultado' => 'error_servidor_bd',
				'datos' => array()
			);
		} else {
			//Si la consulta se ha podido ejecutar  			
			//Si no se devuelven filas
			if (mysqli_num_rows($resultado) == 0) {
				$response['code'] = 1;
				$response['status'] = $api_response_code[$response['code']]['HTTP Response'];
				$response['message'] = $api_response_code[$response['code']]['Message'];
				$response['numero_filas'] = 0;
				$response['data'] = array(
					'resultado' => 'sin_resultados',
					'datos' => array()
				);
			} else {
				//Si se devuelven filas
				$response['code'] = 1;
				$response['status'] = $api_response_code[$response['code']]['HTTP Response'];
				$response['message'] = $api_response_code[$response['code']]['Message'];


				$datos = [];

				while ($fila = mysqli_fetch_assoc($resultado)) {
					$id = $fila["id"];

					if (key_exists($id, $datos)) {
						$datos[$id]['actores'][$fila['idactor']] = [
							"nombre" => $fila['nombreactor'],
							"apellidos" => $fila['apellidosactor']
						];
					} else {
						$datos[$id] =
							array(
								"id" => $fila["id"],
								"titulo" => $fila["titulo"],
								"anio" => $fila["anio"],
								"pais" => $fila["pais"],
								"iddirector" => $fila["iddirector"],
								"director" => $fila["nombredirector"] . " " . $fila["apellidosdirector"],
								"actores" => [
									$fila['idactor'] => [
										"nombre" => $fila['nombreactor'],
										"apellidos" => $fila['apellidosactor']
									]
								],
							);
					}
				}

				$response['numero_filas'] = count($datos);
				$response['data'] = array(
					'resultado' => 'ok',
					'datos' => $datos
				);
			}
		}
	} else {
		echo _("Token incorrecto");
	}
} else {
	echo _("Llamada no autorizada");
}
