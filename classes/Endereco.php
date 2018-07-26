<?php
namespace Esic;

class Endereco
{
    private $bairro;
    private $cep;
    private $complemento;
    private $logradouro;
    private $numero;
    private $cidade_id;
    private $cidade_nome;
    private $estado_uf;
    private $id;

    function __construct (
        $logradouro = null,
        $numero = null,
        $bairro = null,
        $complemento = null,
        $cep = null,
        $cidade_nome = null,
        $estado_uf = null,
        $id = null
    ) {
        $this->defLogradouro($logradouro);
        $this->defNumero($numero);
        $this->defBairro($bairro);
        $this->defComplemento($complemento);
        $this->defCep($cep);
        $this->defCidadeNome($cidade_nome);
        $this->defEstadoUf($estado_uf);
        $this->defId($id);
    }

    /**
    * Definições de valores
    */
    public function defBairro($bairro)
    {
        if (!$bairro) {
            $this->bairro = null;
        } else {
            $this->bairro = (string) $bairro;
        }
        return $this;
    }

    public function defCep($cep)
    {
        if (!$cep) {
            $this->cep = null;
        } else {
            $this->cep = (int) $cep;
        }
        return $this;
    }

    public function defCidadeNome($cidade_nome)
    {
        if (!$cidade_nome) {
            $this->cidade_nome = null;
        } else {
            $this->cidade_nome = (string) $cidade_nome;
        }
        return $this;
    }

    public function defComplemento($complemento)
    {
        if (!$complemento) {
            $this->complemento = null;
        } else {
            $this->complemento = (string) $complemento;
        }
        return $this;
    }

    public function defEstadoUf($estado_uf)
    {
        if (!$estado_uf) {
            $this->estado_uf = null;
        } else {
            $this->estado_uf = (string) $estado_uf;
        }
        return $this;
    }

    public function defId($id)
    {
        if (!$id) {
            $this->id = null;
        } else {
            $this->id = (int) $id;
        }
        return $this;
    }

    public function defLogradouro($logradouro)
    {
        if (!$logradouro) {
            $this->logradouro = null;
        } else {
            $this->logradouro = (string) $logradouro;
        }
        return $this;
    }

    public function defNumero($numero)
    {
        if (!$numero) {
            $this->numero = null;
        } else {
            $this->numero = (string) $numero;
        }
        return $this;
    }

    /**
    * Obtenção de valores
    */
    public function obterBairro()
    {
        return $this->bairro;
    }

    public function obterCep()
    {
        return $this->cep;
    }

    public function obterCidadeNome()
    {
        return $this->cidade_nome;
    }

    public function obterComplemento()
    {
        return $this->complemento;
    }

    public function obterEstadoUf()
    {
        return $this->estado_uf;
    }

    public function obterId()
    {
        return $this->id;
    }

    public function obterLogradouro()
    {
        return $this->logradouro;
    }

    public function obterNumero()
    {
        return $this->numero;
    }
}
