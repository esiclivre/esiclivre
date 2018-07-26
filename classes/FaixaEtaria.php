<?php
namespace Esic;

/**
 * Contém dados de faixa etária
 */
class FaixaEtaria
{
    private $id;
    private $nome;

    public function __construct($nome, $id = null)
    {
        $this->defNome($nome);
        $this->defId($id);
    }

    public function defId($id)
    {
        if (! $id) {
            $this->id = null;
        } else {
            $this->id = (int) $id;
        }
        return $this;
    }

    public function defNome($nome)
    {
        if (! $nome) {
            $this->nome = null;
        } else {
            $this->nome = (string) $nome;
        }
        return $this;
    }

    public function obterId()
    {
        return $this->id;
    }

    public function obterNome()
    {
        return $this->nome;
    }
}
