<?php
sesion_start()
if ($_SESSION["color"] == $_POST["resColor"]) {
    echo '<a href= "SIMON.php>Acertaste, nueva ronda"'
}
else {
       echo '<a href= "SIMON.php>Fallaste, nueva ronda"'
}

?>