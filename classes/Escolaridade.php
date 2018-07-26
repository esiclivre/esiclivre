<?php
namespace Esic;

class Escolaridade
{
    public static function obterLista()
    {
        return [
            1 => 'Sem instrução formal',
            2 => 'Ensino Fundamental',
            3 => 'Ensino Médio',
            4 => 'Ensino Superior',
            5 => 'Pós-graduação',
            6 => 'Mestrado/Doutorado'
        ];
    }
}
