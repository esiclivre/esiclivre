<?php
namespace Esic;

class SolicitanteConversor
{
    private static $Mensagens;
    private static $situacao;

    public static function deArray($dados)
    {
        self::$Mensagens = new MensagensLista;
        self::$situacao = null;

        // Criando objeto vazio
        $Solicitante = new Solicitante;

        if (!is_array($dados)) {
            self::$Mensagens->adicionar(new Mensagem('solicitante-conversao-falha'));
            self::$situacao = false;
            return $Solicitante;
        }

        // Verificando dados
        if (isset($dados['chave'])) {
            $Solicitante->defChave($dados['chave']);
        }
        if (isset($dados['confirmado'])) {
            $Solicitante->defConfirmado($dados['confirmado']);
        }
        if (isset($dados['cnpj'])) {
            $Solicitante->defCnpj(new Cnpj($dados['cnpj']));
        }
        if (isset($dados['cpf'])) {
            $Solicitante->defCpf(new Cpf($dados['cpf']));
        }
        if (isset($dados['data_cadastro'])) {
            $Solicitante->defDataCadastro(new \DateTime($dados['data_cadastro']));
        }
        if (isset($dados['data_confirmacao'])) {
            $Solicitante->defDataConfirmacao(new \DateTime($dados['data_confirmacao']));
        }
        if (isset($dados['email'])) {
            $Solicitante->defEmail($dados['email']);
        }
        if (isset($dados['escolaridade_id'])) {
            $Solicitante->defEscolaridadeId($dados['escolaridade_id']);
        }
        if (isset($dados['faixa_etaria_id'])) {
            $Solicitante->defFaixaEtariaId($dados['faixa_etaria_id']);
        }
        if (isset($dados['id'])) {
            $Solicitante->defId($dados['id']);
        }
        if (isset($dados['nome'])) {
            $Solicitante->defNome($dados['nome']);
        }
        if (isset($dados['profissao'])) {
            $Solicitante->defProfissao($dados['profissao']);
        }
        if (isset($dados['senha'])) {
            $Solicitante->defSenha($dados['senha']);
        }
        if (isset($dados['tipo'])) {
            $Solicitante->defTipo($dados['tipo']);
        }

        // Chegando endereço
        $end_logradouro = isset($dados['endereco_logradouro'])
        ? $dados['endereco_logradouro']
        : null;

        $end_numero = isset($dados['endereco_numero'])
        ? $dados['endereco_numero']
        : null;

        $end_bairro = isset($dados['endereco_bairro'])
        ? $dados['endereco_bairro']
        : null;

        $end_cep = isset($dados['endereco_cep'])
        ? $dados['endereco_cep']
        : null;

        $end_complemento = isset($dados['endereco_complemento'])
        ? $dados['endereco_complemento']
        : null;

        $end_cidade_nome = isset($dados['endereco_cidade_nome'])
        ? $dados['endereco_cidade_nome']
        : null;

        $end_estado_uf = isset($dados['endereco_estado_uf'])
        ? $dados['endereco_estado_uf']
        : null;

        if (
            $end_logradouro ||
            $end_numero ||
            $end_bairro ||
            $end_complemento ||
            $end_cep ||
            $end_cidade_nome ||
            $end_estado_uf
        ) {
            $Solicitante->defEndereco(
                new Endereco(
                    $end_logradouro,
                    $end_numero,
                    $end_bairro,
                    $end_complemento,
                    $end_cep,
                    $end_cidade_nome,
                    $end_estado_uf
                )
            );
        }

        // Chegando Telefone
        $tel_ddd = isset($dados['telefone_ddd'])
        ? $dados['telefone_ddd']
        : null;

        $tel_numero = isset($dados['telefone_numero'])
        ? $dados['telefone_numero']
        : null;

        $tel_tipo_id = isset($dados['telefone_tipo_id'])
        ? $dados['telefone_tipo_id']
        : null;

        if (
            $tel_ddd ||
            $tel_numero ||
            $tel_tipo_id
        ) {
            $Solicitante->defTelefone(
                new Telefone(
                    $tel_ddd,
                    $tel_numero,
                    $tel_tipo_id
                )
            );
        }

        self::$situacao = true;

        return $Solicitante;
    }

    public static function obterMensagens()
    {
        return self::$Mensagens;
    }

    public static function obterSituacao()
    {
        return self::$situacao;
    }
}
