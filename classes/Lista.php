<?php
namespace Esic;

abstract class Lista
{
    protected $lista = array();

    /**
    * Mistura os valores do array
    * ----
    * @Entrada: Nada
    * @Efeito: Altera a ordem dos elementos da propriedade lista
    * @Retorno: Objeto - o próprio
    **/
    public function embarralhar()
    {
        shuffle($this->lista);
        return $this;
    }

    /**
     * Retorna um elemento do array conforme a
     * possição passada
     * ----
     * @Entrada: $pos - INT - número da posição começando em 0.
     * @Retorno:
     * - Objeto - conforme o definido na classe que herdar
     * - Booleano - False caso não exista elemento no indice especificado
     */
    public function obter($pos)
    {
        if(! isset( $this->lista[$pos])) {
            return false;
        }

        return $this->lista[$pos];
    }

    /**
    * Retorna a lista de objetos
    * ----
    * @Entrada: nada
    * @Retorno: ARRAY
    **/
    public function obterLista()
    {
        return $this->lista;
    }

    /**
     * Retorna o elemento atualmente apontado
     * ----
     * @Entrada: nada
     * @Efeito: avança o ponteiro da lista para o próximo item
     * @Retorno: objeto
     */
    public function obterProximo()
    {
        $atual = current( $this->lista );

        if (! $atual) {
            reset($this->lista);
        } else {
            next($this->lista);
        }

        return $atual;
    }

    /**
     * Retorna o total de itens
     * ----
     * @Retorno: Inteiro
     */
    public function total()
    {
        return count($this->lista);
    }

    /**
     * Volta o ponteiro da lista para o primeiro item
     * ----
     * @Efeito: altera a posição do indice do array interno
     * @Retorno: Objeto - O próprio
     */
    public function zerarIndice()
    {
        reset($this->lista);
        return $this;
    }
}
