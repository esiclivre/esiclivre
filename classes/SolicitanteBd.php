<?php
namespace Esic;

/**
 * Persiste e obtem objetos Solicitante
 */
class SolicitanteBd
{
    private $Conexao;
    private $Mensagens;

    public function __construct(Conexao $Conexao = null)
    {
        $this->Conexao = $Conexao ? $Conexao : new Conexao;
        $this->Mensagens = new MensagensLista;
    }

    public function cadastrar(Solicitante $Solicitante)
    {
        // Pedindo conexão
        $Cx = $this->Conexao->obter();
        if (!$Cx) {
            return false;
        }

        $sql = "
            INSERT INTO `lda_solicitante` (
                nome,
                tipopessoa,
                cpfcnpj,
                idfaixaetaria,
                idescolaridade,
                profissao,
                email,
                idtipotelefone,
                dddtelefone,
                telefone,
                logradouro,
                numero,
                complemento,
                bairro,
                cep,
                cidade,
                uf,
                chave,
                chave_confirmacao
            ) VALUES (
                :nome,
                :tipo,
                :documento,
                :faixa_etaria_id,
                :escolaridade_id,
                :profissao,
                :email,
                :telefone_tipo_id,
                :telefone_ddd,
                :telefone_numero,
                :endereco_logradouro,
                :endereco_numero,
                :endereco_complemento,
                :endereco_bairro,
                :endereco_cep,
                :endereco_cidade_nome,
                :endereco_estado_uf,
                :chave,
                :chave_confirmacao
            )
        ";

        // Preparando consulta
        $Pedido = $Cx->prepare($sql);

        // Criando variáveis
        $nome = $Solicitante->obterNome();
        $tipo = $Solicitante->obterTipo();
        $faixa_etaria_id = $Solicitante->obterFaixaEtariaId();
        $escolaridade_id = $Solicitante->obterEscolaridadeId();
        $profissao = $Solicitante->obterProfissao();
        $email = $Solicitante->obterEmail();
        $chave = $Solicitante->gerarChave();
        $chave_confirmacao = $Solicitante->gerarChaveConfirmacao();
        $tel_tipo_id = null;
        $tel_ddd = null;
        $tel_numero = null;
        $end_logradouro = null;
        $end_numero = null;
        $end_complemento = null;
        $end_bairro = null;
        $end_cep = null;
        $end_cidade_nome = null;
        $end_estado_uf = null;
        $documento = null;

        // Obtendo objetos
        $Telefone = $Solicitante->obterTelefone();
        $Endereco = $Solicitante->obterEndereco();
        $Cpf = $Solicitante->obterCpf();
        $Cnpj = $Solicitante->obterCnpj();

        // Verificando dados de telefones
        if ($Telefone) {
            $tel_tipo_id = $Telefone->obterTipoId();
            $tel_ddd = $Telefone->obterDdd();
            $tel_numero = $Telefone->obterNumero();
        }

        // Verificando dados de Endereço
        if ($Endereco) {
            $end_logradouro = $Endereco->obterLogradouro();
            $end_numero = $Endereco->obterNumero();
            $end_complemento = $Endereco->obterComplemento();
            $end_bairro = $Endereco->obterBairro();
            $end_cep = $Endereco->obterCep();
            $end_cidade_nome = $Endereco->obterCidadeNome();
            $end_estado_uf = $Endereco->obterEstadoUf();
        }

        // Verificando o documento a ser utilizado
        if ($Solicitante->obterTipo() == 'F' && $Cpf) {
            $documento = $Cpf->valor();
        } elseif ($Cnpj) {
            $documento = $Cnpj->valor();
        }

        // Passando parâmetros
        $Pedido->bindParam(':nome', $nome);
        $Pedido->bindParam(':tipo', $tipo);
        $Pedido->bindParam(':faixa_etaria_id', $faixa_etaria_id);
        $Pedido->bindParam(':escolaridade_id', $escolaridade_id);
        $Pedido->bindParam(':profissao', $profissao);
        $Pedido->bindParam(':email', $email);
        $Pedido->bindParam(':chave', $chave);
        $Pedido->bindParam(':chave_confirmacao', $chave_confirmacao);
        $Pedido->bindParam(':telefone_tipo_id', $tel_tipo_id);
        $Pedido->bindParam(':telefone_ddd', $tel_ddd);
        $Pedido->bindParam(':telefone_numero', $tel_numero);
        $Pedido->bindParam(':endereco_logradouro', $end_logradouro);
        $Pedido->bindParam(':endereco_numero', $end_numero);
        $Pedido->bindParam(':endereco_complemento', $end_complemento);
        $Pedido->bindParam(':endereco_bairro', $end_bairro);
        $Pedido->bindParam(':endereco_cep', $end_cep);
        $Pedido->bindParam(':endereco_cidade_nome', $end_cidade_nome);
        $Pedido->bindParam(':endereco_estado_uf', $end_estado_uf);
        $Pedido->bindParam(':documento', $documento);

        // Executando consulta
        if (!$Pedido->execute()) {
            $this->Mensagens->adicionar(
                new Mensagem('solicitante-cadastro-erro')
            );
            return false;
        }

        $this->Mensagens->adicionar(
            new Mensagem('solicitante-cadastro-sucesso')
        );

        return true;
    }

    public function editar(Solicitante $Solicitante)
    {
        // Pedindo conexão
        $Cx = $this->Conexao->obter();
        if (!$Cx) {
            return false;
        }

        $sql = "
            UPDATE `lda_solicitante`
            SET
                `nome` = :nome,
                `tipopessoa` = :tipo,
                `cpfcnpj` = :documento,
                `idfaixaetaria` = :faixa_etaria_id,
                `idescolaridade` = :escolaridade_id,
                `profissao` = :profissao,
                `email` = :email,
                `idtipotelefone` = :telefone_tipo_id,
                `dddtelefone` = :telefone_ddd,
                `telefone` = :telefone_numero,
                `logradouro` = :endereco_logradouro,
                `numero` = :endereco_numero,
                `complemento` = :endereco_complemento,
                `bairro` = :endereco_bairro,
                `cep` = :endereco_cep,
                `cidade` = :endereco_cidade_nome,
                `uf` = :endereco_estado_uf,
                `chave` = :chave,
                `confirmado` = :confirmado,
                `dataconfirmacao` = :confirmacao_data
            WHERE
                `idsolicitante` = :id
            LIMIT 1;
        ";

        // Preparando consulta
        $Pedido = $Cx->prepare($sql);

        // Criando variáveis
        $id = $Solicitante->obterId();
        $nome = $Solicitante->obterNome();
        $tipo = $Solicitante->obterTipo();
        $faixa_etaria_id = $Solicitante->obterFaixaEtariaId();
        $escolaridade_id = $Solicitante->obterEscolaridadeId();
        $profissao = $Solicitante->obterProfissao();
        $email = $Solicitante->obterEmail();
        $tel_tipo_id = null;
        $tel_ddd = null;
        $tel_numero = null;
        $end_logradouro = null;
        $end_numero = null;
        $end_complemento = null;
        $end_bairro = null;
        $end_cep = null;
        $end_cidade_nome = null;
        $end_estado_uf = null;
        $documento = null;

        // Obtendo objetos
        $Telefone = $Solicitante->obterTelefone();
        $Endereco = $Solicitante->obterEndereco();
        $Cpf = $Solicitante->obterCpf();
        $Cnpj = $Solicitante->obterCnpj();

        // Verificando dados de telefones
        if ($Telefone) {
            $tel_tipo_id = $Telefone->obterTipoId();
            $tel_ddd = $Telefone->obterDdd();
            $tel_numero = $Telefone->obterNumero();
        }

        // Verificando dados de Endereço
        if ($Endereco) {
            $end_logradouro = $Endereco->obterLogradouro();
            $end_numero = $Endereco->obterNumero();
            $end_complemento = $Endereco->obterComplemento();
            $end_bairro = $Endereco->obterBairro();
            $end_cep = $Endereco->obterCep();
            $end_cidade_nome = $Endereco->obterCidadeNome();
            $end_estado_uf = $Endereco->obterEstadoUf();
        }

        // Verificando o documento a ser utilizado
        if ($Solicitante->obterTipo() == 'F' && $Cpf) {
            $documento = $Cpf->valor();
        } elseif ($Cnpj) {
            $documento = $Cnpj->valor();
        }

        // Passando parâmetros
        $Pedido->bindParam(':id', $id);
        $Pedido->bindParam(':nome', $nome);
        $Pedido->bindParam(':tipo', $tipo);
        $Pedido->bindParam(':faixa_etaria_id', $faixa_etaria_id);
        $Pedido->bindParam(':escolaridade_id', $escolaridade_id);
        $Pedido->bindParam(':profissao', $profissao);
        $Pedido->bindParam(':email', $email);
        $Pedido->bindParam(':telefone_tipo_id', $tel_tipo_id);
        $Pedido->bindParam(':telefone_ddd', $tel_ddd);
        $Pedido->bindParam(':telefone_numero', $tel_numero);
        $Pedido->bindParam(':endereco_logradouro', $end_logradouro);
        $Pedido->bindParam(':endereco_numero', $end_numero);
        $Pedido->bindParam(':endereco_complemento', $end_complemento);
        $Pedido->bindParam(':endereco_bairro', $end_bairro);
        $Pedido->bindParam(':endereco_cep', $end_cep);
        $Pedido->bindParam(':endereco_cidade_nome', $end_cidade_nome);
        $Pedido->bindParam(':endereco_estado_uf', $end_estado_uf);
        $Pedido->bindParam(':documento', $documento);
        $Pedido->bindValue(':chave', $Solicitante->obterChave());
        $Pedido->bindValue(':confirmado', $Solicitante->obterSituacao());
        $Pedido->bindValue(':confirmacao_data', $Solicitante->obterDataConfirmacao()->format('Y-m-d h:i:s'));

        // Executando consulta
        if (!$Pedido->execute()) {
            var_dump($Pedido->errorInfo());
            $this->Mensagens->adicionar(
                new Mensagem('solicitante-editar-erro')
            );
            return false;
        }

        $this->Mensagens->adicionar(
            new Mensagem('solicitante-editar-sucesso')
        );
        return true;
    }

    public function obter($param = null)
    {
        // Pedindo conexão
        $Cx = $this->Conexao->obter();
        if (!$Cx) {
            return false;
        }

        $filtro_sql = '';
        $filtros = array();

        if (isset($param['tipo'])) {
            $filtros['tipo'] = '`tipopessoa` = :tipo';
        }

        if (isset($param['cpf'])) {
            $filtros['cpf'] = '`cpfcnpj` = :cpf';
        }

        if (isset($param['cnpj'])) {
            $filtros['cnpj'] = '`cpfcnpj` = :cnpj';
        }

        if (isset($param['confirmado'])) {
            $filtros['confirmado'] = '`confirmado` = :confirmado';
        }

        if (isset($param['chave_confirmacao'])) {
            $filtros['chave_confirmacao'] = '`chave_confirmacao` = :chave_confirmacao';
        }

        if ($filtros) {
            $filtros_sql = 'WHERE '. implode(' AND ', $filtros);
        }

        $sql = "
            SELECT
                `idsolicitante` AS `id`,
                `nome`,
                `tipopessoa` AS `tipo`,
                `cpfcnpj` AS `documento`,
                `email`,
                `idtipotelefone` AS `telefone_tipo_id`,
                `dddtelefone` AS `telefone_ddd`,
                `telefone` AS `telefone_numero`,
                `logradouro` AS `endereco_logradouro`,
                `numero` AS `endereco_numero`,
                `complemento` AS `endereco_complemento`,
                `bairro` AS `endereco_bairro`,
                `cep` AS `endereco_cep`,
                `cidade` AS `endereco_cidade_nome`,
                `uf` AS `endereco_estado_uf`,
                `profissao`,
                `idescolaridade` AS `escolaridade_id`,
                `idfaixaetaria` AS `faixa_etaria_id`,
                `datacadastro` AS `data_cadastro`,
                `dataconfirmacao` AS `data_confirmacao`,
                `confirmado`,
                `chave`
            FROM `lda_solicitante`
            {$filtros_sql}
            LIMIT 0,1
        ";

        $Pedido = $Cx->prepare($sql);

        foreach ($filtros as $chave => $valor) {
            $Pedido->bindParam(":{$chave}", $param[$chave]);
        }

        if (!$Pedido->execute()) {
            $this->Mensagens->adicionar(
                new Mensagem('solicitante-obter-erro')
            );
            return false;
        }

        if ($Pedido->rowCount() == 0 ) {
            $this->Mensagens->adicionar(
                new Mensagem('solicitante-obter-vazio')
            );
            return null;
        }

        $this->Mensagens->adicionar(
            new Mensagem('solicitante-obter-sucesso')
        );

        $dados = $Pedido->fetch(\PDO::FETCH_ASSOC);

        if ($dados['tipo'] == 'F') {
            $dados['cpf'] = $dados['documento'];
        } else {
            $dados['cnpj'] = $dados['documento'];
        }

        return SolicitanteConversor::deArray($dados);
    }

    public function obterMensagens()
    {
        return $this->Mensagens;
    }
}
