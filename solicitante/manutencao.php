<?php
/**********************************************************************************
 Sistema e-SIC Livre: sistema de acesso a informação baseado na lei de acesso.

 Copyright (C) 2014 Prefeitura Municipal do Natal

 Este programa é software livre; você pode redistribuí-lo e/ou
 modificá-lo sob os termos da Licença GPL2.
***********************************************************************************/

	include_once("../inc/autenticar.php");
	//include_once("../class/solicitante.class.php");
	include_once("./solicitante.class.php"); //o mesmo arquivo foi adicionado na pasta solicitante e modigficado para nao interferi no cadastro de usuarios


	$erro = "";	//grava o erro, se houver, e exibe por meio de alert (javascript) atraves da funcao getErro() chamada no arquivo do formulario. ps: a fun��o � declara em inc/security.php
  $idsolicitante = null;
  $nome = null;
  $cpfcnpj = null;
  $profissao = null;
  $idescolaridade = null;
  $tipopessoa = null;
  $idfaixaetaria = null;
  $idtipotelefone = null;
  $dddtelefone = null;
  $telefone = null;
  $email = null;
  $confirmeemail = null;

  $logradouro = null;
  $cep = null;
  $bairro = null;
  $cidade = null;
  $uf = null;
  $numero = null;
  $complemento = null;

	//se tiver sido postado informação do formulario
  if (isset($_POST['acao'])) {
    // dados solicitante
    $idsolicitante = filter_input(INPUT_POST, "idsolicitante");
    $nome = filter_input(INPUT_POST, "nome");
    $cpfcnpj = filter_input(INPUT_POST, "cpfcnpj");
    $profissao = filter_input(INPUT_POST, "profissao");
    $idescolaridade = filter_input(INPUT_POST, "idescolaridade");
    $tipopessoa = filter_input(INPUT_POST, "tipopessoa");
    $idfaixaetaria = filter_input(INPUT_POST, "idfaixaetaria");
    $idtipotelefone = filter_input(INPUT_POST, "idtipotelefone");
    $dddtelefone = filter_input(INPUT_POST, "dddtelefone");
    $telefone = filter_input(INPUT_POST, "telefone");
    $email = filter_input(INPUT_POST, "email");
    $confirmeemail = filter_input(INPUT_POST, "confirmeemail");

    // endereco
    $logradouro = filter_input(INPUT_POST, "logradouro");
    $cep = filter_input(INPUT_POST, "cep");
    $bairro = filter_input(INPUT_POST, "bairro");
    $cidade = filter_input(INPUT_POST, "cidade");
    $uf = filter_input(INPUT_POST, "uf");
    $numero = filter_input(INPUT_POST, "numero");
    $complemento = filter_input(INPUT_POST, "complemento");

		$solicitante = new Solicitante();

                $solicitante->setIdSolicitante($idsolicitante);
		$solicitante->setNome($nome);
		$solicitante->setCpfCnpj($cpfcnpj);
		$solicitante->setProfissao($profissao);
		$solicitante->setIdEscolaridade($idescolaridade);
		$solicitante->setTipoPessoa($tipopessoa);
                $solicitante->setIdTipoTelefone($idtipotelefone);
		$solicitante->setIdFaixaEtaria($idfaixaetaria);
		$solicitante->setDDDTelefone($dddtelefone);
                $solicitante->setTelefone($telefone);
		$solicitante->setEmail($email);
		$solicitante->setLogradouro($logradouro);
		$solicitante->setCep($cep);
		$solicitante->setBairro($bairro);
		$solicitante->setCidade($cidade);
		$solicitante->setUf($uf);
		$solicitante->setNumero($numero);
		$solicitante->setComplemento($complemento);
		$solicitante->setConfirmeEmail($confirmeemail);

		if (!$solicitante->atualiza())
			$erro = $solicitante->getErro();
		else
			echo "<script>location.href='../index.php';</script>";

		$solicitante = null;
	}
	else
	{

		$idsolicitante = getSession("uid");

		if(!empty($idsolicitante))
		{
			//resgata os dados do banco para exibi��o no form
			$solicitante = new Solicitante($idsolicitante);


			$idsolicitante 	= $solicitante->getIdsolicitante();
			$nome 		= $solicitante->getNome();
			$cpfcnpj	= $solicitante->getCpfCnpj();
			$profissao 	= $solicitante->getProfissao();
			$idescolaridade	= $solicitante->getIdEscolaridade();
			$tipopessoa   	= $solicitante->getTipoPessoa();
			$idtipotelefone	= $solicitante->getIdTipoTelefone();
                        $telefone       = $solicitante->getTelefone();
                        $dddtelefone    = $solicitante->getDDDTelefone();
			$idfaixaetaria  = $solicitante->getIdFaixaEtaria();
			$email 		= $solicitante->getEmail();
			$logradouro 	= $solicitante->getLogradouro();
			$cep 		= $solicitante->getCep();
			$bairro 	= $solicitante->getBairro();
			$cidade 	= $solicitante->getCidade();
			$uf 		= $solicitante->getUf();
			$numero 	= $solicitante->getNumero();
			$complemento 	= $solicitante->getComplemento();

			$solicitante = null;

		}
	}


?>
