<?php
namespace Esic;

class Solicitante
{
    private $chave;
    private $chave_confirmacao;
    private $Cnpj;
    private $Cpf;
    private $data_cadastro;
    private $data_confirmacao;
    private $email;
    private $Endereco;
    private $escolaridade_id;
    private $faixa_etaria_id;
    private $id;
    private $nome;
    private $profissao;
    private $Telefone;
    private $tipo;
    private $senha;
    private $situacao;

    public function __construct(
        $nome = null,
        $tipo = null,
        $doc = null,
        $email = null,
        $faixa_etaria_id = null,
        $escolaridade_id = null,
        $profissao = null,
        Telefone $Telefone = null,
        Endereco $Endereco = null,
        $id = null
    ) {
        // Definições simples
        $this->defNome($nome);
        $this->defTipo($tipo);
        $this->defEmail($email);
        $this->defFaixaEtariaId($faixa_etaria_id);
        $this->defEscolaridadeId($escolaridade_id);
        $this->defProfissao($profissao);
        $this->defId($id);

        if ($Telefone) {
            $this->defTelefone($Telefone);
        }

        if ($Endereco) {
            $this->defEndereco($Endereco);
        }

        // Determinado o tipo de documento para inserir da propriedade correta
        if ($doc instanceof Cnpj) {
            $this->defCnpj($doc);
        } elseif ($doc instanceof Cpf) {
            $this->defCpf($doc);
        }
    }

    public function defChave($chave)
    {
        if (!$chave) {
            $this->chave = null;
        } else {
            $this->chave = $chave;
        }
        return $this;
    }

    public function defChaveConfirmacao($chave)
    {
        if (!$chave) {
            $this->chave_confirmacao = null;
        } else {
            $this->chave_confirmacao = md5($chave);
        }
        return $this;
    }

    public function defCnpj(Cnpj $Cnpj)
    {
        $this->Cnpj = $Cnpj;
        return $this;
    }

    public function defConfirmado($confirmado)
    {
        if (!$confirmado) {
            $this->confirmado = null;
        } else {
            $this->confirmado = (int) $confirmado;
        }
        return $this;
    }

    public function defCpf(Cpf $Cpf)
    {
        $this->Cpf = $Cpf;
        return $this;
    }

    public function defDataCadastro(\DateTime $Data)
    {
        $this->data_cadastro = $Data;
        return $this;
    }

    public function defDataConfirmacao(\DateTime $Data)
    {
        $this->data_confirmacao = $Data;
        return $this;
    }

    public function defEmail($email)
    {
        if (!$email) {
            $this->email = null;
        } else {
            $this->email = (string) $email;
        }
        return $this;
    }

    public function defEndereco(Endereco $Endereco)
    {
        $this->Endereco = $Endereco;
        return $this;
    }

    public function defEscolaridadeId($id)
    {
        if (!$id) {
            $this->escolaridade_id = null;
        } else {
            $this->escolaridade_id = (int) $id;
        }
        return $this;
    }

    public function defFaixaEtariaId($id)
    {
        if (!$id) {
            $this->faixa_etaria_id = null;
        } else {
            $this->faixa_etaria_id = (string) $id;
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

    public function defNome($nome)
    {
        if (!$nome) {
            $this->nome = null;
        } else {
            $this->nome = (string) $nome;
        }
        return $this;
    }

    public function defProfissao($profissao)
    {
        if (!$profissao) {
            $this->profissao = null;
        } else {
            $this->profissao = (string) $profissao;
        }
        return $this;
    }

    public function defSenha($senha)
    {
        if (!$senha) {
            $this->senha = null;
        } else {
            $this->senha = (string) $senha;
        }
        return $this;
    }

    public function defSituacao($sit)
    {
        if (!$sit) {
            $this->situacao = null;
        } else {
            $this->situacao = (int) $sit;
        }
        return $this;
    }

    public function defTipo($tipo)
    {
        if ($tipo != 'F' && $tipo != 'J') {
            $this->tipo = null;
        } else {
            $this->tipo = (string) $tipo;
        }
        return $this;
    }

    public function defTelefone(Telefone $Telefone)
    {
        $this->Telefone = $Telefone;
        return $this;
    }

    /**
     * Codifica a senha
     */
    public function gerarChave()
    {
        $this->defChave(md5($this->obterSenha()));
        return $this->obterChave();
    }

    public function gerarChaveConfirmacao()
    {
        // Se já houver uma chave retornar
        $chave = $this->obterChaveConfirmacao();
        if ($chave) {
            return $chave;
        }

        // Pegando identificação única
        $Cpf = $this->obterCpf();
        $Cnpj = $this->obterCnpj();

        // Verificando qual está vazio
        if ($Cpf) {
            $numero = $Cpf->valor();
        } elseif ($Cnpj) {
            $numero = $Cnpj->valor();
        }

        $numero.= mt_rand();

        $this->defChaveConfirmacao(md5($numero));

        return $this->obterChaveConfirmacao();
    }

    /**
     * Retorna os dados
     */
    public function obterChave()
    {
        return $this->chave;
    }

    public function obterChaveConfirmacao()
    {
        return $this->chave_confirmacao;
    }

    public function obterCnpj()
    {
        return $this->Cnpj;
    }

    public function obterCpf()
    {
        return $this->Cpf;
    }

    public function obterDataCadastro()
    {
        return $this->data_cadastro;
    }

    public function obterDataConfirmacao()
    {
        return $this->data_confirmacao;
    }

    public function obterEmail()
    {
        return $this->email;
    }

    public function obterEndereco()
    {
        return $this->Endereco;
    }

    public function obterEscolaridadeId()
    {
        return $this->escolaridade_id;
    }

    public function obterFaixaEtariaId()
    {
        return $this->faixa_etaria_id;
    }

    public function obterId()
    {
        return $this->id;
    }

    public function obterNome()
    {
        return $this->nome;
    }

    public function obterProfissao()
    {
        return $this->profissao;
    }

    public function obterSenha()
    {
        return $this->senha;
    }

    public function obterSituacao()
    {
        return $this->situacao;
    }

    public function obterTipo()
    {
        return $this->tipo;
    }

    public function obterTelefone()
    {
        return $this->Telefone;
    }
}
