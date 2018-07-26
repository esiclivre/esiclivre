<?php
// Verificando Dependências
if (
    ! isset($_TEMPLATE['solicitante']) ||
    ! ($_TEMPLATE['solicitante'] instanceof \Esic\Solicitante)
) {
    die('É necessário de solicitante para exibição da página');
}

if (
    ! isset($_TEMPLATE['faixa-etaria-lista']) ||
    ! ($_TEMPLATE['faixa-etaria-lista'] instanceof \Esic\FaixaEtariaLista)
) {
    die('É necessário uma lista de Faixa Etária para exibição da página');
}

if (
    ! isset($_TEMPLATE['escolaridade-lista'])
) {
    die('É necessário uma lista de Escolariade para exibição da página');
}

if (
    ! isset($_TEMPLATE['telefones-tipo-lista'])
) {
    die('É necessário uma lista de tipos de telefones para exibição da página');
}

if (
    ! isset($_TEMPLATE['estados']) ||
    ! ($_TEMPLATE['estados'] instanceof \Esic\EstadosLista)
) {
    die('É necessário uma lista de estados para exibição da página');
}

if (
    ! isset($_TEMPLATE['solicitante-validador']) ||
    ! ($_TEMPLATE['solicitante-validador'] instanceof \Esic\SolicitanteValidadorCadastro)
) {
    die('É necessário um validador de cadastro de solicitante');
}

if (
    ! isset($_TEMPLATE['mensagem']) ||
    ! ($_TEMPLATE['mensagem'] instanceof \Esic\Mensagem)
) {
    die('É necessário uma mensagem');
}

// Simplificando objetos
$EstadosLista = $_TEMPLATE['estados'];
$FaixaEtariaLista = $_TEMPLATE['faixa-etaria-lista'];
$Mensagem = $_TEMPLATE['mensagem'];
$Solicitante = $_TEMPLATE['solicitante'];
$escolaridade = $_TEMPLATE['escolaridade-lista'];
$telefones_tipo = $_TEMPLATE['telefones-tipo-lista'];
$Validador = $_TEMPLATE['solicitante-validador'];

$Endereco = $Solicitante->obterEndereco();
$Telefone = $Solicitante->obterTelefone();
$Cpf = $Solicitante->obterCpf();
$Cnpj = $Solicitante->obterCnpj();

// Criando varáveis condicionais
$cpf_valor = '';
$cnpj_valor = '';
$email_confirmacao = '';
$end_id = '';
$end_logradouro = '';
$end_numero = '';
$end_bairro = '';
$end_cep = '';
$end_complemento = '';
$end_cidade_nome = '';
$end_estado_uf = '';
$tel_ddd = '';
$tel_numero = '';
$tel_tipo_id = '';

// E-mail de confirmação
if (isset($_TEMPLATE['email-confirmacao'])) {
    $email_confirmacao = $_TEMPLATE['email-confirmacao'];
}

if ($Cpf) {
    $cpf_valor = $Cpf->valor();
}

if ($Cnpj) {
    $cnpj_valor = $Cnpj->valor();
}

// Alimentando Endereços
if ($Endereco) {
    $end_id = $Endereco->obterId();
    $end_logradouro = $Endereco->obterLogradouro();
    $end_numero = $Endereco->obterNumero();
    $end_bairro = $Endereco->obterBairro();
    $end_cep = $Endereco->obterCep();
    $end_complemento = $Endereco->obterComplemento();
    $end_cidade_nome = $Endereco->obterCidadeNome();
    $end_estado_uf = $Endereco->obterEstadoUf();
}

// Alimentando telefones
if ($Telefone) {
    $tel_ddd = $Telefone->obterDdd();
    $tel_numero = $Telefone->obterNumero();
    $tel_tipo_id = $Telefone->obterTipoId();
}

?>
<script language="JavaScript" src="<?= SITELNK;?>js/XmlHttpLookup.js"></script>

<script>
function selecionaTipoPessoa(tipo)
{
    if(tipo=="F")
    {
        document.getElementById('lblNome').innerHTML = "Nome";
        document.getElementById('lblCpfcnpj').innerHTML = "CPF";
        document.getElementById('lnEscolaridade').style.display = "";
        document.getElementById('lnProfissao').style.display = "";
        document.getElementById('documento').name = 'cpf';
    }
    else
    {
        document.getElementById('documento').name = 'cnpj';
        document.getElementById('lblNome').innerHTML = "Razão Social";
        document.getElementById('lblCpfcnpj').innerHTML = "CNPJ";
        document.getElementById('lnEscolaridade').style.display = "none";
        document.getElementById('lnProfissao').style.display = "none";
    }
}
</script>


<div align="center">
    <form action="./" method="post">
        <table align="center" cellpadding="0" cellspacing="1">
            <tr style="margin: 5px;">
                <th style="border-bottom:1px solid #000000" align="left" colspan="2">Dados Pessoais</th>
            </tr>
            <tr id="ldadosCidadao">
                <td colspan="2">
                    <?php if ($Mensagem->obterCodigo() != 'msg-vazia') { ?>
                        <p><?= $Mensagem->obterMensagem() ?></p>
                    <?php } ?>
                    <table align="left" width="100%" cellpadding="10" cellspacing="10">
                        <tr>
                            <td align="left">*Tipo de Pessoa:</td>
                            <td align="left" valign="top">
                                <input type="radio" name="tipo" value="F" <?= ($Solicitante->obterTipo() == 'F') ? 'checked' : ''; ?> onclick="selecionaTipoPessoa('F');">
                                Física
                                <input type="radio" name="tipo" value="J" <?= ($Solicitante->obterTipo() == 'J') ? 'checked' : ''; ?> onclick="selecionaTipoPessoa('J');">
                                Jurídica
                                <?php
                                    if (! $Validador::situacaoTipo()) {
                                ?>
                                <p class="erro"><?= $Validador::obterErroTipo()->obterMensagem() ?></p>
                                <?php
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td align="left">*<span id="lblNome"><?= $Solicitante->obterTipo() == 'J' ? 'Razão Social' : 'Nome'; ?></span>:</td>
                            <td align="left">
                                <input type="text" name="nome" id="nome" value="<?= $Solicitante->obterNome(); ?>" size="58" maxlength="100" />
                                <?php
                                    if (! $Validador::situacaoNome()) {
                                ?>
                                <p class="erro"><?= $Validador::obterErroNome()->obterMensagem() ?></p>
                                <?php
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td align="left">*<span id="lblCpfcnpj"><?= $Solicitante->obterTipo() == 'J' ? 'CNPJ' : 'CPF'; ?></span>:</td>
                            <td align="left">
                                <input type="text" id="documento" name="cpf" value="<?= $cpf_valor . $cnpj_valor ?>" onkeyup="soNumero(this);" onblur="document.getElementById('span_usuario').innerHTML = this.value;" size="14" maxlength="14" />
                                <?php
                                    if (! $Validador::situacaoCpf()) {
                                ?>
                                <p class="erro"><?= $Validador::obterErroCpf()->obterMensagem() ?></p>
                                <?php
                                    } elseif (! $Validador::situacaoCnpj()) {
                                ?>
                                <p class="erro"><?= $Validador::obterErroCnpj()->obterMensagem() ?></p>
                                <?php
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr id="lnFaixaEtaria">
                            <td align="left">Faixa Etária:</td>
                            <td align="left">
                                <select name="faixa_etaria_id" id="idfaixaetaria">
                                    <option value="">----</option>
                                    <?php
                                        while ($FaixaEtaria = $FaixaEtariaLista->obterProximo()) {
                                            $faixa_selecao = $FaixaEtaria->obterId() == $Solicitante->obterFaixaEtariaId() ? 'selected' : '';
                                    ?>
                                    <option value="<?= $FaixaEtaria->obterId() ?>" <?= $faixa_selecao ?>><?= $FaixaEtaria->obterNome() ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr id="lnEscolaridade">
                            <td align="left">Escolaridade:</td>
                            <td align="left">
                                <select name="escolaridade_id" id="idescolaridade">
                                    <option value="">----</option>
                                    <?php
                                        foreach ($escolaridade as $chave => $valor) {
                                            $escolaridade_selecao = $chave == $Solicitante->obterEscolaridadeId() ? 'selected' : '';
                                    ?>
                                    <option value="<?= $chave ?>" <?= $escolaridade_selecao ?>><?= $valor; ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>

                            </td>
                        </tr>
                        <tr id="lnProfissao">
                            <td align="left">Profissão:</td>
                            <td align="left">
                                <input type="text" name="profissao" value="<?= $Solicitante->obterProfissao()?>" size="30" maxlength="50" />
                            </td>
                        </tr>
                        <tr>
                            <td align="left">Tipo Telefone:</td>
                            <td align="left">
                                <select name="telefone_tipo_id" id="idtipotelefone">
                                    <option value="">----</option>
                                    <?php
                                        foreach ($telefones_tipo as $chave => $valor) {
                                            $tel_tipo_selecao = $chave == $tel_tipo_id ? 'selected' : '';
                                    ?>
                                    <option value="<?= $chave ?>" <?= $tel_tipo_selecao ?>><?= $valor ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                                Telefone: (<input type="text" name="telefone_ddd" value="<?= $tel_ddd ?>" onkeyup="soNumero(this);" size="2" maxlength="2" /> )
                                <input type="text" name="telefone_numero" value="<?= $tel_numero ?>" onkeyup="soNumero(this);" size="15" maxlength="15" />
                            </td>
                        </tr>
                        <tr>
                            <td align="left">*E-mail:</td>
                            <td align="left">
                                <input type="text" name="email" value="<?= $Solicitante->obterEmail() ?>" size="50" maxlength="150" />
                                <?php
                                    if (! $Validador::situacaoEmail()) {
                                ?>
                                <p class="erro"><?= $Validador::obterErroEmail()->obterMensagem() ?></p>
                                <?php
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td align="left">*Confirme E-mail:</td>
                            <td align="left">
                                <input type="text" name="email_confirmacao" value="<?= $email_confirmacao ?>" size="50" maxlength="150" />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <th style="border-bottom:1px solid #000000" align="left" colspan="2">Endereço</th>
            </tr>
            <tr id="lendereco">
                <td colspan="2">
                    <input type="hidden" name="idlogradouro" id="endereco_id" value="<?= $end_id ?>">
                    <table width="100%">
                        <tr>
                            <td align="left">CEP:</td>
                            <td align="left">
                                <input type="text" name="endereco_cep" id="cep" value="<?= $end_cep ?>" autocomplete="off" onkeyup="busca(this.value,this.value.length==8,'<?= URL_BASE_SISTEMA ?>inc/buscacep')" onclick="busca(this.value,this.value.length==8,'<?= URL_BASE_SISTEMA ?>inc/buscacep')" maxlength="8" size="10" />
                                <a href="http://www.buscacep.correios.com.br/servicos/dnec/menuAction.do?Metodo=menuEndereco" target="_blank"><img src="<?= URL_BASE_SISTEMA ?>img/busca_cep_correios.gif" border="0" align="absmiddle" style="margin:0px;padding:0px" title="Pesquisa CEP no site dos correios"></a>
                            </td>
                        </tr>
                        <tr>
                            <td align="left">Logradouro:</td>
                            <td align="left">
                                <input type="text" name="endereco_logradouro" id="logradouro" value="<?= $end_logradouro ?>" maxlength="255" size="60" />
                            </td>
                        </tr>
                        <tr>
                            <td align="left">Bairro:</td>
                            <td align="left">
                                <input type="text" onmouseover="this.title=this.value" name="endereco_bairro" id="bairro" value="<?= $end_bairro ?>" maxlength="100" size="50">
                            </td>
                        </tr>
                        <tr>
                            <td align="left">Cidade:</td>
                            <td>
                                <input type="text" name="endereco_cidade_nome" onmouseover="this.title=this.value" id="cidade" value="<?= $end_cidade_nome ?>" maxlength="255" size="35">
                                <select name="endereco_estado_uf" id="uf">
                                    <option value="">- UF -</option>
                                    <?php
                                        while ($Estado = $EstadosLista->obterProximo()) {
                                            $estado_selecao = $Estado->obterUf() == $end_estado_uf ? 'selected' : null;
                                    ?>
                                        <option value="<?= $Estado->obterUf() ?>" <?= $estado_selecao; ?>><?= $Estado->obterUf() ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td align="left">Número:</td>
                            <td align="left">
                                <input type="text" name="endereco_numero" id="numero" value="<?= $end_numero ?>" maxlength="10" size="10"  />
                                Complemento:
                                <input type="text" name="endereco_complemento" id="complemento" value="<?= $end_complemento ?>" maxlength="50" size="50" margin=10px; />
                            </td>
                        </tr>
                        <script>
                            InitQueryCode('endereco_cep', '<?= SITELNK ?>inc/lkpcep.php?q=');
                            document.getElementById('nome').focus();
                        </script>
                    </table>
                </td>
            </tr>
            <tr>
                <th style="border-bottom:1px solid #000000" align="left" colspan="2">Acesso ao e-SIC</th>
            </tr>
            <tr>
                <td align="left">*Usuário:</td>
                <td align="left">
                    <b>
                        <span id="span_usuario">&nbsp;</span>
                    </b>
                </td>
            </tr>
            <tr>
                <td align="left">*Senha:</td>
                <td align="left">
                    <input type="password" name="senha" size="30" maxlength="30" />
                    <?php
                        if (! $Validador::situacaoSenha()) {
                    ?>
                    <p class="erro"><?= $Validador::obterErroSenha()->obterMensagem() ?></p>
                    <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td align="left">*Confirme Senha:</td>
                <td align="left">
                    <input type="password" name="senha_confirmacao" size="30" maxlength="30" />
                </td>
            </tr>

            <tr>
                <td colspan="2"><td>
            </tr>
            <tr>
                <td colspan="2" align="center" style="border-top:1px solid #000000">
                    <input type="hidden" name="acao" value="cadastrar">
                    <br><input type="submit" class="botaoformulario" value="Salvar" name="bt-form">
                </td>
            </tr>
        </table>
    </form>

    <script>selecionaTipoPessoa('<?= $Solicitante->obterTipo() ?>');</script>
</div>
