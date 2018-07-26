<?php
namespace Esic;

/**
 * Persiste os dados de um objeto FaixaEtaria no Banco
 */
class FaixaEtariaBd
{
    private $Conexao;
    private $Mensagens;

    public function __construct(Conexao $Conexao = null)
    {
        $this->Conexao = $Conexao ? $Conexao : new Conexao;
        $this->Mensagens = new MensagensLista;
    }

    public function obterLista()
    {
        // Pedindo conexão
        $Cx = $this->Conexao->obter();
        if (!$Cx) {
            $this->Mensagens->adicionar(
                $this->Conexao->obterMensagens()->obterUltima()
            );
            return false;
        }

        $sql = "
            SELECT
                `idfaixaetaria` AS `id`,
                `nome`
            FROM `lda_faixaetaria`
        ";
        $Resultado = $Cx->query($sql);

        if (! $Resultado) {
            $this->Mensagens->adicionar(
                new Mensagem('faixa-etaria-obter-lista-erro')
            );
            return false;
        }

        $lista = $Resultado->fetchAll(\PDO::FETCH_ASSOC);

        if (empty($lista)) {
            $this->Mensagens->adicionar(
                new Mensagem('faixa-etaria-obter-lista-vazia')
            );
            return null;
        }

        $this->Mensagens->adicionar(
            new Mensagem('faixa-etaria-obter-lista-sucesso')
        );

        return FaixaEtariaListaConversor::deArray($lista);
    }

    public function obterMensagens()
    {
        return $this->Mensagens;
    }
}
