<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "biblioteca");
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('America/Buenos_Aires');

function actual_time()
{
    $hoy = getdate();
    $meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];

    $minuto = $hoy['minutes'];
    $hora = $hoy['hours'];
    $day = $hoy['mday'];
    $mes = $hoy['mon'];
    $segundos = $hoy['seconds'];

    if ($hoy['hours'] <= 9) {
        $hora = "0" . $hoy['hours'];
    }

    if ($hoy['minutes'] <= 9) {
        $minuto = "0" . $hoy['minutes'];
    }

    if ($hoy['mon'] <= 9) {
        $mes = "0" . $hoy['mon'];
    }

    if ($hoy['mday'] <= 9) {
        $day = "0" . $hoy['mday'];
    }

    if ($hoy['seconds'] <= 9) {
        $segundos = "0" . $hoy['seconds'];
    }

    $fecha_total_actual = $hoy['year'] . "-" . $mes . "-" . $day . " " . $hora . ":" . $minuto . ":" . $segundos;

    return $fecha_total_actual;
}
