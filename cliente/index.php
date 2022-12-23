<?php
////////////////////////////////////////////////////////////////////////////////
//                    CONTROLADOR DE LA LISTA DE PELÍCULAS                    //
////////////////////////////////////////////////////////////////////////////////
include_once('./lib/clase_cliente_API.php');
include_once('./lib/utilidades.php');

$error = '';
$cliente = new clase_cliente_API();
$cliente->setNombreServicioAPI('obtener_peliculas');



// BÚSQUEDA
$titulo = '';
$actor = '';
$director = '';
$genero = '';
$anioInicio = '';
$anioFin = '';

if (!empty($_POST)) {
    $titulo = $_POST['titulo'];
    $actor = $_POST['actor'];
    $director = $_POST['director'];
    $genero = $_POST['genero'];
    $anioInicio = $_POST['anio-inicio'];
    $anioFin = $_POST['anio-fin'];

    foreach ($_POST as $key => $value) {
        if (trim($value) == '') {
            unset($_POST[$key]);
        }
    }
    $cliente->setDatosJSON($_POST);
}

$respuesta = json_decode($cliente->ejecutar(), true);

if ( $respuesta['data']['resultado'] != "ok") {
    $error = 'Sin resultados';
}

$peliculas = $respuesta['data']['datos'];


////////////////////////////////////////////////////////////////////////////////
//                        VISTA DE LA LISTA DE PELÍCULAS                      //
////////////////////////////////////////////////////////////////////////////////
include_once('./layout/header.php'); 
?>
<main>


<div class="wrapper">
    <form action="" method="POST">
        <label for="titulo">Título: </label>
        <input id="titulo" name="titulo" type="text" value="<?=$titulo?>">

        <label for="director">Nombre o apellido del director/a: </label>
        <input id="director" name="director" type="text" value="<?=$director?>">

        <label for="actor">Nombre o apellido actor/actriz: </label>
        <input id="actor" name="actor" type="text" value="<?=$actor?>">

        <label for="genero">Género: </label>
        <input id="genero" name="genero" type="text" value="<?=$genero?>">

        <label for="anio-inicio">Desde el año: </label>
        <input id="anio-inicio" name="anio-inicio" type="number" 
                value="<?=$anioInicio?>">

        <label for="anio-fin">Hasta el año: </label>
        <input id="anio-fin" name="anio-fin" type="number" 
               value="<?=$anioFin?>">

        <input type="submit" value="Buscar">
        <input type="reset" value="Limpiar búsqueda">
    </form>

    <table>
        <?php if ($error != "") { ?>
        <tr>
            <td colspan="5">
                <div class="error"><?php echo $error ?><div>
            </td>
        </tr>
        <?php } else { ?>
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
        }}?>

    </table>
</div>



</main>

<?php include_once('./layout/footer.php'); ?>