<?php
include('../../session_user.php');
require_once('../../../conexion.php');
require_once('../../../titulo_sist.php');
require_once('../../../convertfecha.php');
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title><?php echo $desemp ?></title>
       <link href="css2/style1.css" rel="stylesheet" type="text/css" />
    </head>
    <?php
    require_once("../../../funciones/functions.php"); //DESHABILITA TECLAS
    require_once("../../../funciones/funct_principal.php"); //IMPRIMIR-NUME
    $sql = "SELECT nomusu FROM usuario where usecod = '$usuario'";
    $result = mysqli_query($conexion,$sql);
    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_array($result)) {
            $user = $row['nomusu'];
        }
    }
    $date = date('d/m/Y');
    $hour = date("G") - 5;
    $hour = CalculaHora($hour);
    $min = date("i");
    if ($hour <= 12) {
        $hor = "am";
    } else {
        $hor = "pm";
    }
    $val = $_REQUEST['val'];
    
    $local = $_REQUEST['local'];
    $det = $_REQUEST['det'];
    $ltdgen = $_REQUEST['ltdgen'];
  
    
    $doc 		= $_REQUEST['doc'];
    $ven 		= $_REQUEST['ven'];

    if ($local <> 'all') {
        $sql = "SELECT nomloc,nombre FROM xcompa where codloc = '$local'";
        $result = mysqli_query($conexion,$sql);
        if (mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_array($result)) {
                $nomloc = $row['nomloc'];
                $nombre = $row['nombre'];
            }
        }
        if ($nombre <> "") {
            $nomloc = $nombre;
        }
    }
    
  
    ?>
    <body>
        <table width="930" border="0" align="center">
            <tr>
                <td><table width="914" border="0">
                        <tr>
                            <td><strong><?php echo $desemp ?></strong></td>
                            <td><div align="center"><strong>LISTA COMPLETA DE CLIENTES EN <?php echo $desemp ?>  </strong></div></td>
                            <td>&nbsp;</td>
                            <td><div align="right"><strong>FECHA: <?php echo date('d/m/Y'); ?> - HORA : <?php echo $hour; ?>:<?php echo $min; ?> <?php echo $hor ?></strong></div></td>
                        </tr>
                        <tr>
                            <td width="361"><strong>PAGINA # </strong></td>
                            <td width="221"><div align="center">
<?php if ($local == 'all') {
    echo 'TODAS LAS SUCURSALES';
} else {
    echo $nomloc;
} ?>
                                </div></td>
                            <td width="30">&nbsp;</td>
                            <td width="284"><div align="right">USUARIO:<span class="text_combo_select"><?php echo $user ?></span> </div></td>
                        </tr>

                    </table>
                    <div align="center"><img src="../../../images/line2.png" width="910" height="4" /></div></td>
            </tr>
        </table>
        <?php
        if ($val == 1) {
            ?>
            <table width="926" border="0" align="center">
                <tr>
                    <td><div align="center"><strong> LISTA DE CLIENTES</strong></div></td>
                </tr>
            </table>
         <?php if ($ven == 2){?>
            
                
        <?php }else{?>

        
        
        
        
        
        
        
        
        <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <table width="100%" border="0" align="center">
                                <tr>
                                  
                                    <!--<td width="10"><strong>N&ordm;</strong></td>-->
                                    <td width="5"><strong>COD. CLI</strong></td>
                                    <td width="140"><strong>CLIENTE</strong></td>
                                    <td width="80"><div align="center"><strong>PROPIETARIO</strong></div></td>
                                    <td width="110" align="center"><strong>DIRECCION</strong></td>
                                    <td width="45"><strong>DNI</strong></td>
                                    <td width="40" align="center"><strong>RUC</strong></td>
                                    <td width="10"><div align="right"><strong>TELEFONO1</strong></div></td>
                                    <td width="10" align="right"><strong>TELEFONO2</strong></td>
                                    <td width="100" align="center"><strong>EMAIL</strong></td>
                                    <td width="5" align="right"><strong>PUNTOS</strong></td>
                                    
                                </tr>
                            </table></td>
                    </tr>
                </table>
                 <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <?php
                       $i=1;
                            if ($marca == 'all') {
                                //$sql1="SELECT codmar, codpro FROM detalle_venta inner join venta on detalle_venta.invnum = venta.invnum where venta.invfec between '$date1' and '$date2' and val_habil = '0' and invtot <> '0' group by codmar, codpro";
                                $sql1 = "SELECT codcli,descli,dircli,telcli,telcli1,contact,dnicli,ruccli,email,puntos FROM cliente ORDER BY codcli";
                            } else {
                                //$sql1="SELECT codmar, codpro FROM detalle_venta inner join venta on detalle_venta.invnum = venta.invnum where venta.invfec between '$date1' and '$date2' and codmar = '$marca' and val_habil = '0' and invtot <> '0' group by codmar, codpro";
                                $sql1 = "SELECT codcli,descli,dircli,telcli,telcli1,contact,dnicli,ruccli,email,puntos FROM cliente ORDER BY codcli";
                            }
                       
                        $result1 = mysqli_query($conexion,$sql1);
                        if (mysqli_num_rows($result1)) {
                        while ($row1 = mysqli_fetch_array($result1)) {
                            $codcli = $row1['codcli'];
                            $descli = $row1['descli'];
                            $dircli = $row1['dircli'];
                            $telcli = $row1['telcli'];
                            $telcli1 = $row1['telcli1'];
                            $contact = $row1['contact'];
                            $dnicli = $row1['dnicli'];
                            $ruccli = $row1['ruccli'];
                            $email = $row1['email'];
                            $puntos = $row1['puntos'];                               
                          

                                ?>
                                
                                <tr>

                                    <!--<td width="23"><?php echo $i ?></td>-->
                                    <td width="20"><div align="left"><?php echo $codcli ?></div></td>
                                    <td width="150"><div align="left"><?php echo $descli ?></div></td>
                                    <td width="80"><div align="left"><?php echo $contact ?></div></td>
                                     <td width="120"><div align="left"><?php echo $dircli ?></div></td>
                                      <td width="20"><div align="center"><?php echo $ruccli ?></div></td>
                                       <td width="20"><div align="right"><?php echo $dnicli ?></div></td>
                                        <td width="75"><div align="center"><?php echo $telcli ?></div></td>
                                         <td width="75"><div align="center"><?php echo $telcli1 ?></div></td>
                                  <td width="110"><div align="left"><?php echo $email ?></div></td>
                                   <td width="30"><div align="right"><?php echo $puntos ?></div></td>
                                 
                                </tr>
                                
                            <?php
                            
                            $i++;
                            }}/////CIERRO EL IF DE LA CONSULTA
                            
                        else {
                            ?><center>NO SE LOGRO ENCONTRAR INFORMACION CON LOS DATOS SELECCIONADOS</center>
        <?php }
        ?>  </tr>
                </table>
        
        
        
        <?php }?>
            
    <?php
    
               
                    
                    
                }
                ?>
    </body>
</html>
