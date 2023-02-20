<?php include('../../session_user.php');
require_once ('../../../conexion.php');
$invnum  = $_SESSION['transferencia_sal'];
////VERIFICO LOS DATOS DEL DOCUMENTO Y ESCOGO EL USUARIO Y SU LOCAL
$sql="SELECT numdoc FROM movmae where invnum = '$invnum'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
while ($row = mysqli_fetch_array($result)){
    	$numdoc    = $row['numdoc'];
}
}
?>
<script language="JavaScript">


function searchs2() {
        var f = document.form1;
        if (f.local.value == "")
        {
            alert("Seleccione un local");
            f.local.focus();
            return;
        }

        var prov = f.local.value;
        f.localrecargado.value = prov;
        f.method = "post";
        f.action = "transferencia1_sal.php";
        f.submit();
    }
    
function grabar1()
{
	  var f = document.form1;
	  if (f.referencia.value == "")
	  { alert("Ingrese una referencia"); f.referencia.focus(); return; }
	  if (f.vendedor.value == 0)
	  {
      //alert("Seleccione un Vendedor"); f.vendedor.focus(); return; 
	  }
	  if (f.mont2.value == "")
	  { alert("El sistema arroja un TOTAL = a 0. Revise por Favor!"); f.mont2.focus(); return; }
	  if (confirm("�Desea Grabar esta informacion?")) {
	  alert("EL NUMERO REGISTRADO ES "+<?php echo $numdoc?>);
	  f.method = "POST";
	  f.target = "_top";
	  f.action ="transferencia1_sal_reg.php";
	  f.submit();
	  }
}
function validar_prod(){
  var f = document.form1;
  var v3 = parseFloat(document.form1.stock.value);		//CANTIDAD ACTUAL POR LOCAL
  var v4 = parseFloat(document.form1.text1.value);		//CANTIDAD NGRESADA
  var factor = parseFloat(document.form1.factor.value);	//FACTOR
  if ((f.text1.value == "") || (f.text1.value == "0"))
  { alert("Ingrese una Cantidad"); f.text1.focus(); return; }
  var valor = isNaN(v4);
		if (valor == true)
		{
		    if(factor == 1){
                                alert("El Producto tiene factor 1 solo cantidad entera");
                                document.form1.text1.focus();
                                return;
                        }
		//var porcion = v1.substring(1); // porcion = "ndo"
		var v4 = document.form1.text1.value.substring(1);
		}
		else
		{
		v4 = v4 * factor;		////avisa que es numero
		}
  if (v4>v3)
  { alert("La cantidad Ingresada excede al Stock Actual del Producto"); f.text1.focus(); return; }
  f.method = "POST";
  f.target = "tranf_principal";
  f.action ="transferencia4_sal.php";
  f.submit();
}
function validar_grid(){
  var f = document.form1;
  f.method = "POST";
  f.action ="transferencia3_sal.php";
  f.submit();
}
function texto(){
		var v1 = parseFloat(document.form1.text1.value);		//CANTIDAD
	
		var factor = parseFloat(document.form1.factor.value);	//FACTOR
	    if(factor > 1){
		        var convert1 = v1 / factor;
		        var caja = parseInt((convert1));
                var unidad = (v1 - (caja * factor));
                var stocknuevo = caja  + F + unidad;
                 document.getElementById("campotexto").innerHTML = "eddddd";
		}else{
		        var convert1 = v1 / factor;
                var caja = parseInt((convert1));
                var stocknuevo = caja + C ;
                 document.getElementById("campotexto").innerHTML = "eddddd";
		}
       
	
	
	}	function precio(){
		var v1 = parseFloat(document.form1.text1.value);		//CANTIDAD
		var v2 = parseFloat(document.form1.text2.value);		//PRECIO PROMEDIO
		var factor = parseFloat(document.form1.factor.value);	//FACTOR
		
		
		
		var total;
		var valor = isNaN(v1);
		if (valor == true)
		{
		//var porcion = v1.substring(1); // porcion = "ndo"
		var porcion = document.form1.text1.value.substring(1);
		var fact	= parseFloat(porcion/factor);
		total   = parseFloat(fact * v2);
		document.form1.number.value=1;		////avisa que no es numero
		}
		else
		{
		total  = parseFloat(v1 * v2);
		document.form1.number.value=0;		////avisa que es numero
		}
		total = Math.round(total*Math.pow(10,2))/Math.pow(10,2); 
		///////////////////////////////////////////////////////////
		if(document.form1.text1.value!=''){
			document.form1.text3.value=total;
		}else{
			document.form1.text3.value='';
		}
		
		
}
function fc(){
document.form1.text1.focus();
}
function sf(){
document.form1.country.focus();
document.form1.first.disabled = true;
document.form1.next.disabled = true;
document.form1.prev.disabled = true;
document.form1.fin.disabled = true;
document.form1.nuevo.disabled = true;
document.form1.modif.disabled = true;
}
function links(){
document.getElementById('l1').focus()
}
</script>