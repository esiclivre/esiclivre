<?php
/**********************************************************************************
Sistema e-SIC Livre: sistema de acesso a informação baseado na lei de acesso.

Copyright (C) 2014 Prefeitura Municipal do Natal

Este programa é software livre; você pode redistribuí-lo e/ou
modificá-lo sob os termos da Licença GPL2.
***********************************************************************************/

	include_once("../inc/autenticar.php");
	include_once("../inc/security.php");

	$varAreaRestrita = "inclui"; //indica se deve ser incluido o arquivo dentro da classe

  $codigo = filter_input(INPUT_GET, 'codigo');
  $acao = filter_input(INPUT_POST, 'acao');

  //persistencia dos campos de filtro do index
  $fltnumprotocolo = isset($_REQUEST["fltnumprotocolo"])
  ? $_REQUEST["fltnumprotocolo"]
  : null;

  $fltsolicitante = isset($_REQUEST["fltsolicitante"])
  ? $_REQUEST["fltsolicitante"]
  : null;

  $fltsituacao = isset($_REQUEST["fltsituacao"])
  ? $_REQUEST["fltsituacao"]
  : null;

  $receber = isset($_REQUEST["receber"])
  ? $_REQUEST["receber"]
  : null;

  // parametros a ser passado para a pagina de detalhamento, fazendo com que
  // ao voltar para o index traga as informações passadas anteriormente
  $parametrosIndex = "
    fltnumprotocolo=$fltnumprotocolo
    &fltsolicitante=$fltsolicitante
    &fltsituacao=$fltsituacao
  ";

  $despacho = null;
  $idsecretariadestino = null;
  $tiporesposta = null;
  $txtresposta = null;
  $txtmotivoprorrogacao = null;
  //-----

	// se for passado codigo para edição e nao tiver sido postado informação
  // do formulario busca dados do banco
	if(!isset($_POST['acao']) and !empty($codigo))
	{
		$acao = "Alterar";

		//recupera campos da demanda
		$sol = new Solicitacao($codigo);

		$idsolicitacao              = $sol->getIdSolicitacao();
		$idsolicitante              = $sol->getIdSolicitante();
		$idsolicitacaoorigem        = $sol->getIdSolicitacaoOrigem();
		$numeroprotocolo            = $sol->getNumeroProtocolo();
		$textosolicitacao           = $sol->getTextoSolicitacao();
		$idtiposolicitacao          = $sol->getIdTipoSolicitacao();
		$instancia                  = Solicitacao::getInstaciaTipoSolicitacao($idtiposolicitacao);
		$formaretorno               = $sol->getFormaRetorno();
		$situacao                   = $sol->getSituacao();
		$datasolicitacao            = $sol->getDataSolicitacao();
		$datarecebimentosolicitacao = $sol->getDataRecebimentoSolicitacao();
		$usuariorecebimento         = $sol->getUsuarioRecebimento();
		$dataprevisaoresposta       = $sol->getDataPrevisaoResposta();
		$dataprorrogacao            = $sol->getDataProrrogacao();
		$motivoprorrogacao          = $sol->getMotivoProrrogacao();
		$usuarioprorrogacao         = $sol->getUsuarioProrrogacao();
		$dataresposta               = $sol->getDataResposta();
		$resposta                   = $sol->getResposta();
		$usuarioresposta            = $sol->getUsuarioResposta();
		$sistemaOrigem				= $sol->getSistemaOrigem();

		$soli = new Solicitante($idsolicitante);

		$nome               = $soli->getNome();
		$profissao          = $soli->getProfissao();
		$cpfcnpj            = $soli->getCpfCnpj();
		$escolaridade       = $soli->getEscolaridade();
		$faixaetaria        = $soli->getFaixaEtaria();
		$email              = $soli->getEmail();
		$tipotelefone       = $soli->getTipoTelefone();
		$dddtelefone        = $soli->getDDDTelefone();
		$telefone           = $soli->getTelefone();
		$logradouro         = $soli->getLogradouro();
		$numero             = $soli->getNumero();
		$complemento        = $soli->getComplemento();
		$cep                = $soli->getCep();
		$bairro             = $soli->getBairro();
		$cidade             = $soli->getCidade();
		$uf                 = $soli->getUf();

		//se tiver acao de recebimento para ser realizado
		if($receber=="sim")
		   $erro = Solicitacao::recebe($idsolicitacao);

  } else {
    //recupera valores do formulario
    //campos de leitura
    $idsolicitacao = filter_input(INPUT_POST, 'idsolicitacao');
    $idsolicitante = filter_input(INPUT_POST, 'idsolicitante');
    $idsolicitacaoorigem = filter_input(INPUT_POST, 'idsolicitacaoorigem');
    $numeroprotocolo = filter_input(INPUT_POST, 'numeroprotocolo');
    $textosolicitacao = filter_input(INPUT_POST, 'textosolicitacao');
    $idtiposolicitacao = filter_input(INPUT_POST, 'idtiposolicitacao');
    $instancia = filter_input(INPUT_POST, 'instancia');
    $formaretorno = filter_input(INPUT_POST, 'formaretorno');
    $situacao = filter_input(INPUT_POST, 'situacao');
    $datasolicitacao = filter_input(INPUT_POST, 'datasolicitacao');
    $datarecebimentosolicitacao = filter_input(INPUT_POST, 'datarecebimentosolicitacao');
    $usuariorecebimento = filter_input(INPUT_POST, 'usuariorecebimento');
    $dataprevisaoresposta = filter_input(INPUT_POST, 'dataprevisaoresposta');
    $dataprorrogacao = filter_input(INPUT_POST, 'dataprorrogacao');
    $motivoprorrogacao = filter_input(INPUT_POST, 'motivoprorrogacao');
    $usuarioprorrogacao = filter_input(INPUT_POST, 'usuarioprorrogacao');
    $dataresposta = filter_input(INPUT_POST, 'dataresposta');
    $resposta = filter_input(INPUT_POST, 'resposta');
    $usuarioresposta = filter_input(INPUT_POST, 'usuarioresposta');
    $nome = filter_input(INPUT_POST, 'nome');
    $profissao = filter_input(INPUT_POST, 'profissao');
    $cpfcnpj = filter_input(INPUT_POST, 'cpfcnpj');
    $escolaridade = filter_input(INPUT_POST, 'escolaridade');
    $faixaetaria = filter_input(INPUT_POST, 'faixaetaria');
    $email = filter_input(INPUT_POST, 'email');
    $tipotelefone = filter_input(INPUT_POST, 'tipotelefone');
    $dddtelefone = filter_input(INPUT_POST, 'dddtelefone');
    $telefone = filter_input(INPUT_POST, 'telefone');
    $logradouro = filter_input(INPUT_POST, 'logradouro');
    $numero = filter_input(INPUT_POST, 'numero');
    $complemento = filter_input(INPUT_POST, 'complemento');
    $cep = filter_input(INPUT_POST, 'cep');
    $bairro = filter_input(INPUT_POST, 'bairro');
    $cidade = filter_input(INPUT_POST, 'cidade');
    $uf = filter_input(INPUT_POST, 'uf');
    $sistemaOrigem = filter_input(INPUT_POST, 'origem');

    //campos da movimentação
    $idsecretariadestino = filter_input(INPUT_POST, 'idsecretariadestino');
    $despacho = filter_input(INPUT_POST, 'despacho');

    $anexomovimentacao = isset($_FILES["anexomovimentacao"])
    ? $_FILES["anexomovimentacao"]
    : null;

    //campos da finalização
    $txtresposta = filter_input(INPUT_POST, 'txtresposta');
    $tiporesposta = filter_input(INPUT_POST, 'tiporesposta');

    $arquivos = isset($_FILES["arquivos"])
    ? $_FILES["arquivos"]
    : null;

    //campos de prorrogacao
    $txtmotivoprorrogacao = filter_input(INPUT_POST, 'txtmotivoprorrogacao');
  }

	$erro	= "";
	$valida = filter_input(INPUT_GET, 'tk');
	if ($valida <> md5($codigo . SIS_TOKEN)) {
		//echo "<script>alert('Demanda n�o pertence ao seu SIC - ". getSession("sic")[getSession("idsecretaria")][1] . "')</script>";
		//echo "<script>javascript:document.location='?lda_consulta';</script>";
	}

	if (isset($_POST['acao']))
	{
		//se for uma movimenta��o
		if ($acao == "Enviar")
		{
			checkPerm("LDAMOVIMENTAR");
			$erro = Solicitacao::movimenta($idsolicitacao, $idsecretariadestino, $despacho, $anexomovimentacao);
			if (empty($erro))
			{
				logger("Movimentou solicitação.");
				//header("Location: index.php?lda_solicitacao");
				echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=index.php?lda_solicitacao&$parametrosIndex'>";

			}
		}
		//se for uma finalização
		elseif ($acao == "Finalizar")
		{
			checkPerm("LDARESPONDER");
			$erro = Solicitacao::finaliza($idsolicitacao, $tiporesposta, $txtresposta, $arquivos);

			if (empty($erro))
			{
				logger("Finalizou solicitação.");
				echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=index.php?lda_solicitacao&$parametrosIndex'>";
			}
		}
		//se for uma prorrogação
		elseif ($acao == "Prorrogar")
		{
			checkPerm("LDAPRORROGAR");
			$erro = Solicitacao::prorrogar($idsolicitacao, $txtmotivoprorrogacao);

			if (empty($erro))
			{
				logger("Prorrogou solicitação.");
				echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=index.php?lda_solicitacao&$parametrosIndex'>";
			}
		}
	}
?>
