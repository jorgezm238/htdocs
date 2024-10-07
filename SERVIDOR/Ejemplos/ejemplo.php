<?php // test1.php
function create2dArrayNames(){
$names = ["personas" => [
    "nombre" => "Yolanda", "apellidos" => "Perez", "edad" => 18
    ]
];
return create2dArrayNames() + $names;
}
?>