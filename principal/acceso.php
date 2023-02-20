<?php include('session_user.php');

$sql="SELECT codgrup FROM usuario where usecod = '$usuario'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	while ($row = mysqli_fetch_array($result)){
			$codgrup    = $row['codgrup'];
	}
}

$a1=0;
$a2=0;
$a3=0;
$a4=0;
$a5=0;
$a6=0;
$a7=0;
$a8=0;
$a9=0;
$a10=0;
$a11=0;
$a12=0;
$a13=0;
$a14=0;
$a15=0;
$a16=0;
$a17=0;
$a18=0;
$a19=0;
$a20=0;
$a21=0;
$a22=0;
$a23=0;
$m1=0;
$m2=0;
$m3=0;
$m4=0;
$m5=0;
$f1=0;
$f2=0;
$u1=0;
$u2=0;
$u3=0;
$u4=0;
$r1=0;
$r2=0;
$r3=0;
$r4=0;
$r5=0;
$r6=0;
$r7=0;
$r8=0;
$r9=0;
$r10=0;
$r11=0;
$r12=0;
$r13=0;
$r14=0;
$r15=0;
$r16=0;
$r17=0;
$r18=0;
$r19=0;
$r20=0;
$r30=0;
$c1=0;
$c2=0;
$c3=0;
$c4=0;
$c5=0;
$c6=0;
$c7=0;
$c8=0;
$c9=0;
$c10=0;

/*
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$accesos = mysqli_fetch_all($result);
}

error_log("accesos:" . print_r($accesos));
*/
/////ARCHIVOS//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////ITEM = A1
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'A1' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$a1 = 1; 
}
//////ITEM = A2
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'A2' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$a2 = 1; 
}

//////ITEM = A3
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'A3' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$a3 = 1; 
}

//////ITEM = A4
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'A4' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$a4 = 1; 
}

//////ITEM = A5
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'A5' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$a5 = 1; 
}

//////ITEM = A6
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'A6' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$a6 = 1; 
}

//////ITEM = A7
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'A7' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$a7 = 1; 
}

//////ITEM = A8
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'A8' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$a8 = 1; 
}

//////ITEM = A9
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'A9' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$a9 = 1; 
}

//////ITEM = A10
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'A10' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$a10 = 1; 
}

//////ITEM = A11
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'A11' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$a11 = 1; 
}

//////ITEM = A12
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'A12' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$a12 = 1; 
}

//////ITEM = A13
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'A13' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$a13 = 1; 
}

//////ITEM = A14
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'A14' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$a14 = 1; 
}

//////ITEM = A15
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'A15' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$a15 = 1; 
}

//////ITEM = A16
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'A16' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$a16 = 1; 
}


//////ITEM = A17
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'A17' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$a17 = 1; 
}

//////ITEM = A18
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'A18' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$a18 = 1; 
}


//////ITEM = A19
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'A19' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$a19 = 1; 
}

//////ITEM = A21
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'A21' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$a21 = 1; 
}

//////ITEM = A22
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'A22' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$a22 = 1; 
}

//////ITEM = A23
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'A23' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$a23 = 1; 
}

/////MOVIMIENTOS//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////ITEM = M1
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'M1' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$m1 = 1; 
}

//////ITEM = M2
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'M2' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$m2 = 1; 
}

//////ITEM = M3
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'M3' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$m3 = 1; 
}

//////ITEM = M4
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'M4' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$m4 = 1; 
}

//////ITEM = M5
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'M5' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$m5 = 1; 
}

/////FINANZAS//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////ITEM = F1
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'F1' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$f1 = 1; 
}

//////ITEM = F2
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'F2' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$f2 = 1; 
}

/////AUDITOR//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////ITEM = U1
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'U1' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$u1 = 1; 
}

//////ITEM = U2
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'U2' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$u2 = 1; 
}

//////ITEM = U3
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'U3' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$u3 = 1; 
}

//////ITEM = U4
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'U4' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$u4 = 1; 
}

/////REPORTES//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////ITEM = R1
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'R1' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$r1 = 1; 
}

//////ITEM = R2
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'R2' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$r2 = 1; 
}

//////ITEM = R3
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'R3' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$r3 = 1; 
}

//////ITEM = R4
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'R4' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$r4 = 1; 
}

//////ITEM = R5
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'R5' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$r5 = 1; 
}

//////ITEM = R6
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'R6' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$r6 = 1; 
}

//////ITEM = R7
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'R7' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$r7 = 1; 
}

//////ITEM = R8
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'R8' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$r8 = 1; 
}

//////ITEM = R9
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'R9' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$r9 = 1; 
}

//////ITEM = R10
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'R10' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$r10 = 1; 
}

//////ITEM = R11
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'R11' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$r11 = 1; 
}

//////ITEM = R12
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'R12' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$r12 = 1; 
}

//////ITEM = R13
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'R13' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$r13 = 1; 
}

//////ITEM = R14
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'R14' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$r14 = 1; 
}

//////ITEM = R15
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'R15' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$r15 = 1; 
}

//////ITEM = R16
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'R16' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$r16 = 1; 
}

//////ITEM = R17
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'R17' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$r17 = 1; 
}

//////ITEM = R17
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'R18' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$r18 = 1; 
}

//////ITEM = R19
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'R19' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$r19 = 1; 
}

//////ITEM = R20
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'R20' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$r20 = 1; 
}
//////ITEM = R30
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'R30' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$r30 = 1; 
}

/////CONFIGURACION/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////ITEM = C1
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'C1' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$c1 = 1; 
}

//////ITEM = C2
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'C2' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$c2 = 1; 
}

//////ITEM = C3
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'C3' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$c3 = 1; 
}

//////ITEM = C4
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'C4' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$c4 = 1; 
}

//////ITEM = C5
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'C5' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$c5 = 1; 
}

//////ITEM = C6
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'C6' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$c6 = 1; 
}

//////ITEM = C7
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'C7' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$c7 = 1; 
}

//////ITEM = C8
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'C8' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$c8 = 1; 
}

//////ITEM = C9
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'C9' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$c9 = 1; 
}

//////ITEM = C10
$sql="SELECT acceso.idacceso FROM acceso inner join detalle_acceso on acceso.idacceso = detalle_acceso.idacceso where item = 'C10' and codgrup = '$codgrup'";
$result = mysqli_query($conexion,$sql);
if (mysqli_num_rows($result)){
	$c10 = 1; 
}

?>