<?php
namespace Esic;

class Conexao
{
    private $Conexao;
    private $conexao_extrangeira;
    private $Mensagens;

    public function __construct()
    {
        $this->Mensagens = new MensagensLista;
    }

    /**
    * Realiza uma conexão
    **/
    public function obter(\PDO $Cx = null)
    {
        // Para cassos onde uma conexão já estabelecida será utilizada
        // útil para transições no bd e poucar conexões
        if ($Cx) {
            $this->conexao_extrangeira = true;
            return $this->Conexao = $Cx;
        }

        // Se já houver uma conexão estabelecida retorna-lá
        if ($this->Conexao) {
            return $this->Conexao;
        }

        try {
            $bd_tipo = DB_TIPO;
            $bd_nome = DBNAME;
            $bd_host = DBHOST;
            $banco = "{$bd_tipo}:dbname={$bd_nome};host={$bd_host};charset=utf8";
            $this->Conexao = new \PDO($banco, DBUSER, DBPASS);
        } catch (\Exception $e) {
            $this->Mensagens->adicionar(
                new Mensagem('conexao-erro', $e)
            );
            return false;
        }

        $this->Mensagens->adicionar(new Mensagem('conexao-sucesso'));
        $this->conexao_extrangeira = false;

        // Configurações da conexão
        $this->Conexao->exec("SET TIME_ZONE='-3:00'");

        return $this->Conexao;
    }

    public function obterMensagens()
    {
        return $this->Mensagens;
    }
}
