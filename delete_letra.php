<?php /*
$cadena = "Estos serian....... algunos numeros 12345, texto y simbolos !£$%^&";
$nueva_cadena = ereg_replace("[.]", "", $cadena);
echo $nueva_cadena;
*/
$cadena = "hola que tal";
$caracter = ".";
if (strpos($cadena, $caracter) !== false) 
{
echo "Lo contiene";
}
else
{
echo "No lo contiene";
}
?>