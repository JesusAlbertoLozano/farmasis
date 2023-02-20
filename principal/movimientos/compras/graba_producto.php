<?php include('../../session_user.php');
require_once ('../../../conexion.php');
$btn	    = isset($_REQUEST['btn']) ? ($_REQUEST['btn']) : "";
$paginas	= isset($_REQUEST['pageno']) ? ($_REQUEST['pageno']) : "";
$sql1="SELECT codloc FROM usuario where usecod = '$usuario'";
$result1 = mysqli_query($conexion,$sql1);
if (mysqli_num_rows($result1)){
while ($row1 = mysqli_fetch_array($result1)){
		$codloc  = $row1['codloc'];
}
}
function quitar($mensaje)
{
					$mensaje = str_replace("<","&lt;",$mensaje);
					$mensaje = str_replace(">","&gt;",$mensaje);
					$mensaje = str_replace("\'","&#39;",$mensaje);
					$mensaje = str_replace('\"',"&quot;",$mensaje);
					$mensaje = str_replace("\\\\","&#92;",$mensaje);
					return $mensaje;
}
if (isset($_REQUEST['ext']) ? ($_REQUEST['ext']) : "")
{
	header("Location: mov_prod.php?pageno=$paginas");
}
if ($btn == 4)
{
/////GARABA O MODIFICA DATOS
        //$hour   = date('G')-5;
	$date	= date('Y-m-d');
        //$date	= CalculaFechaHora($hour);
	$des	= isset($_REQUEST['des']) ? ($_REQUEST['des']) : "";  
	$factor	= isset($_REQUEST['factor']) ? ($_REQUEST['factor']) : "";	
	$blister= isset($_REQUEST['blister']) ? ($_REQUEST['blister']) : "";
	$moneda	= isset($_REQUEST['moneda']) ? ($_REQUEST['moneda']) : "";
	$val 	= isset($_REQUEST['val']) ? ($_REQUEST['val']) : "";
	$img	= isset($_REQUEST['img']) ? ($_REQUEST['img']) : "";
	$directorio = "imagenes/";			//CARGA UNA IMAGEN
	$price 	= isset($_REQUEST['price']) ? ($_REQUEST['price']) : "";			//referencial
	$price1	= isset($_REQUEST['price1']) ? ($_REQUEST['price1']) : "";			//costre
	$price2	= isset($_REQUEST['price2']) ? ($_REQUEST['price2']) : "";			//margene
	$price3	= isset($_REQUEST['price33']) ? ($_REQUEST['price33']) : "";		//prevta
	$price4	= isset($_REQUEST['price44']) ? ($_REQUEST['price44']) : "";		//prevta unit
	if ($price3 == "")
	{
	$price3	= isset($_REQUEST['pv1']) ? ($_REQUEST['pv1']) : "";//prevta
	}
	if ($price4 == "")
	{
	$price4	= isset($_REQUEST['pv2']) ? ($_REQUEST['pv2']) : "";//prevta unit
	}
	$cod_bar= isset($_REQUEST['cod_bar']) ? ($_REQUEST['cod_bar']) : "";
	$textdesc= isset($_REQUEST['textdesc']) ? ($_REQUEST['textdesc']) : "";
	$codpres= isset($_REQUEST['present']) ? ($_REQUEST['present']) : "";
	$catp   = isset($_REQUEST['catp']) ? ($_REQUEST['catp']) : "";
	$cant1	= isset($_REQUEST['cant1']) ? ($_REQUEST['cant1']) : "";
	$cant2	= isset($_REQUEST['cant2']) ? ($_REQUEST['cant2']) : "";
	$cant3	= isset($_REQUEST['cant3']) ? ($_REQUEST['cant3']) : "";
	$cant11	= isset($_REQUEST['cant11']) ? ($_REQUEST['cant11']) : "";
	$cant22	= isset($_REQUEST['cant22']) ? ($_REQUEST['cant22']) : "";
	$cant33	= isset($_REQUEST['cant33']) ? ($_REQUEST['cant33']) : "";
	$marca	= isset($_REQUEST['marca']) ? ($_REQUEST['marca']) : "";
	$line	= isset($_REQUEST['line']) ? ($_REQUEST['line']) : "";
	$clase	= isset($_REQUEST['clase']) ? ($_REQUEST['clase']) : "";
	$rd		= isset($_REQUEST['rd']) ? ($_REQUEST['rd']) : "";
	$rd1	= isset($_REQUEST['rd1']) ? ($_REQUEST['rd1']) : "";	
	$igv	= isset($_REQUEST['igv']) ? ($_REQUEST['igv']) : "";//si es activo o no
	$inc	= isset($_REQUEST['inc']) ? ($_REQUEST['inc']) : "";//INCENTIVO DEL PRODUCTO
	$lotec	= isset($_REQUEST['lotec']) ? ($_REQUEST['lotec']) : "";//INCENTIVO DEL 
	$mc		= substr($marca,0,1);
	$ln		= substr($line,0,1);
	$cl		= substr($clase,0,1);
	$pr		= substr($codpres,0,1);
	$cp		= substr($catp,0,1);
	//////REGISTRO DE MARCAS
	if (($mc <> "0") and ($mc <> "1") and ($mc <> "2") and ($mc <> "3") and ($mc <> "4") and ($mc <> "5") and ($mc <> "6") and ($mc <> "7") and ($mc <> "8") and ($mc <> "9"))
	{
		mysqli_query($conexion,"INSERT INTO titultabladet (tiptab,destab) values ('M','$marca')");
		$sql="SELECT codtab FROM titultabladet where destab = '$marca' and tiptab = 'M'";
		$result = mysqli_query($conexion,$sql);
		if (mysqli_num_rows($result) ){
		while ($row = mysqli_fetch_array($result)){
			 $marca             = $row['codtab'];
		}
		}
	}
	//////REGISTRO DE LINEAS
	if (($ln <> "0") and ($ln <> "1") and ($ln <> "2") and ($ln <> "3") and ($ln <> "4") and ($ln <> "5") and ($ln <> "6") and ($ln <> "7") and ($ln <> "8") and ($ln <> "9"))
	{
		mysqli_query($conexion,"INSERT INTO titultabladet (tiptab,destab) values ('F','$line')");
		$sql="SELECT codtab FROM titultabladet where destab = '$line' and tiptab = 'F'";
		$result = mysqli_query($conexion,$sql);
		if (mysqli_num_rows($result) ){
		while ($row = mysqli_fetch_array($result)){
			 $line             = $row['codtab'];
		}
		}
	}
	//////REGISTRO DE CLASES
	if (($cl <> "0") and ($cl <> "1") and ($cl <> "2") and ($cl <> "3") and ($cl <> "4") and ($cl <> "5") and ($cl <> "6") and ($cl <> "7") and ($cl <> "8") and ($cl <> "9"))
	{
		mysqli_query($conexion,"INSERT INTO titultabladet (tiptab,destab) values ('U','$clase')");
		$sql="SELECT codtab FROM titultabladet where destab = '$clase' and tiptab = 'U'";
		$result = mysqli_query($conexion,$sql);
		if (mysqli_num_rows($result) ){
		while ($row = mysqli_fetch_array($result)){
			 $clase             = $row['codtab'];
		}
		}
	}
	//////REGISTRO DE PRESENTACION
	if (($pr <> "0") and ($pr <> "1") and ($pr <> "2") and ($pr <> "3") and ($pr <> "4") and ($pr <> "5") and ($pr <> "6") and ($pr <> "7") and ($pr <> "8") and ($pr <> "9"))
	{
		mysqli_query($conexion,"INSERT INTO titultabladet (tiptab,destab) values ('PRES','$codpres')");
		$sql="SELECT codtab FROM titultabladet where destab = '$codpres' and tiptab = 'PRES'";
		$result = mysqli_query($conexion,$sql);
		if (mysqli_num_rows($result) ){
		while ($row = mysqli_fetch_array($result)){
			 $codpres             = $row['codtab'];
		}
		}
	}
	//////REGISTRO DE CATEGORIA
	if (($cp <> "0") and ($cp <> "1") and ($cp <> "2") and ($cp <> "3") and ($cp <> "4") and ($cp <> "5") and ($cp <> "6") and ($cp <> "7") and ($cp <> "8") and ($cp <> "9"))
	{
		mysqli_query($conexion,"INSERT INTO titultabladet (tiptab,destab) values ('CATP','$catp')");
		$sql="SELECT codtab FROM titultabladet where destab = '$catp' and tiptab = 'CATP'";
		$result = mysqli_query($conexion,$sql);
		if (mysqli_num_rows($result) ){
		while ($row = mysqli_fetch_array($result)){
			 $catp             = $row['codtab'];
		}
		}
	}
	//$pcostounit = ($price1/$factor);
	////GRABO DATOS
	if (($marca <> "") && ($line <> "") && ($clase <> ""))
	{
	if ($val == 1)
	{
		
		$cod = $_POST['cod_nuevo'];
		//$sql = "SELECT codbar, desprod FROM producto WHERE ((codbar='$cod_bar') and (codbar <> '')) or desprod='".quitar($HTTP_POST_VARS["des"])."'";
		$sql = "SELECT codbar, desprod FROM producto WHERE desprod='$des'";
		$result = mysqli_query($conexion,$sql);
		if (mysqli_num_rows($result))
		{
			header("Location: mov_prod.php?error=2&pageno=$paginas");
		}
		else
		{		
			/////////VERIFICO QUE ESTE CODIGO NO SEA UTILIZADO
				$sql="SELECT codpro FROM producto where codpro = '$cod'";
				$result = mysqli_query($conexion,$sql);
				if (mysqli_num_rows($result)){
				$cod = $cod + 1;
				$t = 0;
					while($t == 1)
					{
						$sql1="SELECT codpro FROM producto where codpro = '$cod'";
						$result1 = mysqli_query($conexion,$sql1);
						if (mysqli_num_rows($result1)){
						$cod = $cod + 1;
						}
						else
						{
						$t = 1;
						}
					}
				}
		if ($img != "")
		{
			$valor		= $cod.".jpg";
			copy($_FILES["img"]['tmp_name'],$directorio.$cod.".jpg");
			//Actualizamos el registro en la tabla Evento
		}
		mysqli_query($conexion,"INSERT INTO producto (codpro,desprod,codbar,factor,moneda,prevta,imapro,detpro,cant1,cant2,cant3,desc1,desc2,desc3,activo,costre,margene,datcre,codmar, coduso,codfam,igv,stopro,costod,costpr,codusu,preuni,prelis,incentivado,s000,s001,s002,s003,s004,s005,s006,s007,s008,s009,s010,s011,s012,s013,s014,s015,s016,pcostouni,ultpcostouni,blister,lotec,codpres,codcatp,activo1) values ('$cod','$des','$cod_bar','$factor','$moneda','$price3','$valor','$textdesc','$cant1','$cant2','$cant3','$cant11','$cant22','$cant33','$rd','$price1','$price2','$date','$marca','$clase','$line','$igv','0','0','0','$usuario','$price4','0','$inc','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','$price1','$price1','$blister','$lotec','$codpres','$catp','$rd1')");
		header("Location: mov_prod.php?ok=1&pageno=$paginas&ultimo=1&codigo_producto=$codpro"); 
		}
	}
	////MODIFICO DATOS
	if ($val == 2)
	{
			$codigo		= $_POST['cod_modif_del'];
			$sql="SELECT desprod,codbar,costre FROM producto where codpro = '$codigo'";
			$result = mysqli_query($conexion,$sql);
			if (mysqli_num_rows($result) ){
			while ($row = mysqli_fetch_array($result)){
				 $descripcion_prod		 = $row['desprod'];
				 $codigo_barra           = $row["codbar"];
				 $costre                 = $row["costre"];
			}
			}
			//$prevta = ($costre * (($price2/100)+1));
			//$preuni = $prevta/$factor;
			if (($cod_bar == $codigo_barra) and ($des == $descripcion_prod))
			{
			mysqli_query($conexion,"update producto set factor = '$factor', moneda = '$moneda', detpro = '$textdesc', cant1 = '$cant1', cant2 = '$cant2', cant3 = '$cant3', desc1 = '$cant11', desc2 = '$cant22', desc3 = '$cant33', activo = '$rd', margene = '$price2', codmar = '$marca', codfam = '$line', coduso = '$clase',igv = '$igv', codusu = '$usuario',incentivado = '$inc',prevta = '$price3',preuni = '$price4',costre = '$price1',pcostouni = '$price1',blister = '$blister',lotec='$lotec',codpres = '$codpres',codcatp = '$catp',prelis = '$price',activo1='$rd1' where codpro = '$codigo'");
			header("Location: mov_prod.php?up=1&pageno=$paginas");
			}
			else
			{
					if ($cod_bar == $codigo_barra)
					{
						$sql = "SELECT desprod FROM producto WHERE desprod='$des'";
						$result = mysqli_query($conexion,$sql);
						if (mysqli_num_rows($result))
						{
						header("Location: mov_prod.php?error=2&pageno=$paginas");
						}
						else
						{
						mysqli_query($conexion,"update producto set desprod = '$des', factor = '$factor', moneda = '$moneda', detpro = '$textdesc', cant1 = '$cant1', cant2 = '$cant2', cant3 = '$cant3', desc1 = '$cant11', desc2 = '$cant22', desc3 = '$cant33', activo = '$rd', margene = '$price2', codmar = '$marca', codfam = '$line', coduso = '$clase',igv = '$igv', codusu = '$usuario',incentivado = '$inc',prevta = '$price3',preuni = '$price4',costre = '$price1',pcostouni = '$price1',blister = '$blister',lotec='$lotec',codpres = '$codpres',codcatp = '$catp',prelis = '$price',activo1='$rd1' where codpro = '$codigo'");
						header("Location: mov_prod.php?up=1&pageno=$paginas");
						}
					
					}
					else
					{
						if ($des == $descripcion_prod)
						{
							$sql = "SELECT codbar FROM producto WHERE ((codbar='$cod_bar') and (codbar <> ''))";
							$result = mysqli_query($conexion,$sql);
							if (mysqli_num_rows($result))
							{
							header("Location: mov_prod.php?error=2&pageno=$paginas");
							}
							else
							{
							mysqli_query($conexion,"update producto set codbar = '$cod_bar', factor = '$factor', moneda = '$moneda', detpro = '$textdesc', cant1 = '$cant1', cant2 = '$cant2', cant3 = '$cant3', desc1 = '$cant11', desc2 = '$cant22', desc3 = '$cant33', activo = '$rd', margene = '$price2', codmar = '$marca', codfam = '$line', coduso = '$clase',igv = '$igv', codusu = '$usuario',incentivado = '$inc',prevta = '$price3',preuni = '$price4',costre = '$price1',pcostouni = '$price1',blister = '$blister',lotec='$lotec',codpres = '$codpres',codcatp ='$catp',prelis = '$price',activo1='$rd1' where codpro = '$codigo'");
							header("Location: mov_prod.php?up=1&pageno=$paginas");
							}
					    }
						else
						{
							$sql = "SELECT codbar, desprod FROM producto WHERE ((codbar='$cod_bar') and (codbar <> '')) or desprod='$des'";
							$result = mysqli_query($conexion,$sql);
							if (mysqli_num_rows($result))
							{
							//header("Location: mov_prod.php?error=2");
							header("Location: mov_prod.php?error=2&pageno=$paginas");
							}
							else
							{
							mysqli_query($conexion,"update producto set desprod = '$des', codbar = '$cod_bar', factor = '$factor', moneda = '$moneda', detpro = '$textdesc', cant1 = '$cant1', cant2 = '$cant2', cant3 = '$cant3', desc1 = '$cant11', desc2 = '$cant22', desc3 = '$cant33', activo = '$rd', margene = '$price2', codmar = '$marca', codfam = '$line', coduso = '$clase',igv = '$igv', codusu = '$usuario',incentivado = '$inc',prevta = '$price3',preuni = '$price4',costre = '$price1', pcostouni = '$price1',blister = '$blister',lotec='$lotec',codpres = '$codpres',codcatp = '$catp',prelis = '$price',activo1='$rd1' where codpro = '$codigo'");
							header("Location: mov_prod.php?up=1&pageno=$paginas");
							}
						}
	
					}
			}
			
	}	
	}	////SI CIERRO LA MARCA, LINEA O CLASE
	else
	{
	header("Location: mov_prod.php?up=2&pageno=$paginas");
	}
}
if ($btn == 5)
{
			/////ELIMINA DATOS
			$codigo		= $_POST['cod_modif_del'];
			$sql1="SELECT codpro FROM kardex where codpro = '$codigo'";
			$result1 = mysqli_query($conexion,$sql1);
			if (mysqli_num_rows($result1))
			{
			header("Location: mov_prod.php?del=2&pageno=$paginas");
			}
			else
			{
			mysqli_query($conexion,"DELETE from producto where codpro = '$codigo'");
			header("Location: mov_prod.php?del=1");
			}
			
}
if ($btn == 6)
{
			/////REGRESA AL MENU PRINCIPAL
			header("Location: ../../index.php");
}
?>