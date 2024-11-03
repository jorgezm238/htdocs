<?php
if  (isset($POST['name'])){
    $name = $POST['name']; 
}
else {
    $name = "(Not entered)";
}
echo<<<_END
<html>
<title>
Mi primer formularoiop
</title>
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