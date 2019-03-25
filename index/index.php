<?php
/**********************************************************************************
 Sistema e-SIC Livre: sistema de acesso a informação baseado na lei de acesso.

 Copyright (C) 2014 Prefeitura Municipal do Natal

 Este programa é software livre; você pode redistribuí-lo e/ou
 modificá-lo sob os termos da Licença GPL2.
***********************************************************************************/

require_once("../inc/security.php");

$login = preg_replace( '/[^0-9]/', '', filter_input( INPUT_POST, 'login' ) );
$password = filter_input( INPUT_POST, 'password' );
$tipo = isset( $_REQUEST['t'] ) ? $_REQUEST['t'] : null;
$msg = "";

if(usaRecaptcha($login))
	$usarecap = true;
else
	$usarecap = false;


if (isset($_POST['btsub'])) {
	if($usarecap)
	{
		$error = null;
		$recaptcha_ok = (
			( isset( $_POST["palavra"] ) && isset( $_SESSION["palavra"] ) )
			&&
			( strtoupper( $_POST["palavra"] ) == strtoupper( $_SESSION["palavra"] ) )
		);
	}
	else
		$recaptcha_ok = true;

	if($recaptcha_ok)
	{
		if(autentica($login, $password, $tipo))
		{
                        if(getSession("confirmado")=="S")
                            Redirect("../acompanhamento");
                        else
                        {
                            Redirect("../reenvioconfirmacao");
                        }
		}
		else
		{
			$msg = "<font color='red'>Erro: falha no login.</font>";
			$usarecap = true;
		}
	}
	else
		$msg = "<font color='red'>Erro: falha no login.</font>";
}





include("../inc/topo.php");
?>
        <div id="principal">
			<div id="banner">
				<a><img src="<?= SITELNK ?>img/modelos/inicio-banner.jpg"/></a>
			</div>

                        <?php if (empty($_SESSION[SISTEMA_CODIGO])) { ?>
			<div id="caixa_login">
				<form action="index.php" method="post">
				<div class="titulo_caixa_login"> Acesse o sistema</div>
				<span class="Mensagem">Preencha o Nome do Usuário e senha para acessar o Sistema de Informações.</span>

				<div id="campos">


					<table width="100%">
						<tr>

					<table cellpadding="1" cellspacing="5" "width: 80%;">
						<tr align="right">

							<td>
								<span class="labelLogin"><label id="login">Usuário: </label> </span>
							</td>
							<td>
								<span class="inputLogin"><input type="text" name="login" maxlength="20" id="login" > </span>
							</td>
						</tr>
						<tr>
							<td>
								<span class="labelLogin"><label id="Senha">Senha: </LABEL> </span>
							</td>
							<td>
								<span class="inputLogin"><input type="password" name="password" maxlength="100" id="password" > </span>
							</td>
						</tr>
                                                <?php if ($usarecap) { ?>
                                                <tr>
                                                    <td colspan="2" align="right">
                                                        <br>
                                                        <img src="<?= SITELNK ?>inc/captcha.php?l=150&amp;a=50&amp;tf=20&amp;ql=5" id="imgcaptcha">
                                                        <img src="<?= SITELNK ?>img/refresh.gif" title="Clique aqui para recarregar a imagem" alt="Clique aqui para recarregar a imagem"onclick="getElementById('imgcaptcha').src ='../inc/captcha.php?l=150&amp;a=50&amp;tf=20&amp;ql=5';">
                                                        <br><span class="labelLogin">Informe o código acima:</span><br><input type="text" name="palavra"  />
                                                    </td>
                                                </tr>
                                                <?php } ?>

                                                <tr>
							<td>
							</td>
							<td>
								<br><input type="submit" class="inputBotao" name="btsub" value="Entrar">
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<a class="class_cadastrese" href="<?= SITELNK ?>solicitante/cadastro/">Cadastre-se</a> |
								<a class="class_senha" href="<?= SITELNK ?>reset">Esqueci a senha</a>
							</td>
						</tr>
					</table>
				</div>

				</form>
			</div>
			<!--/div-->
			</div>
                        <?php } else {?>
                        <div id="caixa_login">
				<span class="Mensagem" ><!--style="color: rgb(0,0,0);" -->

                                    Olá; <?php echo getSession("nomeusuario");?>!
                                    <br><br>
                                    Caso não seja você; [<a href="<?= SITELNK ?>index/logout.php" style="color: #FF0000" class="class_cadastrese">clique aqui</a>]
                                </span>
                        </div>
                        <?php } ?>


        <div id="notificacoes">
            <div class="contactsOther">
                <h2 class="contactsOther__title">Outras formas de contato</h2>

                <article class="contactsOther__data contactEntity">
                    <h3 class="contactEntity__title">Gabinete</h3>

                    <h4 class="contactEntity__phoneTitle">Telefone</h4>
                    <p class="contactEntity__phoneNumber"><a class="contactEntity__phoneLink" href="tel:558835491020">(88) 3549-1020</a></p>

                    <h4 class="contactEntity__mailTitle">E-mail</h4>
                    <p class="contactEntity__mailAddress"><a class="contactEntity__mailLink" href="mailto:esic@tarrafas.ce.gov.br">esic@tarrafas.ce.gov.br</a></p>

                    <h4 class="contactEntity__addressTitle">Endereço</h4>
                    <p class="contactEntity__address">Rua São José, nº 270, Centro, Tarrafas, Ceará - CEP: 63.145-000</p>

                    <p class="contactEntity__serviceHours">Atendimento das 7h às 13h</p>
                </article>
            </div>

			<div id="links">

				<table  "width: 100%;">
					<tr>
						<th  "width: 40%;">
							SIC - Serviço de informação ao Cidadão
					  </th>
						<th  "width: 30%;">
							Lei de Acesso
						</th>
						<th  "width: 30%;">

							Links Úteis
						</th>
					</tr>
					<tr>
						<td>
							<a href="<?= SITELNK ?>manual/informacao.php">Como pedir uma informação</a>
						</td>
						<td>
							<a href="<?= SITELNK ?>manual/decreto.php">Decreto</a>
						</td>
						<td>
							<a href="http://www.acessoainformacao.gov.br/acessoainformacaogov/">Acesso à informação CGU</a>
						</td>
					</tr>
					<tr>
						<td>
							<a href="<?= SITELNK ?>manual/pedido.php">Como acompanhar seu pedido</a>
						</td>
						<td>
							<a href="<?= SITELNK ?>manual/LegislacaoRelacionada.php">Legislação relacionada</a>
				    </td>
						<td>
							<a href="http://portal2.tcu.gov.br/portal/page/portal/TCU/transparencia">Acesso à informação TCU</a>
						</td>
					</tr>
					<tr>
						<td>
							<a href="<?= SITELNK ?>manual/recurso.php">Como entrar com um recurso</a>
						</td>
						<td>
							Leis
						</td>
						<td>

						</td>
					</tr>
				</table>
			</div>

			<div id="postagens"></div>

        </div>
    <?php include("../inc/rodape.php"); ?>
	</div>
