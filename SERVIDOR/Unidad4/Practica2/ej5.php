<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$email="abc@abc.com";
$emailErr="Email correcto";
if (empty($email)) {
 $emailErr = "Se requiere Email";
 } else {
 if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
 $emailErr = "Formato de Email invalido";
 }
 }
echo $email;
echo "<br>";
echo $emailErr;
?>

</body>
</html>