<?php
function pintar_circulos(array $colors){
        

        for ($i=0; $i <4 ; $i++) { 
            // Selección aleatoria de un color
            $randomColor[$i] = $colors[array_rand($colors)];
        ?>
            <div class="circle" style="background-color: <?php echo $randomColor[$i]; ?>;">
                <?php echo ucfirst($randomColor[$i]); /*Primera letra en mayuscula*/?> 
            </div>
        <?php 
        }
            // Guardar el array en una variable de sesión
            $_SESSION['colores_adivinar'] = $randomColor;
            $_SESSION['colores'] = $colors;
    }

?>  
