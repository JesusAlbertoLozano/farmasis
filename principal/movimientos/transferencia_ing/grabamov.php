<?php 
$sql1="SELECT * FROM movmov where invnum = '$codorigen'";
$result1 = mysqli_query($conexion,$sql1);
if (mysqli_num_rows($result1)){
	while ($row1 = mysqli_fetch_array($result1)){
		$qtypro         = $row1["qtypro"];		//codigo
		$qtyprf         = $row1["qtyprf"];		
		$pripro         = $row1["pripro"];		
		$costre         = $row1["costre"];
		$codpro         = $row1['codpro'];	
		$sql2="SELECT invnum FROM tempmovmov where invnum = '$invnum' and codpro = '$codpro' and qtypro = '$qtypro' and qtyprf = '$qtyprf' and pripro = '$pripro' and costre = '$costre' and invnumrecib = '$invnumrecib' and costpr = '$pripro'";
		$result2 = mysqli_query($conexion,$sql2);
		if (mysqli_num_rows($result2)){
			while ($row2 = mysqli_fetch_array($result2)){
			}
		}
		else
		{
			$sql1 = "INSERT INTO tempmovmov (invnum,codpro,qtypro,qtyprf,pripro,costre,costpr,invnumrecib) values ('$invnum','$codpro','$qtypro','$qtyprf','$pripro','$costre','$pripro','$invnumrecib')";
			mysqli_query($conexion,$sql1);
			if (mysqli_errno($conexion))
				error_log("Agrega Linea Temp SQL(".$sql1.")\nError(".mysqli_error($conexion).")");
		}
	}	
}
?>