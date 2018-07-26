<?php
namespace Esic;

/**
 * Armazena uma lista de objetos FaixaEtaria
 */
class FaixaEtariaLista extends Lista
{
    protected $lista = [];

    public function adicionar(FaixaEtaria $FaixaEtaria)
    {
        $this->lista[] = $FaixaEtaria;
    }
}
