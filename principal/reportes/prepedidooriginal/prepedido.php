<?php 

include('../../session_user.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
require_once ('../../../conexion.php');	//CONEXION A BASE DE DATOS
require_once('../../../titulo_sist.php');
require_once('../../../convertfecha.php');	
require_once("../local.php");	//OBTENGO EL NOMBRE Y CODIGO DEL LOCAL

$idpreped    = isset($_REQUEST['idpreped']) ? ($_REQUEST['idpreped']) : "";
$numpagina    = isset($_REQUEST['numpagina']) ? ($_REQUEST['numpagina']) : "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['text'])) {
        $text = $_POST['text'];
        foreach( $text as $key => $n ) {
            $sql="UPDATE detalle_prepedido DP
                SET solicitado='$n'
                WHERE DP.idprepedido = '$idpreped' AND DP.iddetalle='$key'";
            error_log($sql);
            $result = mysqli_query($conexion,$sql);
        }

    }
}

	

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style>
@media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
}
#tabDetalle { display: block; }

#tabDetalle {
    height: 600px;       /* Just for the demo          */
    overflow-y: auto;    /* Trigger vertical scroll    */
}
</style>
  <script language="JavaScript">
    function buscarFunc()
    {
        var f = document.form1;
        if (f.numpagina.value == "")
        {
            alert("Ingrese un número de prepedido");
            f.numpagina.focus();
            return;
        }
        f.submit();
    }
    function buscarOption()
    {
        var f = document.form1;
        f.numpagina.value = f.option.value
        f.submit();
    }
    function salirFunc()
    {
        var f = document.form1;
        f.method = "POST";
        f.target = "_top";
        f.action = "../../index.php";
        f.submit();
    }
    function printerFunc()
    {        
        window.open('prepedido_imp.php?idpreped=<?php echo $idpreped; ?>&numpagina=<?php echo $numpagina; ?>');
    }
    function printerFunc2()
    {
        var table = document.getElementById("tabDetalle");
        for (var i = 1, row; row = table.rows[i]; i++) {
            //for (var j = 0, col; col = row.cells[j]; j++) {
           //     console.log(col);
           var content = row.cells[6].children[0].value;
           if (content<=0) {
                row.classList.add("no-print");
           } else {
            row.classList.remove("no-print");
           }
           
            //}  
        }
        window.print(document.form1.resultado);
    }
    function PrintElem(elem)
    {
        var mywindow = window.open('', 'PRINT', 'height=400,width=600');

        mywindow.document.write('<html><head><title>' + document.title  + '</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write('<h1>' + document.title  + '</h1>');
        mywindow.document.write(document.getElementById(elem).innerHTML);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10*/

        mywindow.print();
        mywindow.close();

        return true;
    }
    function actualizar() {
        var f = document.form2;
        f.method = "POST";
        f.submit();
    }
</script>  
<title><?php echo $desemp?></title>

<link href="../css/tablas.css" rel="stylesheet" type="text/css" />
<link href="../../css/body.css" rel="stylesheet" type="text/css" />
<link href="../../../css/style.css" rel="stylesheet" type="text/css" />

<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/style1.css" rel="stylesheet" type="text/css" />

<?php require_once("../../../funciones/functions.php");	//DESHABILITA TECLAS?>
<script type="text/javascript" language="JavaScript1.2" src="../../menu_block/stmenu.js"></script>
<?php require_once("../../../funciones/botones.php"); //COLORES DE LOS BOTONES ?>

</head>
<body>
<div class="tabla1"  style="height: 100%;">
<script type="text/javascript" language="JavaScript1.2" src="../../menu_block/men.js"></script>

<div class="title1">
	<span class="titulos">SISTEMA DE VENTAS - PREPEDIDO
	</span>
</div>
<div class="mask1111"  style="height: 100%;">
	<div class="mask2222"  style="height: 100%;">
		<div class="mask3333"  style="height: 100%;">
		<table width="954" border="0">
            <tr>
                <td><b><u>BÚSQUEDA DE PREPEDIDO</u></b>
                    <form id="form1" name="form1" method = "post" action="">
                        <table width="600" border="0">
                            <tr>
                                <td width="119">CÓDIGO</td>
                                <td width="98">
                                    <input type="text" name="numpagina" id="numpagina" size="12" value="<?php 
                                        echo $numpagina;  ?>">
                                </td>     
                                <td width="119"></td>
                                <td width="400">
                                    <input type="button" name="buscar" value="Buscar" onclick="buscarFunc()" class="buscar"/>
                                    <input type="button" name="imprimir" value="Imprimir" onclick="printerFunc()" class="imprimir"/>
                                    <input type="button" name="exportar" value="Exportar" onclick="exportarFunc()" class="imprimir"/>
                                    <input type="button" name="salir" value="Salir" onclick="salirFunc()" class="salir"/>
                                </td>  
                            </tr>
                            <tr>
                                <td width="119">CAMBIAR A PREPEDIDO</td>
                                <td width="98">
                                    <select id="option" name='option' onchange="buscarOption()">
                                    <?php 
                                        $sqlList="SELECT distinct(numpagina) numcont FROM detalle_prepedido P where P.idprepedido = '$idpreped'";
                                        error_log("SQL 2: ".$sqlList);
                                        $result = mysqli_query($conexion,$sqlList);
                                        if (mysqli_num_rows($result)){
                                            while ($row = mysqli_fetch_array($result)){
                                                $numcont    = $row['numcont'];
                                                echo '<option value="'.$numcont.'"';
                                                if ($numcont==$numpagina) echo " selected ";
                                                echo '>'.$numcont.'</option>';
                                            }
                                        }
                                    ?>
                                    </select>
                                </td>     

                            </tr>
                        </table>
                    </form>
                    <div align="left"><img src="../../../images/line2.png" width="940" height="4" /></div>
				</td>
            </tr>
        </table>
        <?php 
        if ($idpreped != "") {
            $sql="SELECT * FROM prepedido P, xcompa X
                where P.codloc=X.codloc AND P.idpreped = '$idpreped'";
            error_log("SQL 1: ".$sql);
            $result = mysqli_query($conexion,$sql);
            if (mysqli_num_rows($result)){
                if ($row = mysqli_fetch_array($result)){
                    $nomloc    = $row['nomloc'];
                    $fecha    = $row['fecha'];

	$columna='s000';
	if ($nomloc == "LOCAL0")
	{
		$columna = 's000';
	}
	if ($nomloc == "LOCAL1")
	{
		$columna = 's001';
	}
	if ($nomloc == "LOCAL2")
	{
		$columna = 's002';
	}
	if ($nomloc == "LOCAL3")
	{
		$columna = 's003';
	}
	if ($nomloc == "LOCAL4")
	{
		$columna = 's004';
	}
	if ($nomloc == "LOCAL5")
	{
		$columna = 's005';
	}
	if ($nomloc == "LOCAL6")
	{
		$columna = 's006';
	}
	if ($nomloc == "LOCAL7")
	{
		$columna = 's007';
	}
	if ($nomloc == "LOCAL8")
	{
		$columna = 's008';
	}
	if ($nomloc == "LOCAL9")
	{
		$columna = 's009';
	}
	if ($nomloc == "LOCAL10")
	{
		$columna = 's010';
	}
	if ($nomloc == "LOCAL11")
	{
		$columna = 's011';
	}
	if ($nomloc == "LOCAL12")
	{
		$columna = 's012';
	}
	if ($nomloc == "LOCAL13")
	{
		$columna = 's013';
	}
	if ($nomloc == "LOCAL14")
	{
		$columna = 's014';
	}
	if ($nomloc == "LOCAL15")
	{
		$columna = 's015';
	}
	if ($nomloc == "LOCAL16")
	{
		$columna = 's016';
	}
	if ($nomloc == "LOCAL17")
	{
		$columna = 's017';
	}
	if ($nomloc == "LOCAL18")
	{
		$columna = 's018';
	}
	if ($nomloc == "LOCAL19")
	{
		$columna = 's019';
	}
	if ($nomloc == "LOCAL20")
	{
		$columna = 's020';
    }
    
        ?>
        <div id="resultado" name="resultado">
            <b><u>DATOS DEL PREPEDIDO</u></b>
            <div>
                <div>CÓDIGO PRINCIPAL: <?php echo $idpreped; ?></div>
                <div><b>CÓDIGO DEL PREPEDIDO: <?php echo $numpagina; ?></b></div>
                <div>LOCAL: <?php echo $nomloc; ?></div>
                <div>FECHA DEL PREPEDIDO: <?php echo fecha($fecha); ?></div>
                <div></div>
            </div>
            <div>
                <input type="button" name="actualizar" value="Actualizar Prepedido" onclick="actualizar()" class="buscar"/>
            </div>
            <form id="form1" name="form2" method = "post" action="">
            <table width="930" border="1" align="center" id="tabDetalle" name="tabDetalle" cellpadding="0" cellspacing="0" style="
    margin-bottom: 10px;
">
                <thead>
                    <tr>
                    <th>Id</th>
                    <th>Producto</th>
                    <th>Laboratorio</th>
                    <th>Stock almacén central</th>
                    <th>Venta</th>
                    <th>Stock sucursal</th>
                    <th>Solicitado</th>
                    <th>Precio de venta</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $sql="SELECT * FROM detalle_prepedido DP, titultabladet TI, 
                    producto P where DP.idprod=P.codpro AND TI.codtab=P.codmar
                    AND DP.numpagina='$numpagina'
                    AND TI.tiptab='M' 
                    order by iddetalle asc";
                error_log($sql);
                $result = mysqli_query($conexion,$sql);
                $cont = 0;
                if (mysqli_num_rows($result)){
                    while ($row = mysqli_fetch_array($result)){
                        $iddetalle    = $row['iddetalle'];
                        $desprod    = $row['desprod'];
                        $abrev    = $row['abrev'];
                        $destab    = $row['destab'];
                        $idcantidad = $row['idcantidad'];
                        $solicitado = $row['solicitado'];
                        $stocentpro = (isset($row['s000']) ? $row['s000'] : 0);
                        $stopro = $row['stopro'];
						$stocklocal = $row[$columna];

                        $factor = $row['factor'];
                        $prevta = $row['prevta'];
                        /*if ($factor > 1)
                        {
                            $cantCaja       = $solicitado/$factor;
                            $div1X           = floor($convert1X);
                            $mult1X          = $factorX * $div1X;
                            $tot1X           = $StockActual - $mult1X;
                            $StockActual     = $div1X.' F '.$tot1X;
                        }*/
                        $cont++;
                ?>
                    <tr>
                    <td><?php echo $cont;?></td>
                    <td><?php echo $desprod;?></td>
                    <td><?php echo $abrev;?></td>
                    <td><?php echo $stocentpro;?></td>
                    <td><?php echo $idcantidad;?></td>
                    <td><?php echo $stocklocal;?></td>
                    <td><input id="text[<?php echo $iddetalle; ?>]" name="text[<?php echo $iddetalle; ?>]" type="text" value="<?php echo $solicitado;?>"></td>
                    <td><?php echo $prevta;?></td>
                    </tr>
                <?php 
                    }
                }
                ?>
                </tbody>
            </table>
            </form>
        </div>
        <?php 
                }
            }
        }
        ?>
  	  </div>
	</div>
   </div>
  </div>
</body>
</html>