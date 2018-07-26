<?php
namespace Esic;

/**
 * Armazena uma lista de objetos Estado
 */
class EstadosLista extends Lista
{
    protected $lista = [];

    public function adicionar(Estado $Estado)
    {
        $this->lista[] = $Estado;
    }
}
