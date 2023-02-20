<?php include('../../session_user.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<link href="css/style1.css" rel="stylesheet" type="text/css" />
<link href="css/style2.css" rel="stylesheet" type="text/css" />
<?php require_once('../../../conexion.php');	//CONEXION A BASE DE DATOS
require_once('../../../convertfecha.php');	//CONEXION A BASE DE DATOS
require_once("../../../funciones/highlight.php");	//ILUMINA CAJAS DE TEXTOS
//require_once("../../../funciones/functions.php");	//DESHABILITA TECLAS
require_once("../../../funciones/botones.php");	//COLORES DE LOS BOTONES
require_once("../../../funciones/funct_principal.php");	//IMPRIMIR-NUME
require_once("../../local.php");	//LOCAL DEL USUARIO
function formato($c) {
printf("%04d",$c);
} 
$rd     = $_REQUEST['rd'];
?>
<style type="text/css">
<!--
.Estilo1 {
	color: #666666;
	font-weight: bold;
}
-->
</style>
</head>
<body>
<form name="form1" id="form1" onClick="highlight(event)" onKeyUp="highlight(event)">
  <table width="944" border="0">
    <tr>
      <td width="941">
	    <?php if ($rd == 1)
		{
		$sql="SELECT invnum,nrocomp,invfec,provee,refere,invtot,condicio,codusu,borrada,confirmado,pendiente,impreso,altpreingreso,preingreso FROM ordmae where borrada = '1' and estado = '0' order by invfec desc, invnum desc";
		}
		else
		{
			if ($rd == 2)
			{
			$sql="SELECT invnum,nrocomp,invfec,provee,refere,invtot,condicio,codusu,borrada,confirmado,pendiente,impreso,altpreingreso,preingreso FROM ordmae where pendiente  = '1' and estado = '0' order by invfec desc, invnum desc";
			}
			else
			{
				if ($rd == 3)
				{
				$sql="SELECT invnum,nrocomp,invfec,provee,refere,invtot,condicio,codusu,borrada,confirmado,pendiente,impreso,altpreingreso,preingreso FROM ordmae where pendiente  = '0' and estado = '0' order by invfec desc, invnum desc";
				}
				else
				{
				$sql="SELECT invnum,nrocomp,invfec,provee,refere,invtot,condicio,codusu,borrada,confirmado,pendiente,impreso,altpreingreso,preingreso FROM ordmae where estado = '0' order by invfec desc, invnum desc";
				}
			}
		}
		$result = mysqli_query($conexion,$sql);
		if (mysqli_num_rows($result)){
		?>
<table width="939" border="0">
		<?php while ($row = mysqli_fetch_array($result)){
		$invnum 	= $row['invnum'];
		$nrocomp 	= $row['nrocomp'];
		$invfec 	= $row['invfec'];
		$provee 	= $row['provee'];
		$refere 	= $row["refere"];
		$invtot 	= $row["invtot"];
		$condicio	= $row["condicio"];
		$codusu 	= $row["codusu"];
		$codanu 	= $row["codanu"];
		$borrada 	= $row["borrada"];
		$impreso 	= $row["impreso"];
		$confirmado	= $row["confirmado"];
		$pendiente 	= $row["pendiente"];
		$preingreso 	= $row["preingreso"];
		$altpreingreso 	= $row["altpreingreso"];
		if ($borrada == 1)
		{
		$desc_borrada = "SI";
		$color = "#FF0000";
		}
		else
		{
		$desc_borrada = "NO";
		}
		if ($impreso == 1)
		{
		$desc_impreso = "SI";
		}
		else
		{
		$desc_impreso = "NO";
		}
		$sql1="SELECT despro FROM proveedor where codpro = '$provee'";
		$result1 = mysqli_query($conexion,$sql1);
		if (mysqli_num_rows($result1)){
		while ($row1 = mysqli_fetch_array($result1)){
		$desprov = $row1['despro'];
		}
		}
		$sql1="SELECT nomusu FROM usuario where usecod = '$codusu'";
		$result1 = mysqli_query($conexion,$sql1);
		if (mysqli_num_rows($result1)){
		while ($row1 = mysqli_fetch_array($result1)){
		$nomusu = $row1["nomusu"];
		}
		}
		$bits = 0;
		$calc = 0;
		$sql1="SELECT canpro,canate,factor,canbon,costod FROM ordmov where invnum = '$invnum'";
		$result1 = mysqli_query($conexion,$sql1);
		if (mysqli_num_rows($result1)){
		while ($row1 = mysqli_fetch_array($result1)){
		$canpro = $row1["canpro"];
		$canate = $row1["canate"];
		$factor = $row1["factor"];
		$canbon = $row1["canbon"];
		$costod = $row1["costod"];
			if ($costod <> 0)
			{
			$calc 	= $canpro * $factor;
			}
			else
			{
			$calc	= $canbon;
			}
			if ($calc <> $canate)
			{
				$bits == 1;
			}
		}
		}
		if ($preingreso == 0)
		{
			if ($confirmado == 1)
			{
			$states = "NO AUTORIZADO";
			}
			else
			{
				if ($pendiente == 1)
				{
				$states = "AUTORIZADO - PENDIENTE DE INGRESAR";
				$color = "#000000";
				}
				else
				{
						if ($bits == 1)
						{
						$states = "ATENDIDA PARCIALMENTE";
						}
						else
						{
						$states = "ATENDIDA EN SU TOTALIDAD";
						$color = "#009900";
						}
				}
			}
		}
		else
		{
			if ($altpreingreso == 1)
			{
			$states = "INGRESADO - NO APROBADO";
			}
			else
			{
				if ($confirmado == 1)
				{
					$states = "NO AUTORIZADO";
				}
				else
				{
					if ($pendiente == 1)
					{
						$states = "NO INGRESADO";
					}
					else
					{
						$states = "ATENDIDA EN SU TOTALIDAD";
					}
				}
			}
		}
		if ($color == "")
		{
		$color = "#000000";
		}
		?>
          <tr onmouseover="this.style.backgroundColor='#FFFF99';this.style.cursor='hand';" onmouseout="this.style.backgroundColor='#FFFFFF';">
            <td width="43"><a href="ocompra1.php?invnum=<?php echo $invnum?>" target="principal"><?php echo formato($nrocomp)?></a></td>
            <td width="59"><font color="<?php echo $color?>"><?php echo fecha($invfec);?></font></td>
            <td width="100"><font color="<?php echo $color?>"><?php echo $desprov?></font></td>
            <td width="107"><font color="<?php echo $color?>"><?php echo $refere?></font></td>
            <td width="58"><font color="<?php echo $color?>"><div align="right"><?php echo $invtot?></div></font></td>
            <td width="140"><font color="<?php echo $color?>">&nbsp;<?php if ($preingreso == 1){ echo "PREINGRESO";} else { echo $condicio;}?></font></td>
            <td width="102"><font color="<?php echo $color?>"><?php echo $nomusu?></font></td>
            <td width="54"><font color="<?php echo $color?>"><div align="center"><?php echo $desc_impreso?></div></font></td>
            <td width="114"><font color="<?php echo $color?>"><?php echo $states?></font></td>
            <td width="51"><font color="<?php echo $color?>"><div align="center"><?php echo $desc_borrada?></div></font></td>
			<td width="19">
			<a href="javascript:popUpWindow('ocompra2_print.php?invnum=<?php echo $invnum?>', 10, 50, 1000, 350)">
			<img src="../../../images/printbutton.png" width="14" height="14" border="0"/>
			</a>
			</td>
			<td width="19">
			<?php if ($borrada == 0)
			{
			?>
			<a href="des_compra.php?rd=<?php echo $rd?>&invnum=<?php echo $invnum?>">
			<img src="../../../images/del_16.png" width="16" height="16" border="0" title="DESHABILITAR COMPRA"/>
			</a>
			<?php }
			else
			{
			?>
			<a href="hab_compra.php?rd=<?php echo $rd?>&invnum=<?php echo $invnum?>">
			<img src="../../../images/icon-16-checkin.png" width="16" height="16" border="0" title="HABILITAR COMPRA">
			</a>
			<?php }
			?>
			</td>
			<td width="19">
			<?php /*?><a href="javascript:popUpWindow('ocompra2_print.php?cod=<?php echo $codpro?>', 10, 50, 1000, 350)"><?php */?>
			<img src="../../../images/edit_16.png" width="16" height="16" border="0"/>
			<?php /*?></a><?php */?>
			</td>
          </tr>
		  <?php }
		  ?>
        </table>
		<?php }
		else
		{
		?>
		<br><br><br><br><br><br><br><center>NO SE LOGRO ENCONTRAR INFORMARCION EN EL SISTEMA</center>
		<?php }
		?>
	  </td>
    </tr>
  </table>
</form>
</body>
</html>
