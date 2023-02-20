<script language="JavaScript">
// Emite un post para el formulario
function grabar()
{
	var f = document.form1;
	f.method = "POST";
	f.submit();
}
// Emite un post pero cambiando el destino de form para el "index.php" superior (salida)
function salir()
{
	 var f = document.form1;
	 f.method = "POST";
	 f.target = "_top";
	 f.action ="../index.php";
	 f.submit();
}
// Emite un post cambiando la salida a "ing_salid2.php" siempre que se marque un "radio button"
function validar()
{
	var f = document.form1;
	var i;
	var c;
	// Valida marca del check box
	for (i=0;i<document.form1.rd.length;i++){
		if (document.form1.rd[i].checked)
		{
			c=1; 
		}
	}
	// Si radio button marcado, ir a ing_salida2.php
	if(c==1)
	{
		f.method = "POST";
		f.action ="ing_salid2.php";
		f.submit();
	}
	else // pide al usuario que elija
	{
		alert("Seleccione una Opcion"); f.rd.focus(); return;
	}
}
</script>