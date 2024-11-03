<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
      


    echo<<<_END
            <form action="resultadoYolanda.php" method="post">
        _END;
    
        echo<<<_END
        
            <label for="Dimension">Dimensión:</label>
            <input type="text" id="dimension" name="dimension" ><br>
            _END;
    
     echo<<<_END
        <input type="submit" value="Pintar">
     _END;
     echo"</form>";
     ?>
</body>
</html>