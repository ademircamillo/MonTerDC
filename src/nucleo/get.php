<?php
	include("config.php");
	include("func.php");
	$log_a = "";
    foreach ($_GET as $key => $value) {
        $log_a .= " [".$key."] => ".$value."\n\r";
    }
	atualiza("logdados","" , "texto", $log_a);
if($_GET['s1']>0)
{	
   atualizaSensor($_GET['tokenDispositivo'], $_GET['s1'], $_GET['s2'], $_GET['s3'], $_GET['s4'], $_GET['s5'], $_GET['s6'], $_GET['s7'], $_GET['s8'], $_GET['s9'], $_GET['s10'], $_GET['s11'], $_GET['s12'], $_GET['s13'], $_GET['s14']);
}
	if($_GET['consumo']>0)
{
   atualizaConsumo($_GET['tokenDispositivo'], $_GET['consumo']);
}
echo "OK";
?>	