<?php
////////////////////////////////////////////////////////////////////////////////
//                    CONTROLADOR DE LA LISTA DE PELÍCULAS                    //
////////////////////////////////////////////////////////////////////////////////
include_once('./lib/clase_cliente_API.php');
include_once('./lib/utilidades.php');

$error = '';
$pelicula = null;
$nombreImagen = '';

if (empty($_GET) || !isset($_GET['p'])) {
    $error = "Dirección no válida.";
} else {
    $cliente = new clase_cliente_API();
    $cliente->setNombreServicioAPI('obtener_pelicula');
    $cliente->setDatosJSON(['idpelicula' => $_GET['p']]);
    $respuesta = json_decode($cliente->ejecutar(), true);
    
    if ( $respuesta['data']['resultado'] != "ok") {
        $error = 'No se ha podido conectar con la API';
    } else {
        $pelicula = $respuesta['data']['datos'];
        $nombreImagen = nombreSeguro($pelicula['titulo']) . '.jpg';
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
            <img src="/peliculas/cliente/imagenes/portadas/<?php echo $nombreImagen ?>">
        </header>
        <section>
            <h2><?php echo $pelicula['titulo'] ?></h2>

            <section class="ficha-tecnica">
                <div>
                    <div>Director</div>
                    <div><a href="/peliculas/cliente/director.php?d=<?php echo $pelicula["iddirector"] ?>">
                        <?php echo $pelicula["director"] ?>
                    </a></div>
                </div>
                <div>
                    <div>Género</div>
                    <div><?php echo $pelicula["genero"] ?></div>
                </div>
                <div>
                    <div>Año</div>
                    <div><?php echo $pelicula["anio"] ?></div>
                </div>
            </section>

            
            <section class="reparto">
                <h3>Reparto</h3>
                <?php foreach ($pelicula['actores'] as $idactor => $datosActor) {
                    $actor = $datosActor['nombre'] . ' ' . $datosActor['apellidos'];
                    echo "<a class='actor' href='/peliculas/cliente/actor.php?a=$idactor'>$actor</a>";
                } ?>
            </section>

            
            <section class="sinopsis">
                <h3>Sinopsis</h3>
                <p><?php echo $pelicula['sinopsis']; ?></p>
            </section>
        </section>
    </article>
<?php } ?>
</main>

<?php include_once('./layout/footer.php'); ?>