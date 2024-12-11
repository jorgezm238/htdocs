<?php
    /*
        Crea un array llamado deportes e introduce los siguientes valores: futbol,
        baloncesto, natación, tenis. Haz el recorrido de la matriz con un for para mostrar
        sus valores. A continuación realiza las siguientes operaciones
             Muestra el total de valores que contiene.
             Sitúa el puntero en el primer elemento del array y muestra el valor actual, es
            decir, donde está situado el puntero actualmente.
             Avanza una posición y muestra el valor actual.
             Coloca el puntero en la última posición y muestra su valor.
             Retrocede una posición y muestra este valor.
    */

    $deportes = array("futbol", "baloncesto", "natación", "tenis");

    echo "Contiene ".count($deportes)." valores <br>";

    reset($deportes);
    echo current($deportes)."<br>";

    next($deportes);
    echo current($deportes)."<br>";

    end($deportes);
    echo current($deportes)."<br>";

    prev($deportes);
    echo current($deportes)."<br>";



?>