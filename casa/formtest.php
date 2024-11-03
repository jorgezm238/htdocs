<?php
if  (isset($_POST['name']))
    $name = $_POST['name']; 

else 
    $name = "(Not entered)";

echo<<<_END

<html>
<head>
<title>
Mi primer formularoiop
</title>
</head>
<body>
Tu nombre es: $name<br>
<form method="post" action="formtest2.php"> 
Cual es tu nombre
<input type ="text" name="name">
<input type ="submit">


</form>
</body>
</html>



_END;



?>