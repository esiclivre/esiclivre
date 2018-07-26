<?php
namespace Esic;

/**
 * Verifica se um objeto Solicitante atende as dados
 * mínimos necessários para permitir o cadastro
 */
class SolicitanteValidadorConfirmacao
{
    private static $Mensagens;
    private static $Solicitante;
    private static $indice;

    public static function checar($chave)
    {
        self::$Mensagens = new MensagensLista;

        if(! $chave)
        {
            self::$Mensagens->adicionar(
                new Mensagem(
                    'solicitante-confirmacao-chave-nao-informada'
                )
            );
            return false;
        }

        $filtros = array(
            'chave_confirmacao' => $chave,
            'confirmado' => 0
        );

        $Bd = new SolicitanteBd;
        $Solicitante = $Bd->obter($filtros);

        if (! $Solicitante) {
            self::$Mensagens->adicionar(
                new Mensagem(
                    'solicitante-confirmacao-chave-invalida'
                )
            );
            return false;
        }

        self::$Mensagens->adicionar(
            new Mensagem(
                'solicitante-confirmacao-chave-valida'
            )
        );
        self::$Solicitante = $Solicitante;
        return true;
    }

    public static function obterMensagens()
    {
        return self::$Mensagens;
    }

    public static function obterSolicitante()
    {
        return self::$Solicitante;
    }
}
