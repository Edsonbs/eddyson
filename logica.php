<?php

// Comprobamos que se hayan rellenado los campos.
if ((isset($_POST["entradaNumero"]) && isset($_POST["divisa"]))) {
    $EQUIVALENCIA_MONETARIA = 166.386;
    $CANTIDAD_DECIMALES = 2;
    $SEPARADOR_DECIMALES = ",";
    $SEPARADOR_MILLARES = " ";
    $MSG_EURO = "Euros";
    $MSG_PESETA = "Pesetas";

    $cantidadConvertir = intval(htmlspecialchars($_POST["entradaNumero"]));
    $divisaConvertir = strval(htmlspecialchars($_POST["divisa"]));
    $divisaConvertida = $MSG_EURO;
    $cantidadResultante = 0;

    // Hacemos la conversión e indicamos la unidad a la que hemos convertido.
    if ($divisaConvertir == "euro") {
        $divisaConvertida = $MSG_PESETA;
        $cantidadResultante = number_format($cantidadConvertir*$EQUIVALENCIA_MONETARIA, $CANTIDAD_DECIMALES, $SEPARADOR_DECIMALES, $SEPARADOR_MILLARES);
        $divisaConvertir = $MSG_EURO;
    } else {
        $divisaConvertida = $MSG_EURO;
        $cantidadResultante = number_format($cantidadConvertir/$EQUIVALENCIA_MONETARIA, $CANTIDAD_DECIMALES, $SEPARADOR_DECIMALES, $SEPARADOR_MILLARES);
        $divisaConvertir = $MSG_PESETA;
    }

    // Ahora representamos el documento que mostrará el resultado de la operación solicitada.
    echo "
    <!DOCTYPE html>
    <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Conversor</title>
            <link rel='stylesheet' href='estilo.css'>
        </head>
        <body>
            <div id='contenedor'>
                <div id='contenedorMini'>
                    <div id='bloqueConversor'>
                        <h1>Conversor - resultado</h1>
                    </div>
                    <div id='bloqueInteractuar'>
                        <p>
                            " . $cantidadConvertir . " " . $divisaConvertir . " equivale a " . $cantidadResultante . " " . $divisaConvertida . "
                        </p>
                    </div>
                    <div id='bloqueBoton'>
                    </div>
                </div>
            </div>
        </body>
    </html>";

} else {
    echo "<p>No se han recibido datos.</p>";
}
?>