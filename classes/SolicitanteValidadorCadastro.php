<?php
namespace Esic;

/**
 * Verifica se um objeto Solicitante atende as dados
 * mínimos necessários para permitir o cadastro
 */
class SolicitanteValidadorCadastro
{
    private static $Mensagens;
    private static $indice;

    public static function checar(Solicitante $Solicitante, $extra = null)
    {
        self::$Mensagens = new MensagensLista;
        self::$indice = array();

        $email = isset($extra['email']) ? $extra['email'] : null;
        $senha = isset($extra['senha']) ? $extra['senha'] : null;

        $nome = self::checarNome($Solicitante);
        $tipo = self::checarTipo($Solicitante);
        $emails = self::checarEmail($Solicitante, $email);
        $senha = self::checarSenha($Solicitante, $senha);
        $duplicidade = self::checarDuplicidade($Solicitante);

        return $nome && $tipo && $emails && $senha && $duplicidade;
    }

    /**
     * Verifica se o e-mail é válido e se é identico ao de confirmação
     */
    public static function checarDuplicidade(Solicitante $Solicitante)
    {
        if (
            $Solicitante->obterTipo() == 'F' &&
            ($Cpf = $Solicitante->obterCpf())
        ) {
            $param = array(
                'tipo' => 'F',
                'cpf' => $Cpf->valor()
            );
        } elseif (($Cnpj = $Solicitante->obterCnpj())) {
            $param = array(
                'tipo' => 'F',
                'cnpj' => $Cnpj->valor()
            );
        }

        $Bd = new SolicitanteBd;
        $SolicComp = $Bd->obter($param);

        // Caso nã encontre
        if ($SolicComp === null) {
            return true;
        }

        // Verificando tipo de pessoa
        if ($param['tipo'] == 'F') {
            self::$indice['cpf'] = self::$Mensagens->adicionar(
                new Mensagem('solicitante-cpf-ja-cadastrado')
            );
        } else {
            self::$indice['cnpj'] = self::$Mensagens->adicionar(
                new Mensagem('solicitante-cnpj-ja-cadastrado')
            );
        }

        return false;
    }

    /**
     * Verifica se o e-mail é válido e se é identico ao de confirmação
     */
    public static function checarEmail(
        Solicitante $Solicitante,
        $conferencia = null
    ) {
        $email = $Solicitante->obterEmail();
        if (! $email) {
            self::$indice['email'] = self::$Mensagens->adicionar(
                new Mensagem('solicitante-email-vazio')
            );
            return false;
        } elseif ($email != $conferencia) {
            self::$indice['email'] = self::$Mensagens->adicionar(
                new Mensagem('solicitante-email-diferente')
            );
            return false;
        } elseif (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            self::$indice['email'] = self::$Mensagens->adicionar(
                new Mensagem('solicitante-email-invalido')
            );
            return false;
        }
        return true;
    }

    /**
     * Checa se o nome foi definido
     */
    public static function checarNome(Solicitante $Solicitante)
    {
        if ($Solicitante->obterNome()) {
            return true;
        }

        self::$indice['nome'] = self::$Mensagens->adicionar(
            new Mensagem('solicitante-nome-indefinido')
        );

        return false;
    }

    /**
     * Verifica se a senha está indentica a confirmação
     */
    public static function checarSenha(
        Solicitante $Solicitante,
        $conferencia = null
    ) {
        $senha = $Solicitante->obterSenha();
        if ($senha != $conferencia) {
            self::$indice['senha'] = self::$Mensagens->adicionar(
                new Mensagem('solicitante-senha-diferente')
            );
            return false;
        } elseif (! $senha) {
            self::$indice['senha'] = self::$Mensagens->adicionar(
                new Mensagem('solicitante-senha-vazia')
            );
            return false;
        }
        return true;
    }

    /**
     * Verifica se informou se é pesso física ou juridica e se
     * os documentos relativos foram informados
     */
    public static function checarTipo(Solicitante $Solicitante)
    {
        $tipo = $Solicitante->obterTipo();

        if (!$tipo) {
            self::$indice['tipo'] = self::$Mensagens->adicionar(
                new Mensagem('solicitante-tipo-indefinido')
            );
            return false;
        } elseif ($tipo == 'F') {
            $Cpf = $Solicitante->obterCpf();
            if (!$Cpf) {
                self::$indice['cpf'] = self::$Mensagens->adicionar(
                    new Mensagem('solicitante-cpf-indefinido')
                );
                return false;
            } elseif (! $Cpf->situacao()) {
                self::$indice['cpf'] = self::$Mensagens->adicionar(
                    new Mensagem('solicitante-cpf-invalido')
                );
                return false;
            }
        } elseif ($tipo == 'J') {
            $Cnpj = $Solicitante->obterCnpj();
            if (!$Cnpj) {
                self::$indice['cnpj'] = self::$Mensagens->adicionar(
                    new Mensagem('solicitante-cnpj-indefinido')
                );
                return false;
            } elseif (! $Cnpj->situacao()) {
                self::$indice['cnpj'] = self::$Mensagens->adicionar(
                    new Mensagem('solicitante-cnpj-invalido')
                );
                return false;
            }
        }

        return true;
    }

    /**
     * Retorna as mensagens
     */
    public static function obterErros()
    {
        return self::$indice['cpf'];
    }

    public static function obterErroCpf()
    {
        if (self::situacaoCpf()) {
            return null;
        }
        $id = self::$indice['cpf'];
        return self::$Mensagens->obterPorIndice($id);
    }

    public static function obterErroCnpj()
    {
        if (self::situacaoCnpj()) {
            return null;
        }

        $id = self::$indice['cnpj'];
        return self::$Mensagens->obterPorIndice($id);
    }

    public static function obterErroEmail()
    {
        if (self::situacaoEmail()) {
            return null;
        }

        $id = self::$indice['email'];
        return self::$Mensagens->obterPorIndice($id);
    }

    public static function obterErroNome()
    {
        if (self::situacaoNome()) {
            return null;
        }

        $id = self::$indice['nome'];
        return self::$Mensagens->obterPorIndice($id);
    }

    public static function obterErroSenha()
    {
        if (self::situacaoSenha()) {
            return null;
        }

        $id = self::$indice['senha'];
        return self::$Mensagens->obterPorIndice($id);
    }

    public static function obterErroTipo()
    {
        if (self::situacaoTipo()) {
            return null;
        }

        $id = self::$indice['tipo'];
        return self::$Mensagens->obterPorIndice($id);
    }

    /**
     * Verifica a situação dos campos
     */
    public static function situacaoCpf()
    {
        return ! isset(self::$indice['cpf']);
    }

    public static function situacaoCnpj()
    {
        return ! isset(self::$indice['cnpj']);
    }

    public static function situacaoEmail()
    {
        return ! isset(self::$indice['email']);
    }

    public static function situacaoNome()
    {
        return ! isset(self::$indice['nome']);
    }

    public static function situacaoSenha()
    {
        return ! isset(self::$indice['senha']);
    }

    public static function situacaoTipo()
    {
        return ! isset(self::$indice['tipo']);
    }
}
