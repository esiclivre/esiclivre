<?php
namespace Esic;

class Telefone
{
    private $ddd;
    private $numero;
    private $tipo_id;

    function __construct (
        $ddd = null,
        $numero = null,
        $tipo_id = null
    ) {
        $this->defDdd($ddd);
        $this->defNumero($numero);
        $this->defTipoId($tipo_id);
    }

    /**
    * Definições de valores
    */
    public function defDdd($ddd)
    {
        if (!$ddd) {
            $this->ddd = null;
        } else {
            $this->ddd = (int) $ddd;
        }
        return $this;
    }

    public function defNumero($numero)
    {
        if (!$numero) {
            $this->numero = null;
        } else {
            $this->numero = (int) $numero;
        }
        return $this;
    }

    public function defTipoId($id)
    {
        if (!$id) {
            $this->tipo_id = null;
        } else {
            $this->tipo_id = (int) $id;
        }
        return $this;
    }

    /**
    * Obtenção de valores
    */
    public function obterDdd()
    {
        return $this->ddd;
    }

    public function obterNumero()
    {
        return $this->numero;
    }

    public function obterTipoId()
    {
        return $this->tipo_id;
    }
}
