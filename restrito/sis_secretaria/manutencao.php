<?php
/**********************************************************************************
Sistema e-SIC Livre: sistema de acesso a informação baseado na lei de acesso.

Copyright (C) 2014 Prefeitura Municipal do Natal

Este programa é software livre; você pode redistribuí-lo e/ou
modificá-lo sob os termos da Licença GPL2.
***********************************************************************************/

	include_once("../inc/autenticar.php");

  //recupera valores do formulario
  $idsecretaria = null;
  $nome = null;
  $sigla = null;
  $responsavel = null;
  $telefonecontato = null;
  $ativado = null;
  $emailsic = null;
  $siccentral = null;

	//função de validação dos dados do formulario do cadastro de usuario -------------------
	function validaDados()
	{
		global $erro;
		global $acao;
		global $idsecretaria;
		global $nome;
		global $sigla;
		global $telefonecontato;
		global $ativado;
		global $emailsic;
		global $siccentral;

		if (empty($nome))
		{
			$erro = "Nome não informado.";
			return false;
		}
		elseif (empty($sigla))
		{
			$erro = "Sigla não informada.";
			return false;
		}

		if(empty($ativado)) $ativado = "0";

                if(empty($siccentral)) $siccentral = "0";

		//verifica se ja existe registro cadastrado com a informa�ao passada ---

		if ($acao=="Incluir")
			$sql = "select * from sis_secretaria where sigla = '$sigla'";
		else
			$sql = "select * from sis_secretaria where sigla = '$sigla' and idsecretaria <> $idsecretaria";

		if(mysqli_num_rows(execQuery($sql)) > 0)
		{
			$erro = "Já existe SIC cadastrada com a sigla informada";
			return false;
		}
		//-----------------------------------------------------------------------

		return true;
	}
	//------------------------------------------------------------------------------------------

	$codigo = filter_input(INPUT_GET, 'codigo');
	$acao	= "Incluir";

	//se for passado codigo para edição e nao tiver sido postado informação do formulario busca dados do banco
	if(!isset($_POST['Alterar']) and !empty($codigo))
	{
		$acao	= "Alterar";

		$sql = "select * from sis_secretaria where idsecretaria = $codigo";

		$resultado = execQuery($sql);
		$registro  = mysqli_fetch_array($resultado);

		$idsecretaria	= $registro["idsecretaria"];
		$nome			= addslashes($registro["nome"]);
		$sigla			= $registro["sigla"];
		$responsavel	= $registro["responsavel"];
		$telefonecontato= $registro["telefonecontato"];
		$ativado		= $registro["ativado"];
		$emailsic		= $registro["emailsic"];
		$siccentral		= $registro["siccentral"];
  } else {
    //recupera valores do formulario
    $idsecretaria = filter_input(INPUT_POST, 'idsecretaria');
    $nome = addslashes(filter_input(INPUT_POST, 'nome'));
    $sigla = filter_input(INPUT_POST, 'sigla');
    $responsavel = filter_input(INPUT_POST, 'responsavel');
    $telefonecontato = filter_input(INPUT_POST, 'telefonecontato');
    $ativado = filter_input(INPUT_POST, 'ativado');
    $emailsic = filter_input(INPUT_POST, 'emailsic');
    $siccentral = filter_input(INPUT_POST, 'siccentral');
  }

	$erro="";

	//se for uma inclusao
	if (isset($_POST['Incluir'])) {
		checkPerm("INSSEC");

		if(validaDados())
		{
			$sql="INSERT INTO sis_secretaria (nome, sigla, responsavel, telefonecontato, ativado, emailsic, siccentral, idusuarioinclusao, datainclusao )
				  VALUES
				  ('$nome','$sigla','$responsavel','$telefonecontato', $ativado, '$emailsic', $siccentral, ".getSession('uid').", NOW())";

			if (execQuery($sql))
			{
				logger("Adicionou SIC");
				//header("location = '?sis_secretaria");
				echo "<script> alert ('SIC Adicionado! ');</script>";
				echo "<script> document.location.href='?sis_secretaria';</script>";

			}
			else
			{
				$erro = "Ocorreu um erro ao incluir SIC.";
			}
		}

    //se for uma alteração
  } elseif (isset($_POST['Alterar'])) {
    $acao	= "Alterar";
		checkPerm("UPTSEC");

		if(validaDados())
		{

			$sql = "update sis_secretaria set
						nome='$nome',
						sigla='$sigla',
						responsavel='$responsavel',
						telefonecontato='$telefonecontato',
						ativado= $ativado,
                                                emailsic = '$emailsic',
                                                siccentral='$siccentral',
                                                idusuarioalteracao = ".getSession('uid').",
                                                dataalteracao = NOW()
				    WHERE idsecretaria ='$idsecretaria' ";

			if (execQuery($sql))
			{
				logger("Alterou SIC");
			}
			else
			{
				$erro = "Ocorreu um erro ao alterar SIC.";
			}
		}
	}

?>
