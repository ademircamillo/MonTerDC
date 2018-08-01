<?php
function conectaBancoDados()
{
	include("config.php");
	$resultado = false;

	if (@mysql_connect($servidor, $usuarioBd, $senhaBd))
	{
		$resultado = true;
	}
	return $resultado;
}
function atualiza($tabela, $id, $campo, $valor)
{
	include("./config.php");
	if (!conectaBancoDados())
		print("<center><strong>Nao foi possível estabelecer conexao com o Banco de Dados!</strong></center>");
	else
	{
		if($id!="")
			$comando = "UPDATE $tabela SET $campo='$valor', dataAtualizacao=now() WHERE id='$id'";
		else
			$comando = "INSERT INTO $tabela($campo, dataAtualizacao) VALUES('$valor', now())";
		//echo $comando;
		$dados = mysql_db_query($bancoDados, $comando);
		if ($dados)
		{
			return true;
		}
	}
	return false;
}
function devolveIp()
{
	include("./config.php");
	if (!conectaBancoDados())
		print("<center><strong>Nao foi possível estabelecer conexao com o Banco de Dados!</strong></center>");
	else
	{
		$comando = "SELECT ip FROM ip WHERE id = '1'";
		$dados = mysql_db_query($bancoDados, $comando);
		if ($linha = mysql_fetch_array($dados))
		{
			return $linha[ip];
		}
	}
	return false;
}
function devolveAtualizacao()
{
	include("./config.php");
	if (!conectaBancoDados())
		print("<center><strong>Nao foi possível estabelecer conexao com o Banco de Dados!</strong></center>");
	else
	{
		$comando = "SELECT date_format(dataAtualizacao, '%d/%m/%Y %H:%i:%s') as datac FROM ip WHERE id = '1'";
		$dados = mysql_db_query($bancoDados, $comando);
		if ($linha = mysql_fetch_array($dados))
		{
			return $linha[datac];
		}
	}
	return "false";
}

function atualizaHistorico($novo, $temp, $armado, $disparo, $ad, $t, $h)
{
	include("./config.php");
	if (!conectaBancoDados())
		print("<center><strong>Nao foi possível estabelecer conexao com o Banco de Dados!</strong></center>");
	else
	{
		$comando = "INSERT INTO historico(novoStatus, temp, armado, disparo, ad, dataAtualizacao, tExt, hExt) VALUES('$novo', '$temp', '$armado', '$disparo', '$ad', now(), '$t', '$h')";
		//echo $comando;
		$dados = mysql_db_query($bancoDados, $comando);
		if ($dados)
		{
			return true;
		}
	}
	return false;
}
function sendMail($to, $ton, $from, $fromn, $subject, $msg,$anexo="",$anexo2="",$anexo3="")
{
	include("config.php");
	if(file_exists("../mail/class.phpmailer.php"))
		require_once('../mail/class.phpmailer.php');
	else
		require_once("mail/class.phpmailer.php");

	$mail = new PHPMailer();

	$mail->IsSMTP();
	$mail->Host       = "$smtpServer";
	$mail->SMTPDebug  = 0;
	$mail->SMTPAuth   = true;
	$mail->Host       = "$smtpServer";
	$mail->Port       = 587;
	$mail->Username   = "$smtpUsuario";
	$mail->Password   = "$smtpSenha";

	if($fromn=="") $fromn = $from;
	$mail->SetFrom("$from", "$fromn");
	$mail->AddReplyTo("$from","$fromn");

	$mail->Subject    = "$subject";

	$mail->MsgHTML($msg);

	if($ton=="") $ton = $to;
	$address = "$to";
	$mail->AddAddress($address, "$ton");

	if($anexo!="")
		$mail->AddAttachment($anexo);
	if($anexo2!="")
		$mail->AddAttachment($anexo2);
	if($anexo3!="")
		$mail->AddAttachment($anexo3);

	if(!$mail->Send())
		return false;
	else
	 	return true;
}

function query($sql, $campo)
{
	include("./config.php");
	if (!conectaBancoDados())
		print("<center><strong>Nao foi possível estabelecer conexao com o Banco de Dados!</strong></center>");
	else
	{
		$comando = "$sql";
		$dados = mysql_db_query($bancoDados, $comando);
		if ($linha = mysql_fetch_array($dados))
		{
			return $linha["$campo"];
		}
	}
	return "";
}

function graficoDevolveDatas()
{
	include("./config.php");
	if (!conectaBancoDados())
		print("<center><strong>Nao foi possível estabelecer conexao com o Banco de Dados!</strong></center>");
	else
	{
		$comando = "SELECT date_format(dataAtualizacao, '%d/%m/%Y') as diasG, date_format(dataAtualizacao, '%d/%m') as dias FROM historico GROUP BY diasG ORDER BY dataAtualizacao DESC LIMIT 10";
		$dados = mysql_db_query($bancoDados, $comando);
		$linha = mysql_fetch_array($dados);
		$retorno = '"'.$linha['dias'].'"';
		while ($linha = mysql_fetch_array($dados))
		{
			$retorno = '"'.$linha[dias].'",'.$retorno;
			
		}
		return $retorno;
	}
	return "false";
}

function graficoDevolveValores($campo)
{
	include("./config.php");
	if (!conectaBancoDados())
		print("<center><strong>Nao foi possível estabelecer conexao com o Banco de Dados!</strong></center>");
	else
	{
		$comando = "SELECT ROUND(AVG($campo),2) as media, date_format(dataAtualizacao, '%d/%m/%Y') as diasG, date_format(dataAtualizacao, '%d/%m') as dias FROM historico GROUP BY diasG ORDER BY dataAtualizacao DESC LIMIT 10";
		$dados = mysql_db_query($bancoDados, $comando);
		$linha = mysql_fetch_array($dados);
		if($linha[media]=="")
			$linha[media] = 0.00;
		$retorno = $linha[media];
		while ($linha = mysql_fetch_array($dados))
		{
			if($linha[media]=="")
				$linha[media] = 0.00;
			$retorno = $linha[media].','.$retorno;
			
		}
		return $retorno;
	}
	return "false";
}

function graficoDevolveDatasDia()
{
	include("./config.php");
	if (!conectaBancoDados())
		print("<center><strong>Nao foi possível estabelecer conexao com o Banco de Dados!</strong></center>");
	else
	{	
		$hoje = date("Y-m-d");
		$comando = "SELECT date_format(dataAtualizacao, '%H') as diasG, date_format(dataAtualizacao, '%Hh') as dias FROM historico WHERE dataAtualizacao LIKE '%$hoje%' GROUP BY diasG ORDER BY dias DESC LIMIT 24";
		$dados = mysql_db_query($bancoDados, $comando);
		$linha = mysql_fetch_array($dados);
		$retorno = '"'.$linha['dias'].'"';
		while ($linha = mysql_fetch_array($dados))
		{
			$retorno = '"'.$linha[dias].'",'.$retorno;
			
		}
		return $retorno;
	}
	return "false";
}

function graficoDevolveValoresDia($campo)
{
	include("./config.php");
	if (!conectaBancoDados())
		print("<center><strong>Nao foi possível estabelecer conexao com o Banco de Dados!</strong></center>");
	else
	{
		$hoje = date("Y-m-d");
		$comando = "SELECT ROUND(AVG($campo),2) as media, date_format(dataAtualizacao, '%H') as diasG, date_format(dataAtualizacao, '%H') as dias FROM historico WHERE dataAtualizacao LIKE '%$hoje%' GROUP BY diasG ORDER BY dias DESC LIMIT 24";
		$dados = mysql_db_query($bancoDados, $comando);
		$linha = mysql_fetch_array($dados);
		if($linha[media]=="")
			$linha[media] = 0.00;
		$retorno = $linha[media];
		while ($linha = mysql_fetch_array($dados))
		{
			if($linha[media]=="")
				$linha[media] = 0.00;
			$retorno = $linha[media].','.$retorno;
			
		}
		return $retorno;
	}
	return "false";
}


function graficoDevolveValoresTempo($campo)
{
	include("./config.php");
	if (!conectaBancoDados())
		print("<center><strong>Nao foi possível estabelecer conexao com o Banco de Dados!</strong></center>");
	else
	{
		$comando = "SELECT ROUND(SUM(IF(armado='$campo', 1, 0))*24/SUM(IF(armado='$campo', 1, 1))) as media, date_format(dataAtualizacao, '%d/%m/%Y') as diasG, date_format(dataAtualizacao, '%d/%m') as dias FROM historico GROUP BY diasG ORDER BY dataAtualizacao DESC LIMIT 10";
		$dados = mysql_db_query($bancoDados, $comando);
		$linha = mysql_fetch_array($dados);
		if($linha[media]=="")
			$linha[media] = 0;
		$retorno = $linha[media];
		while ($linha = mysql_fetch_array($dados))
		{
			if($linha[media]=="")
				$linha[media] = 0;
			$retorno = $linha[media].','.$retorno;
			
		}
		return $retorno;
	}
	return "false";
}

function graficoDevolveValoresTempoPie($campo)
{
	include("./config.php");
	if (!conectaBancoDados())
		print("<center><strong>Nao foi possível estabelecer conexao com o Banco de Dados!</strong></center>");
	else
	{
		$comando = "SELECT ROUND(SUM(IF(armado='$campo', 1, 0))*24/SUM(IF(armado='$campo', 1, 1))) as media, date_format(dataAtualizacao, '%d/%m/%Y') as diasG, date_format(dataAtualizacao, '%d/%m') as dias FROM historico GROUP BY diasG ORDER BY dataAtualizacao DESC LIMIT 10";
		$dados = mysql_db_query($bancoDados, $comando);
		$linha = mysql_fetch_array($dados);
		if($linha[media]=="")
			$linha[media] = 0;
		$retorno = $linha[media];
		while ($linha = mysql_fetch_array($dados))
		{
			if($linha[media]=="")
				$linha[media] = 0;
			$retorno += $linha[media];
			
		}
		return $retorno;
	}
	return "false";
}

function graficoEnergiaDevolveDatas()
{
	include("./config.php");
	if (!conectaBancoDados())
		print("<center><strong>Nao foi possível estabelecer conexao com o Banco de Dados!</strong></center>");
	else
	{
		$comando = "SELECT date_format(dataAtualizacao, '%d/%m/%Y') as diasG, date_format(dataAtualizacao, '%d/%m') as dias FROM dados_energia GROUP BY diasG ORDER BY dataAtualizacao DESC LIMIT 10";
		$dados = mysql_db_query($bancoDados, $comando);
		$linha = mysql_fetch_array($dados);
		$retorno = '"'.$linha['dias'].'"';
		while ($linha = mysql_fetch_array($dados))
		{
			$retorno = '"'.$linha[dias].'",'.$retorno;
			
		}
		return $retorno;
	}
	return "false";
}

function graficoEnergiaDevolveValores()
{
	include("./config.php");
	if (!conectaBancoDados())
		print("<center><strong>Nao foi possível estabelecer conexao com o Banco de Dados!</strong></center>");
	else
	{
		$comando = "SELECT ROUND(AVG(watts1F)+AVG(watts2F),0) as media, date_format(dataAtualizacao, '%d/%m/%Y') as diasG, date_format(dataAtualizacao, '%d/%m') as dias FROM dados_energia GROUP BY diasG ORDER BY dataAtualizacao DESC LIMIT 10";
		$dados = mysql_db_query($bancoDados, $comando);
		$linha = mysql_fetch_array($dados);
		if($linha[media]=="")
			$linha[media] = 0.00;
		$retorno = $linha[media];
		while ($linha = mysql_fetch_array($dados))
		{
			if($linha[media]=="")
				$linha[media] = 0.00;
			$retorno = $linha[media].','.$retorno;
			
		}
		return $retorno;
	}
	return "false";
}

function graficoEnergiaDevolveDatasDia()
{
	include("./config.php");
	if (!conectaBancoDados())
		print("<center><strong>Nao foi possível estabelecer conexao com o Banco de Dados!</strong></center>");
	else
	{
		$hoje=date("Y-m-d");
		$comando = "SELECT date_format(dataAtualizacao, '%H') as horas FROM dados_energia WHERE dataAtualizacao LIKE '$hoje%' GROUP BY horas ORDER BY horas DESC LIMIT 24";
		$dados = mysql_db_query($bancoDados, $comando);
		$linha = mysql_fetch_array($dados);
		$retorno = '"'.$linha['horas'].':00"';
		while ($linha = mysql_fetch_array($dados))
		{
			$retorno = '"'.$linha[horas].':00",'.$retorno;
			
		}
		return $retorno;
	}
	return "false";
}

function graficoEnergiaDevolveValoresDia()
{
	include("./config.php");
	if (!conectaBancoDados())
		print("<center><strong>Nao foi possível estabelecer conexao com o Banco de Dados!</strong></center>");
	else
	{
		$hoje=date("Y-m-d");
		$comando = "SELECT ROUND(AVG(watts1F)+AVG(watts2F),0) as media, date_format(dataAtualizacao, '%H') as horas FROM dados_energia WHERE dataAtualizacao LIKE '$hoje%' GROUP BY horas ORDER BY horas DESC LIMIT 24";
		$dados = mysql_db_query($bancoDados, $comando);
		$linha = mysql_fetch_array($dados);
		if($linha[media]=="")
			$linha[media] = 0.00;
		$retorno = $linha[media];
		while ($linha = mysql_fetch_array($dados))
		{
			if($linha[media]=="")
				$linha[media] = 0.00;
			$retorno = $linha[media].','.$retorno;
			
		}
		return $retorno;
	}
	return "false";
}

function graficoDevolveValoresConsumo($inicio, $fim)
{
	include("./config.php");
	if (!conectaBancoDados())
		print("<center><strong>Nao foi possível estabelecer conexao com o Banco de Dados!</strong></center>");
	else
	{
		$cont = 0;
		$comando = "SELECT ROUND(AVG(watts1F)+AVG(watts2F),0) as media, date_format(dataAtualizacao, '%d/%m/%Y') as dia FROM dados_energia GROUP BY dia LIMIT $inicio, $fim";
		$dados = mysql_db_query($bancoDados, $comando);
		while ($linha = mysql_fetch_array($dados))
		{
			$soma=$soma+$linha[media];
			$cont++;	
		}
		if($soma>0)
			$soma=$soma/$cont;
		else
			$soma=0;
		return $soma/1000;
	}
	return "false";
}

function graficoDevolveValoresConsumoAtual()
{
	include("./config.php");
	if (!conectaBancoDados())
		print("<center><strong>Nao foi possível estabelecer conexao com o Banco de Dados!</strong></center>");
	else
	{
		$comando = "SELECT ROUND(watts1F+watts2F,0) as media FROM dados_energia ORDER BY id DESC LIMIT 1";
		$dados = mysql_db_query($bancoDados, $comando);
		if ($linha = mysql_fetch_array($dados))
		{
			return $linha[media]/1000;
		}
		return 0;
	}
	return "false";
}

function atualizaEnergia($token, $corrente1F, $watts1F, $voltagem1F, $corrente2F, $watts2F, $voltagem2F)
{
	include("./config.php");
	if (!conectaBancoDados())
		print("<center><strong>Nao foi possível estabelecer conexao com o Banco de Dados!</strong></center>");
	else
	{
		$comando = "INSERT INTO dados_energia(tokenDispositivo, idSensor, corrente1F, watts1F, voltagem1F, corrente2F, watts2F, voltagem2F, dataAtualizacao) 
					VALUES('$token', '5','$corrente1F', '$watts1F', '$voltagem1F','$corrente2F', '$watts2F', '$voltagem2F', now())";
		//echo $comando;
		$dados = mysql_db_query($bancoDados, $comando);
		if ($dados)
		{
			return true;
		}
	}
	return false;
}

function graficoEnergiaDevolveDatas24()
{
	include("./config.php");
	if (!conectaBancoDados())
		print("<center><strong>Nao foi possível estabelecer conexao com o Banco de Dados!</strong></center>");
	else
	{
		$hoje=date("Y-m-d");
		$hora=date("H");
		$comando = "SELECT date_format(dataAtualizacao, '%i') as minutos FROM dados_energia WHERE dataAtualizacao LIKE '$hoje%' AND date_format(dataAtualizacao, '%H') = '$hora' GROUP BY minutos ORDER BY minutos DESC LIMIT 60";
//		echo $comando;
		$dados = mysql_db_query($bancoDados, $comando);
		$linha = mysql_fetch_array($dados);
		$retorno = '"'.$hora.':'.$linha['minutos'].'"';
		while ($linha = mysql_fetch_array($dados))
		{
			$retorno = '"'.$hora.':'.$linha[minutos].'",'.$retorno;
			
		}
		return $retorno;
	}
	return "false";
}

function graficoEnergiaDevolveValores24()
{
	include("./config.php");
	if (!conectaBancoDados())
		print("<center><strong>Nao foi possível estabelecer conexao com o Banco de Dados!</strong></center>");
	else
	{
		$hoje=date("Y-m-d");
		$hora=date("H");
		$comando = "SELECT ROUND(AVG(watts1F)+AVG(watts2F),0) as media, date_format(dataAtualizacao, '%i') as minutos FROM dados_energia WHERE dataAtualizacao LIKE '$hoje%' AND date_format(dataAtualizacao, '%H') = '$hora' GROUP BY minutos ORDER BY minutos DESC LIMIT 60";
//		echo $comando;
		$dados = mysql_db_query($bancoDados, $comando);
		$linha = mysql_fetch_array($dados);
		if($linha[media]=="")
			$linha[media] = 0.00;
		$retorno = $linha[media];
		while ($linha = mysql_fetch_array($dados))
		{
			if($linha[media]=="")
				$linha[media] = 0.00;
			$retorno = $linha[media].','.$retorno;
			
		}
		return $retorno;
	}
	return "false";
}

function graficoTemperaturaDevolveDatas24()
{
	include("./config.php");
	if (!conectaBancoDados())
		print("<center><strong>Nao foi possível estabelecer conexao com o Banco de Dados!</strong></center>");
	else
	{
		$hoje=date("Y-m-d");
		$hora=date("H");
		$comando = "SELECT date_format(dataAtualizacao, '%i') as minutos FROM sensores WHERE dataAtualizacao LIKE '$hoje%' AND date_format(dataAtualizacao, '%H') = '$hora' GROUP BY minutos ORDER BY minutos DESC LIMIT 60";
//		echo $comando;
		$dados = mysql_db_query($bancoDados, $comando);
		$linha = mysql_fetch_array($dados);
		$retorno = '"'.$hora.':'.$linha['minutos'].'"';
		while ($linha = mysql_fetch_array($dados))
		{
			$retorno = '"'.$hora.':'.$linha[minutos].'",'.$retorno;
			
		}
		return $retorno;
	}
	return "false";
}



function graficoTemperaturaDevolveValores24($sensor)
{
	include("./config.php");
	if (!conectaBancoDados())
		print("<center><strong>Nao foi possível estabelecer conexao com o Banco de Dados!</strong></center>");
	else
	{
		$hoje=date("Y-m-d");
		$hora=date("H");
		$comando = "SELECT ROUND(AVG($sensor),2) as media, date_format(dataAtualizacao, '%i') as minutos FROM sensores WHERE dataAtualizacao LIKE '$hoje%' AND date_format(dataAtualizacao, '%H') = '$hora' GROUP BY minutos ORDER BY minutos DESC LIMIT 60";
//		echo $comando;
		$dados = mysql_db_query($bancoDados, $comando);
		$linha = mysql_fetch_array($dados);
		if($linha[media]=="")
			$linha[media] = 0.00;
		$retorno = $linha[media];
		while ($linha = mysql_fetch_array($dados))
		{
			if($linha[media]=="")
				$linha[media] = 0.00;
			$retorno = $linha[media].','.$retorno;
			
		}
		return $retorno;
	}
	return "false";
}

function graficoTemperaturaDevolveDatasDia()
{
	include("./config.php");
	if (!conectaBancoDados())
		print("<center><strong>Nao foi possível estabelecer conexao com o Banco de Dados!</strong></center>");
	else
	{
		$hoje=date("Y-m-d");
		$comando = "SELECT date_format(dataAtualizacao, '%H') as horas FROM dados_sensor WHERE idSensor='2' AND dataAtualizacao LIKE '$hoje%' GROUP BY horas ORDER BY horas DESC LIMIT 24";
		$dados = mysql_db_query($bancoDados, $comando);
		$linha = mysql_fetch_array($dados);
		$retorno = '"'.$linha['horas'].':00"';
		while ($linha = mysql_fetch_array($dados))
		{
			$retorno = '"'.$linha[horas].':00",'.$retorno;
			
		}
		return $retorno;
	}
	return "false";
}

function graficoTemperaturaDevolveValoresDia()
{
	include("./config.php");
	if (!conectaBancoDados())
		print("<center><strong>Nao foi possível estabelecer conexao com o Banco de Dados!</strong></center>");
	else
	{
		$hoje=date("Y-m-d");
		$comando = "SELECT ROUND(AVG(valor),2) as media, date_format(dataAtualizacao, '%H') as horas FROM dados_sensor WHERE idSensor='2' AND dataAtualizacao LIKE '$hoje%' GROUP BY horas ORDER BY horas DESC LIMIT 24";
		$dados = mysql_db_query($bancoDados, $comando);
		$linha = mysql_fetch_array($dados);
		if($linha[media]=="")
			$linha[media] = 0.00;
		$retorno = $linha[media];
		while ($linha = mysql_fetch_array($dados))
		{
			if($linha[media]=="")
				$linha[media] = 0.00;
			$retorno = $linha[media].','.$retorno;
			
		}
		return $retorno;
	}
	return "false";
}

function atualizaAlarme($token, $led, $sirene, $voltagem, $temperatura)
{
	include("./config.php");
	if (!conectaBancoDados())
		print("<center><strong>Nao foi possível estabelecer conexao com o Banco de Dados!</strong></center>");
	else
	{
		$comando = "INSERT INTO dados_alarme(tokenDispositivo, idSensor, armado, disparado, bateria, temperatura, dataAtualizacao) 
					VALUES('$token', '9','$led', '$sirene', '$voltagem','$temperatura', now())";
		//echo $comando;
		$dados = mysql_db_query($bancoDados, $comando);
		if ($dados)
		{
			return true;
		}
	}
	return false;
}

function devolveStatusAlarme()
{
	include("./config.php");
	if (!conectaBancoDados())
		print("<center><strong>Nao foi possível estabelecer conexao com o Banco de Dados!</strong></center>");
	else
	{
		$comando = "SELECT * FROM dados_alarme ORDER BY id DESC LIMIT 1";
		//echo $comando;
		$dados = mysql_db_query($bancoDados, $comando);
		if ($dados)
		{
			if ($linha = mysql_fetch_array($dados))
			{
				if($linha['armado']=="1")
					echo "Armado";
				else
					echo "Desarmado";
			}
		}
	}
	return false;
}

function devolveHistoricoAlarme()
{
	include("./config.php");
	if (!conectaBancoDados())
		print("<center><strong>Nao foi possível estabelecer conexao com o Banco de Dados!</strong></center>");
	else
	{
		$comando = "SELECT * FROM dados_alarme ORDER BY id DESC LIMIT 1";
		//echo $comando;
		$dados = mysql_db_query($bancoDados, $comando);
		if ($dados)
		{
			if ($linha = mysql_fetch_array($dados))
			{
				if($linha['armado']=="1")
					echo "Armado";
				else
					echo "Desarmado";
			}
		}
	}
	return false;
}

function atualizaSensor($token, $s1, $s2, $s3, $s4, $s5, $s6, $s7, $s8, $s9, $s10, $s11, $s12, $s13, $s14)
{
	include("./config.php");
	if (!conectaBancoDados())
		print("<center><strong>Nao foi possível estabelecer conexao com o Banco de Dados!</strong></center>");
	else
	{
		$comando = "INSERT INTO sensores(tokenDispositivo, s1, s2, s3, s4, s5, s6, s7, s8, s9, s10, s11, s12, s13, s14, dataAtualizacao) 
					VALUES('$token', '$s1', '$s2', '$s3', '$s4', '$s5', '$s6', '$s7', '$s8', '$s9', '$s10', '$s11', '$s12', '$s13', '$s14', now())";
		//echo $comando;
		$dados = mysql_db_query($bancoDados, $comando);
		if ($dados)
		{
			return true;
		}
	}
	return false;
}

function atualizaConsumo($token, $consumo)
{
	include("./config.php");
	if (!conectaBancoDados())
		print("<center><strong>Nao foi possível estabelecer conexao com o Banco de Dados!</strong></center>");
	else
	{
		$comando = "INSERT INTO energia(tokenDispositivo, consumo, dataAtualizacao) 
					VALUES('$token', '$consumo', now())";
		//echo $comando;
		$dados = mysql_db_query($bancoDados, $comando);
		if ($dados)
		{
			return true;
		}
	}
	return false;
}


function devolveJson()
{
	include("./config.php");
	if (!conectaBancoDados())
		print("<center><strong>Nao foi possível estabelecer conexao com o Banco de Dados!</strong></center>");
	else
	{
		$comando = "SELECT *, date_format(dataAtualizacao,'%d/%m/%Y %H:%i:%s') as datahora FROM sensores ORDER BY dataAtualizacao DESC LIMIT 1";
$dados = mysql_db_query($bancoDados, $comando);
		if ($linha = mysql_fetch_array($dados))
		{
			echo 
                        '{<BR>
                          "data_hora":"'.$linha[datahora].'",<BR>
                          "s1":"'.$linha[s1].'",<BR>
                          "s2":"'.$linha[s2].'",<BR>
                          "s3":"'.$linha[s3].'",<BR>
                          "s4":"'.$linha[s4].'",<BR>
                          "s5":"'.$linha[s5].'",<BR>
                          "s6":"'.$linha[s6].'",<BR>
                          "s7":"'.$linha[s7].'",<BR>
                          "s8":"'.$linha[s8].'",<BR>
                          "s9":"'.$linha[s9].'",<BR>
                          "s10":"'.$linha[s10].'",<BR>
                          "s11":"'.$linha[s11].'",<BR>
                          "s12":"'.$linha[s12].'",<BR>
                          "s13":"'.$linha[s13].'",<BR>
                          "s14":"'.$linha[s14].'"<BR>
                        }'
                        ;
			
		}
	}
}
?>