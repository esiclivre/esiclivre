<?php
/**********************************************************************************
 Sistema e-SIC Livre: sistema de acesso a informação baseado na lei de acesso.

 Copyright (C) 2014 Prefeitura Municipal do Natal

 Este programa é software livre; você pode redistribuí-lo e/ou
 modificá-lo sob os termos da Licença GPL2.
***********************************************************************************/

include_once("../inc/autenticar.php");
include_once("../class/solicitacao.class.php");
include_once(__DIR__."/../vendor/autoload.php");
  
use Esic\Solicitation;

  $codigo = filter_input(INPUT_GET, 'codigo');
  $acao = filter_input(INPUT_POST, 'acao');

  //persistencia dos campos de filtro do index
  $fltnumprotocolo = isset($_REQUEST["fltnumprotocolo"])
  ? $_REQUEST["fltnumprotocolo"]
  : null;

  $fltsituacao = isset($_REQUEST["fltsituacao"])
  ? $_REQUEST["fltsituacao"]
  : null;

  //parametros a ser passado para a pagina de detalhamento, fazendo com que ao voltar para o index traga as informações passadas anteriormente
  $parametrosIndex = "fltnumprotocolo=$fltnumprotocolo&fltsituacao=$fltsituacao";
  //-----

	//se for passado c�digo para edi��o e nao tiver sido postado informa��o do formulario busca dados do banco
  if(!$acao && !empty($codigo))
  {
		$acao = "Alterar";

                //recupera campos da demanda
                $sol = new Solicitation($codigo);


		$idsolicitacao              = $sol->getIdSolicitacao();
                $idsolicitante              = $sol->getIdSolicitante();
                $idsolicitacaoorigem        = $sol->getIdSolicitacaoOrigem();
                $numeroprotocolo            = $sol->getNumeroProtocolo();
                $textosolicitacao           = $sol->getTextoSolicitacao();
                $idtiposolicitacao          = $sol->getIdTipoSolicitacao();
                $instancia                  = Solicitation::getInstaciaTipoSolicitacao($idtiposolicitacao);
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
                $idsecretariaresposta       = $sol->getIdSecretariaResposta();
	}
	else
	{

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
    $idsecretariaresposta = filter_input(INPUT_POST, 'idsecretariaresposta');

    //campos do recurso
    $txttextosolicitacao = filter_input(INPUT_POST, 'txttextosolicitacao');
    $txtformaretorno = filter_input(INPUT_POST, 'txtformaretorno');
  }

	$erro="";

        if ($acao) {
            //se for envio de recurso
            if ($acao == "Enviar")
            {
                    $sol = new Solicitation();

                    //recupera o proximo tipo de solicita��o, caso retorne falso, deu erro
                    if(Solicitation::getProximoTipoSolicitacao($idsolicitacao,$idtiposolicitacaorecurso,$erro))
                    {
                        //se nao existir solicita��o original
                        if (empty($idsolicitacaoorigem))
                            $sol->setIdSolicitacaoOrigem($idsolicitacao); //o recurso ter� a solicita��o atual como original
                        else
                            $sol->setIdSolicitacaoOrigem($idsolicitacaoorigem); //o recurso manter� a solicita��o original

                        $sol->setTextoSolicitacao($txttextosolicitacao);
                        $sol->setFormaRetorno($txtformaretorno);
                        $sol->setIdSolicitante(getSession("uid"));

                        //caso nao exista SIC centralizador, o direcionamento vai para quem deu a resposta
                        if(!Solicitation::existeSicCentralizador())
                            $sol->setIdSecretariaSelecionada($idsecretariaresposta);

                        if ($sol->cadastraRecurso($idtiposolicitacaorecurso))
                            header("Location: index.php?$parametrosIndex");
                        else
                            $erro = $sol->getErro ();
                    }
            }
        }
?>
