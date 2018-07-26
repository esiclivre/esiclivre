<?php
namespace Esic;

class MensagensLista extends Lista
{
    protected $lista;

    public function __construct()
    {
        $this->lista = [];
    }

    public function adicionar(Mensagem $Mensagem)
    {
        $indice = array_push($this->lista, $Mensagem);
        return $indice -1;
    }

    public function obterPorIndice($i)
    {
        if (isset($this->lista[$i])) {
            return $this->lista[$i];
        }
        die('ver erro');
    }

    public function obterTodas()
    {
        return $this->lista;
    }

    public function obterUltima()
    {
        $Msg = end($this->lista);

        if($Msg){
            return $Msg;
        }

        return new Mensagem('vazio');
    }
}
