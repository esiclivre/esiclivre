<?php
namespace Esic;

class Cpf
{
    private $numero;
    private $situacao;

    public function __construct($numero)
    {
        $this->numero = $this->limpar($numero);
        $this->situacao = $this->validar($numero);
    }

    private function limpar($numero)
    {
        $num = preg_replace('[/^\d/]', '', $numero);
        return (string) $num;
    }

    public function situacao()
    {
        return $this->situacao;
    }

    private function validar($numero)
    {
        $temp  = null;
        $i = preg_match('/^(\d{3})\.?(\d{3})\.?(\d{3})-?(\d{2})$/', $numero, $temp);

        if ($i <= 0) {
            return false;
        }

        $numeros = $temp[1].$temp[2].$temp[3];
        $digito  = $temp[4];
        $cpf     = $numeros.$digito;
        $dig1    = null;
        $dig2    = null;

        // Obtendo o primeiro digito
        // Mutiplicando e somando número padrão com os respectivos números do cpf
        $j = 10; //Valor padrão
        for ($i = 0; $i < 9; $i++) {
            $dig1 += $j * $numeros[$i];
            $j--;
        }

        // Fazendo a divisão por 11 que é padrão
        $dig1 = $dig1 % 11;

        // Regra padrão
        $dig1 = $dig1 < 2 ? 0 : 11 - $dig1;

        // Obtendo o seguindo digito
        $j = 11; //Valor padrão
        $numeros = substr($numeros, 0, 9).$dig1;

        for ($i = 0; $i < 10; $i++) {
            $dig2 += $j * $numeros[$i];
            $j--;
        }

        //Fazendo a divisão por 11 que é padrão
        $dig2 = $dig2 % 11;

        //Regra padrão
        $dig2 = $dig2 < 2 ? 0 : (11 - $dig2);

        //Atribuindo digitos a variaveis
        if ($dig1.$dig2 == $digito) return true;

        return false;
    }

    public function valor()
    {
        return $this->numero;
    }
}
