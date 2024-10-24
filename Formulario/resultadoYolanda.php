<?php   
    $numeroDimensiones=$_POST['dimension'];
    $matriz = array();
    echo '<form action="calcularDiagonal.php" method="post">';
    for ($i=0; $i < $numeroDimensiones ; $i++) { 
        echo "<br>";
        for ($j=0; $j < $numeroDimensiones ; $j++) { 
            echo<<<_END
        
            <label for="nombre">($i,$j):</label>
            <input type="text" id="$i,$j" name="$i,$j" >
            _END;


            
        }
    }
   echo"<br>";
   echo' <input type="submit" name="submit" value="Calcular diagonal">';
   

   echo"</form>";

?>