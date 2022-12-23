<?php
////////////////////////////////////////////////////////////////////////////////
//                    CONTROLADOR DE LA LISTA DE PELÍCULAS                    //
////////////////////////////////////////////////////////////////////////////////
include_once('./lib/clase_cliente_API.php');
include_once('./lib/utilidades.php');

$error = '';
if (empty($_GET) || !isset($_GET['p'])) {
    $error = "Dirección no válida.";
} else {
    $cliente = new clase_cliente_API();
    $cliente->setNombreServicioAPI('obtener_pelicula');
    
    $respuesta = json_decode($cliente->ejecutar(), true);
    
    if ( $respuesta['data']['resultado'] != "ok") {
        $error = 'No se ha podido conectar con la API';
    }
    
    $peliculas = $respuesta['data']['datos'];
}






////////////////////////////////////////////////////////////////////////////////
//                        VISTA DE LA LISTA DE PELÍCULAS                      //
////////////////////////////////////////////////////////////////////////////////
include_once('./layout/header.php'); 
?>
<main>

<div class="error"><?php echo $error ?><div>

<?php if ($error == '') { ?>
<table>
    <tr>
        <th></th>
        <th>Título</th>
        <th>Director</th>
        <th>Año</th>
        <th>País</th>
    </tr>

    <?php foreach($peliculas as $idPelicula => $datosPelicula) {
        $nombreImagen = nombreSeguro($datosPelicula['titulo']) . '.jpg';

        echo "<tr>";
        echo "<td><img src='/peliculas/cliente/imagenes/portadas/$nombreImagen'></td>";
        echo "<td>";
        echo "   <a href='/peliculas/cliente/pelicula.php?p=$datosPelicula[id]'>$datosPelicula[titulo]</a></td>";
        echo "<td>";
        echo "   <a href='/peliculas/cliente/director.php?d=$datosPelicula[iddirector]'>$datosPelicula[director]</a></td>";
        echo "<td>$datosPelicula[anio]</td>";
        echo "<td>$datosPelicula[pais]</td>";
        echo "</tr>";
    } ?>
</table>
<?php } ?>
</main>

<?php include_once('./layout/footer.php'); ?>