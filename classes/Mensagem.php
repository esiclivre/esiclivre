<?php
namespace Esic;

class Mensagem
{
    private $codigo;
    private $dados;
    private $mensagem;
    private $situacao;
    private $tipo;

    public function __construct($codigo, $dados = null)
    {
        // Obtendo mensagem
        $msg = MensagensDados::obter($codigo);

        // Alimentando objeto
        $this->codigo = $codigo;
        $this->mensagem = $msg[1];
        $this->tipo = $msg[0];
        $this->situacao = ($msg[0] == 'sucesso');
        $this->dados = $dados;
    }

    public function obterCodigo()
    {
        return $this->codigo;
    }

    public function obterDados()
    {
        return $this->dados;
    }

    public function obterMensagem()
    {
        return $this->mensagem;
    }

    public function obterSituacao()
    {
        return $this->situacao;
    }

    public function obterTipo()
    {
        return $this->tipo;
    }
}
