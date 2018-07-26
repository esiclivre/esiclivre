<?php
namespace Esic;

class FaixaEtariaListaConversor
{
    private static $Mensagens;
    private static $situacao;

    public static function deArray($lista)
    {
        self::$Mensagens = new MensagensLista;
        self::$situacao = null;

        // Criando objeto vazio
        $FaixaEtariaLista = new FaixaEtariaLista;

        if (!is_array($lista)) {
            self::$Mensagens->adicionar(
                new Mensagem('faixa-etaria-lista-conversao-falha')
            );
            self::$situacao = false;
            return $FaixaEtariaLista;
        }

        foreach ($lista as $chave => $faixa) {
            $FaixaEtariaLista->adicionar(
                FaixaEtariaConversor::deArray($faixa)
            );
        }

        self::$situacao = true;
        return $FaixaEtariaLista;
    }
}
