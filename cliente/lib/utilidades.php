<?php

// Extraído de
// https://stackoverflow.com/a/6443862/17265684
function stripAccents($str){

    return strtr(utf8_decode($str), 
           utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 
                       'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
}
/**
 * Convierte a un nombre de fichero o url seguro un texto.
 * ej: La vida de Adèle:  la-vida-de-adele
 */
function nombreSeguro($titulo) {
    $titulo = stripAccents($titulo);
    return preg_replace("/[ ,]+/", "-", strtolower($titulo));
}