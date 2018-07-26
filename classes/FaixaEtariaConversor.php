<?php
namespace Esic;

class FaixaEtariaConversor
{
    private static $Mensagens;
    private static $situacao;

    public static function deArray($dados)
    {
        self::$Mensagens = new MensagensLista;
        self::$situacao = null;

        // Criando objeto vazio
        $FaixaEtaria = new FaixaEtaria('Não Definido');

        if (!is_array($dados)) {
            self::$Mensagens->adicionar(
                new Mensagem('faixa-etaria-conversao-falha')
            );
            self::$situacao = false;
            return $FaixaEtaria;
        }

        // Verificando dados
        if (isset($dados['id'])) {
            $FaixaEtaria->defId($dados['id']);
        }
        if (isset($dados['nome'])) {
            $FaixaEtaria->defNome($dados['nome']);
        }

        self::$situacao = true;

        return $FaixaEtaria;
    }
}
