<?php
namespace Esic;

class EstadosListaConversor
{
    private static $Mensagens;
    private static $situacao;

    public static function deArray($lista)
    {
        self::$Mensagens = new MensagensLista;
        self::$situacao = null;

        // Criando objeto vazio
        $EstadosLista = new EstadosLista;

        if (!is_array($lista)) {
            self::$Mensagens->adicionar(
                new Mensagem('estados-lista-conversao-falha')
            );
            self::$situacao = false;
            return $EstadosLista;
        }

        foreach ($lista as $chave => $estado) {
            $EstadosLista->adicionar(
                EstadoConversor::deArray($estado)
            );
        }

        self::$situacao = true;
        return $EstadosLista;
    }
}
