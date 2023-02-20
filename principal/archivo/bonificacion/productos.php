<?php 
include('../../session_user.php');
require_once ('../../../conexion.php');	//CONEXION A BASE DE DATOS
require_once('../../../titulo_sist.php');
$ActionForm     = isset($_REQUEST['ActionForm']) ? ($_REQUEST['ActionForm']) : "";
$CProducto      = isset($_REQUEST['CProducto']) ? ($_REQUEST['CProducto']) : "";
$CProductoBonif = isset($_REQUEST['CProductoBonif']) ? ($_REQUEST['CProductoBonif']) : "";
$ProductoBusk   = isset($_REQUEST['ProductoBusk']) ? ($_REQUEST['ProductoBusk']) : "";
$Cantidad       = isset($_REQUEST['Cantidad']) ? ($_REQUEST['Cantidad']) : "";
$CantidadBonif  = isset($_REQUEST['CantidadBonif']) ? ($_REQUEST['CantidadBonif']) : "";

$desprodBonif       = "";
$CantidadaVender2   = "";
//$CProductoBonif = "";
//$CantidadBonif  = "";
if ($ActionForm == "RegistrarBonificacion")
{
    mysqli_query($conexion, "UPDATE producto set "
            . "cantventaparabonificar = '$Cantidad',"
            . "codprobonif= '$CProductoBonif', "
            . "cantbonificable = '$CantidadBonif' "
            . "where codpro = '$CProducto'");
}

if ($ActionForm == "EliminaBonificacion")
{
    mysqli_query($conexion, "UPDATE producto set "
            . "cantventaparabonificar = '',"
            . "codprobonif= '', "
            . "cantbonificable = '' "
            . "where codpro = '$CProducto'");
    $ActionForm     = "";
    $CProductoBonif = "";
    $Cantidad       = "";
}
    
$sql="SELECT desprod,cantventaparabonificar,codprobonif,cantbonificable FROM producto where codpro = '$CProducto'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result))
{
    while ($row = mysqli_fetch_array($result))
    {
        $desprod            = $row['desprod'];
        $CantidadaVender2   = $row['cantventaparabonificar'];
        $CProductoBonif2    = $row['codprobonif'];
        $CantidadBonif2     = $row['cantbonificable'];
    }
    
    if ($CProductoBonif == "")
    {
        $CProductoBonif = $CProductoBonif2;
    }
    
    //DATOS DEL PRODUCTO BONIFICADO
    if ((strlen($CProductoBonif)>0) and ($CProductoBonif <> 0))
    {
    $sql2="SELECT desprod FROM producto where codpro = '$CProductoBonif'";
    $result2 = mysqli_query($conexion,$sql2);
    if (mysqli_num_rows($result2))
    {
        while ($row2 = mysqli_fetch_array($result2))
        {
            $desprodBonif    = $row2['desprod'];
        }
    }
    }
    if ($Cantidad == "")
    {
        $Cantidad = $CantidadaVender2;
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $desprod?></title>
<link href="../css/css/tablas.css" rel="stylesheet" type="text/css" />
<link href="../../css/body.css" rel="stylesheet" type="text/css" />
<link href="../../../css/style.css" rel="stylesheet" type="text/css" />
<?php 
require_once("../../../funciones/functions.php");//DESHABILITA TECLAS
?>
<script type="text/javascript">
    function Salir()
    {
        window.close();
    }
    function buscar()
    {
        var f = document.Formulario;
        if (f.ProductoBusk.value === "")
        {
            f.ProductoBusk.focus();
            alert("Ingrese un producto a buscar");return false;
        }
        f.ActionForm.value = "BuscarProducto";
        f.CProductoBonif.value = "";
        f.submit();
    }
    
    function eliminar()
    {
        var Formulario          = "Formulario";
        var f                   = document.getElementById(Formulario);
        if(confirm('Desea limpiar este registro'))
        {
            f.ActionForm.value  = "EliminaBonificacion";
            f.submit();
        }
        else
        {
            return;
        }
    }
    
    function SelecProducto(Valor)
    {
        var f = document.Formulario;
        f.ActionForm.value = "";
        f.CProductoBonif.value = Valor;
        f.submit();
    }
    
    function GrabarBonificacion()
    {
        var f = document.Formulario;
        if (f.CProductoBonif.value === "")
        {
            alert("Seleccione un Producto a Bonificar");return false;
        }
        if (f.Cantidad.value === "")
        {
            f.Cantidad.focus();
            alert("Seleccione una cantidad de Venta");return false;
        }
        if (f.CantidadBonif.value === "")
        {
            f.CantidadBonif.focus();
            alert("Seleccione una cantidad a Bonificar");return false;
        }
        f.ActionForm.value = "RegistrarBonificacion";
        f.submit();
    }
    
    function letracc(evt)
    {
	//var key=evt.keyCode;
        var key = evt ? evt.which : evt.keyCode;
        return (key == 67 || key == 99 ||key <= 13 || (key >= 48 && key <= 57));
    }
</script>
</head>
<body <?php if ($ActionForm == "RegistrarBonificacion"){?>onload="Salir();"<?php }?>>
    <form name="Formulario" id="Formulario" action="productos.php" method="post">
    <input type="hidden" name="ActionForm" value=""/>
    <input type="hidden" name="CProducto" value="<?php echo $CProducto;?>"/>
    <input type="hidden" name="CProductoBonif" value="<?php echo $CProductoBonif;?>"/>
    <table style="width: 100%" bgcolor="#FFFF99">
        <tr>
            <td style="width: 25%">PRODUCTO PRINCIPAL</td>
            <td style="width: 75%">
                <?php echo $desprod;?>
            </td>
        </tr>
        <tr>
            <td style="width: 25%">CANTIDAD A VENDER</td>
            <td style="width: 75%">
                <input type="text" name="Cantidad" maxlength="4" id="Cantidad" onkeypress="return letracc(event);" value="<?php echo $Cantidad;?>"/>
                <FONT COLOR="red">Venta por Caja colocar inicial "C", si es venta por unidad colocar solo número </FONT>
            </td>
        </tr>
    </table>
    <table style="width: 100%"  bgcolor="#FFFFFF">
        <?php 
        if ($ActionForm == "")
        {
        ?>
        <tr>
            <td style="width: 25%">PRODUCTO BONIFICADO</td>
            <td colspan="2" style="width: 75%">
                <input name="ProductoBusk" type="text" maxlength="100" id="ProductoBusk" style="width: 40%;" value="<?php echo $desprodBonif?>"/>
                <input name="search" type="button" id="search" value="Buscar" onclick="buscar()" class="buscar"/>
                <?php 
                if ((strlen($CProductoBonif)>0) and ($CProductoBonif <> 0))
                {
                ?>
                <input name="delete" type="button" id="delete" value="Quitar" onclick="eliminar()" class="buscar"/>
                <?php
                }
                ?>
            </td>
        </tr>
        <?php 
        }
        else
        {
            $sql3="SELECT codpro,desprod,codmar FROM producto where desprod like '$ProductoBusk%' ";
            $result3 = mysqli_query($conexion,$sql3);
            if (mysqli_num_rows($result3))
            {
        ?>
        <tr>
            <td colspan="3"></br></td>
        </tr>
        <tr>
            <th style="text-align: left;">SELECCIONE UN PRODUCTO</th>
            <th style="text-align: left;">MARCA</th>
            <th style="text-align: left;">ACCIONES</th>
        </tr>
        <?php
                $i=0;
                while ($row3 = mysqli_fetch_array($result3))
                {
                    $codpro         = $row3['codpro'];
                    $desprod        = $row3['desprod'];
                    $codmar         = $row3['codmar'];
                    $sqlMarcaDet="SELECT destab,abrev FROM titultabladet where codtab = '$codmar'";
                    $resultMarcaDet = mysqli_query($conexion,$sqlMarcaDet);
                    if (mysqli_num_rows($resultMarcaDet))
                    {
                        while ($row1 = mysqli_fetch_array($resultMarcaDet))
                        {
                            $marca     = $row1['destab'];
                            $abrev     = $row1['abrev'];	
                            if ($abrev == '')
                            {
                                $marca = substr($marca,0,4);
                            }
                            else
                            {
                                $marca = substr($abrev,0,4);
                            }
                        }
                    }
                    $t = $i%2;
                    if ($t == 1)
                    {
                        $Color = "#f5f8f9";
                    }
                    else
                    {
                        $Color = "#D4D0C8";
                    }
        ?>
        <tr style="background-color: <?php echo $Color;?>">
            <td><?php echo $desprod;?></td>
            <td><?php echo $marca;?></td>
            <td><input type="button" name="Seleccionar" value="Seleccionar" onclick="SelecProducto(<?php echo $codpro;?>);"/></td>
        </tr>
        <?php
                $i++;
                }
        ?>
        <tr>
            <td colspan="3"></br></td>
        </tr>
        <?php
            }
        }
        ?>
        <tr>
            <td style="width: 25%">CANTIDAD BONIFICADA</td>
            <td colspan="2" style="width: 75%">
                <input type="text" maxlength="4" name="CantidadBonif" onkeypress="return letracc(event);" id="CantidadBonif" value="<?php echo $CantidadBonif2;?>"/>
                <FONT COLOR="red">Bonificación por Caja colocar inicial "C", si es bonificación por unidad colocar solo número </FONT>
                </td>
        </tr>
        <tr>
            <td style="width: 25%"></td>
            <td colspan="2" style="width: 75%">
                <?php
                if (strlen($CProductoBonif)>0)
                {
                ?>
                <input type="button" name="Grabar" id="Grabar" value="Grabar Datos" onclick="GrabarBonificacion();"/>
                <?php 
                }
                ?>
                <input name="exit" type="button" id="exit" value="Salir"  onclick="Salir()" class="salir"/>
            </td>
        </tr>
    </table>
    </form>
</body>
</html>
<?php
}
?>