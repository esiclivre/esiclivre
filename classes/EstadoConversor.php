<?php
namespace Esic;

class EstadoConversor
{
    private static $Mensagens;
    private static $situacao;

    public static function deArray($dados)
    {
        self::$Mensagens = new MensagensLista;
        self::$situacao = null;

        // Criando estado vazio
        $Estado = new Estado('-', '--', 0);

        if (!is_array($dados)) {
            self::$Mensagens->adicionar(
                new Mensagem('faixa-etaria-conversao-falha')
            );
            self::$situacao = false;
            return $Estado;
        }

        // Verificando dados
        if (isset($dados['id'])) {
            $Estado->defId($dados['id']);
        }

        if (isset($dados['nome'])) {
            $Estado->defNome($dados['nome']);
        }

        if (isset($dados['pais_id'])) {
            $Estado->defPaisId($dados['pais_id']);
        }

        if (isset($dados['uf'])) {
            $Estado->defUf($dados['uf']);
        }

        self::$situacao = true;

        return $Estado;
    }
}
