<?php
//session_set_cookie_params(0);
//session_start();
include ('conexion.php');	
//include ('detecta_ip.php');
//$ip		= $detect_ip;
/*$sql="SELECT codloc FROM numberip where ip = '$ip'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
	$local    = $row['codloc'];
}
*/
	$consulta ="SELECT * FROM usuario WHERE logusu='".$_POST['user']."' and pasusu='".$_POST['text']."' and estado = '1'";
	echo("<br>IMPRIMIMOS consulta:");
	echo($consulta);
	$usuarios=mysqli_query($conexion, $consulta);
	
	//echo "Usuarios:" . $usuarios . "<p>";
	//die();
	$user_ok = mysqli_fetch_array($usuarios);
	echo("<br>IMPRIMIMOS EL user_ok:");
	print_r($user_ok);
	if(!empty($user_ok))  //si existe comenzamos con la sesion, si no, al index
	{
			//SI EXISTE EN LA DATA INGRESA A ESTE CODIGO
			if (($user_ok["estado"])=="0"){
				echo("revisa 1");//header("Location: index.php?error=3"); //el codigo no esta activado
			}
			else {
				echo("LE ASIGNA AL codigo_user");
				//damos valores a las variables de la sesi�n
				$_SESSION['codigo_user']			= $user_ok['usecod']; 
				$usuario						= $user_ok['usecod']; 
				$codgrup						= $user_ok['codgrup'];  
				$codloc  						= $user_ok['codloc'];  
				$sql="SELECT nomgrup FROM grupo_user where codgrup = '".$codgrup."'";
				$result = mysqli_query($conexion, $sql);
				if (mysqli_num_rows($result)){
					while ($row = mysqli_fetch_array($result)){
							$nomgrup          = $row['nomgrup'];
					}
				} 
				//$sql="SELECT codloc FROM numberip where ip = '$ip' and codloc = '$codloc'";
				//$result = mysqli_query($conexion,$sql);
				//if (mysqli_num_rows($result)){
				$existe = 1;
				//}
				//else
				//{
				//$existe = 0;
				//}
				print_r($nomgrup);
				if ($nomgrup == "ADMINISTRADOR DEL SISTEMA")
				{
					//mysqli_query($conexion,"UPDATE usuario set codloc = '$local' where usecod = '$usuario'");
					echo("revisa 2");//header("Location: principal/index.php");
				}
				else
				{
					if ($existe == 1)
					{
						//mysqli_query($conexion,"UPDATE usuario set codloc = '$local' where usecod = '$usuario'");
						if ($nomgrup == "VENDEDOR")
						{
						echo("revisa 3");//header("Location: principal/movimientos/ventas/ventas_registro.php");
						}
						else
						{
						echo("revisa 4");//header("Location: principal/index.php");
						}	
					}
					else
					{
						echo("revisa 5");//header("Location: index.php?error=4");
					}
				}
			}
	}
	else
	{
		echo("revisa 6");//header("Location: index.php?error=2"); //no se encuentra en el sist
	}
/*}
else
{
echo("revisa 7");//header("Location: index.php?error=4");
}*/
?>