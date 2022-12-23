<?php
////////////////////////////////////////////////////////////////////////////////
//                    CONTROLADOR DE LA LISTA DE PELÍCULAS                    //
////////////////////////////////////////////////////////////////////////////////
include_once('./lib/clase_cliente_API.php');
include_once('./lib/utilidades.php');

$error = '';
$actor = null;
$nombreImagen = '';

if (empty($_GET) || !isset($_GET['a'])) {
    $error = "Dirección no válida.";
} else {
    $cliente = new clase_cliente_API();
    $cliente->setNombreServicioAPI('obtener_actor');
    $cliente->setDatosJSON(['idactor' => $_GET['a']]);
    $respuesta = json_decode($cliente->ejecutar(), true);
    
    if ( $respuesta['data']['resultado'] != "ok") {
        $error = 'No se ha podido conectar con la API';
    } else {
        $actor = $respuesta['data']['datos'];
    }
}



////////////////////////////////////////////////////////////////////////////////
//                        VISTA DE LA LISTA DE PELÍCULAS                      //
////////////////////////////////////////////////////////////////////////////////
include_once('./layout/header.php'); 
?>
<main>

<div class="error"><?php echo $error ?><div>

<?php if ($error == '') { ?>

    <article class="ficha-pelicula">
        <header>
            <div class="imagen-actor">SIN IMAGEN</div>
        </header>
        <section>
            <h2><?php echo $actor['nombreactor'] . ' ' . $actor['apellidosactor'] ?></h2>

            <section class="peliculas">
                <h3>Películas</h3>
                <table>
                <tr>
                    <th>Título</th>
                    <th>Año</th>
                    <th>País</th>
                </tr>

                <?php foreach($actor['peliculas'] as $idPelicula => $datosPelicula) {
                    echo "<tr><td>";
                    echo "   <a href='/peliculas/cliente/pelicula.php?p=$idPelicula'>$datosPelicula[titulo]</a></td>";
                    echo "<td>$datosPelicula[anio]</td>";
                    echo "<td>$datosPelicula[pais]</td>";
                    echo "</tr>";
                } ?>

            </table>
            </section>
        </section>
    </article>
<?php } ?>
</main>

<?php include_once('./layout/footer.php'); ?>