<?php
namespace Esic;

class Cnpj
{
    private $numero;
    private $padrao = 543298765432;
    private $situacao;

    public function __construct($numero)
    {
        $this->numero = $this->limpar($numero);
        $this->situacao = $this->validar($numero);
    }

    private function limpar($numero)
    {
        $num = preg_replace('/[^\d]/', '', $numero);
        return (string) $num;
    }

    public function situacao()
    {
        return $this->situacao;
    }

    private function validar($numero)
    {
        $temp  = null;
        $i = preg_match(
            '/^(\d{2})\.?(\d{3})\.?(\d{3})\/?(\d{4})-?(\d{2})$/',
            $numero,
            $temp
        );

        if ($i <= 0) {
            return false;
        }

        $numeros = $temp[1].$temp[2].$temp[3].$temp[4];
        $digito  = $temp[5];
        $cnpj    = $numeros.$digito;
        $dig1    = '';
        $dig2    = '';
        $padrao  = $this->padrao; # Número padrão para vefificação

        // MutiplicandO e somando número padrão com os respectivos números do cnpj
        for ($i = 0; $i <= 11; $i++) {
            $dig1 += $padrao{$i} * $numeros{$i};
        }

        // Regra padrão
        $dig1 = $dig1 % 11;
        $dig1 = $dig1 < 2 ? 0 : 11 - $dig1;

        // Dando inicio ao segundo passo
        $padrao = 6 .$padrao;
        $numeros = $numeros.$dig1;

        for ($i = 0; $i <= 12; $i++) {
            $dig2 += $padrao{$i} * $numeros{$i};
        }

        // Regra padrão
        $dig2 = $dig2 % 11;
        $dig2 = $dig2 < 2 ? 0 : 11 - $dig2;

        // Atribuindo digitos a variaveis
        if ($dig1.$dig2 != $digito) {
            return false;
        }

        return true;
    }

    public function valor()
    {
        return $this->numero;
    }
}
