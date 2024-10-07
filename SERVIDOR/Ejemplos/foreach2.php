<?php
$mascotas = array(
$perro = array('Mastín' => 'Yunito',
                    'Salchicha' => 'Fuet',
                    'Chiguagua' => 'Sarnoso',
),  

$gato = array('Persa'=> 'MBAPPE',
'Comun'=> 'MESSI',
'Siames' =>'MODRIC'
    


)
);
foreach ($mascotas as $animal => $tipo){ 
echo $animal. ": <br>";
    foreach ($tipo as $raza => $nombre) {

      echo $raza." : ".$nombre. "<br>";
}
}   


?>