<?php
	include ('conexion.php');	
	$consulta ="SELECT * FROM usuario WHERE logusu='".$_POST['user']."' and pasusu='".$_POST['text']."' and estado = '1'";
	echo("<br>IMPRIMIMOS consulta:");
	echo($consulta);
	$usuarios=mysqli_query($conexion, $consulta);
	$user_ok = mysqli_fetch_array($usuarios);
	echo("<br>IMPRIMIMOS EL user_ok:");
	print_r($user_ok);
	if(!empty($user_ok))  //si existe comenzamos con la sesion, si no, al index
	{
			//SI EXISTE EN LA DATA INGRESA A ESTE CODIGO
			if (($user_ok["estado"])=="0"){
				header("Location: index.php?error=3"); //el codigo no esta activado
			}
			else {
				echo("LE ASIGNA AL codigo_user");
				//damos valores a las variables de la sesi�n
				$_SESSION['codigo_user']		= $user_ok['usecod']; 
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
				$existe = 1;
				print_r($nomgrup);
				if ($nomgrup == "ADMINISTRADOR DEL SISTEMA")
				{
					//mysqli_query($conexion,"UPDATE usuario set codloc = '$local' where usecod = '$usuario'");
					print("<br>session_status :");
					print(session_status());
					url= "index.php?id=".base64_encode($_SESSION['codigo_user']);
					echo("Location: ".url);
					//header("Location: ".url);
				}
				else
				{
					if ($existe == 1)
					{
						//mysqli_query($conexion,"UPDATE usuario set codloc = '$local' where usecod = '$usuario'");
						if ($nomgrup == "VENDEDOR")
						{
						header("Location: principal/movimientos/ventas/ventas_registro.php");
						}
						else
						{
						header("Location: principal/index.php");
						}	
					}
					else
					{
						header("Location: index.php?error=4");
					}
				}
			}
	}
	else
	{
		header("Location: index.php?error=2"); //no se encuentra en el sist
	}
/*}
else
{
header("Location: index.php?error=4");
}*/
?>