<?php
namespace Esic;

class Estado
{
    private $id;
    private $nome;
    private $pais_id;
    private $uf;

    public function __construct($nome, $uf, $pais_id, $id = null)
    {
        $this->defNome($nome);
        $this->defUf($uf);
        $this->defPaisId($pais_id);
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

    public function defPaisId($pais_id)
    {
        if (! $pais_id) {
            $this->pais_id = null;
        } else {
            $this->pais_id = (int) $pais_id;
        }
        return $this;
    }

    public function defUf($uf)
    {
        if (! $uf) {
            $this->uf = null;
        } else {
            $this->uf = (string) $uf;
        }
        return $this;
    }

    public function obterId(){
        return $this->id;
    }

    public function obterNome(){
        return $this->nome;
    }

    public function obterPaisId(){
        return $this->pais_id;
    }

    public function obterUf(){
        return $this->uf;
    }
}
