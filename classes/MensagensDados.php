<?php
namespace Esic;

class MensagensDados
{
    private static $mensagens = [
        'msg-nao-existe' => ['erro', 'Não foi possível obter a mensagem'],
        'msg-vazia' => ['alerta', 'Não há mensagens'],
        'carteiro-envio-erro' => ['erro', 'Ocorreu um erro ao tentar enviar o e-mail'],
        'carteiro-envio-sucesso' => ['sucesso', 'Email enviado com sucesso'],
        'conexao-erro' => ['erro', 'Ocorreu um erro na Conexão com o Banco de Dados'],
        'conexao-sucesso' => ['sucesso', 'Conexão com o Banco de Dados estabelecido'],
        'estados-obter-lista-sucesso' => ['sucesso', 'Lista de estados obtidos com sucesso'],
        'faixa-etaria-conversao-falha' => ['alerta', 'Ocorreu um erro na conversão de dados de uma faixa etária'],
        'faixa-etaria-lista-conversao-falha' => ['alerta', 'Ocorreu um erro na conversão de dados de uma lista de faixas etárias'],
        'faixa-etaria-obter-lista-erro' => ['erro', 'Ocorreu um erro ao tentar obter uma lista de faixas etárias'],
        'faixa-etaria-obter-lista-sucesso' => ['sucesso', 'Lista de faixas etárias obtidas com sucesso'],
        'faixa-etaria-obter-lista-vazia' => ['alerta', 'Não há faixas etárias cadastradas'],
        'solicitante-cadastro-erro' => ['erro', 'Ocorreu um erro ao tentar cadastrar o solicitante'],
        'solicitante-cadastro-sucesso' => ['sucesso', 'Solicitante cadastro com sucesso'],
        'solicitante-cpf-indefinido' => ['alerta', 'O CPF não foi informado'],
        'solicitante-cpf-invalido' => ['alerta', 'O CPF informado é inválido'],
        'solicitante-cpf-ja-cadastrado' => ['alerta', 'Já existe um solicitante cadastrado com este CPF'],
        'solicitante-cnpj-indefinido' => ['alerta', 'O CNPJ não foi informado'],
        'solicitante-cnpj-invalido' => ['alerta', 'O CNPJ informado é inválido'],
        'solicitante-cnpj-ja-cadastrado' => ['alerta', 'Já existe um solicitante cadastrado com este CNPJ'],
        'solicitante-confirmacao-chave-invalida' => ['alerta', 'A chave fornecida é inválida'],
        'solicitante-confirmacao-chave-nao-informada' => ['alerta', 'A chave para validação da conta não foi informada'],
        'solicitante-confirmacao-chave-valida' => ['sucesso', 'A Chave de confirmação de cadastro é válida'],
        'solicitante-confirmacao-erro' => ['erro', 'Ocorreu um erro ao tentar confirmar o cadastro. Favor tente novamente'],
        'solicitante-confirmacao-sucesso' => ['sucesso', 'Confirmação efetuada com sucesso. Obrigado'],
        'solicitante-email-diferente' => ['alerta', 'Os e-mails não conferem'],
        'solicitante-email-invalido' => ['alerta', 'O e-mail informado não é válido'],
        'solicitante-email-vazio' => ['alerta', 'O e-mail não foi informado'],
        'solicitante-obter-erro' => ['erro', 'Ocorreu um erro ao tentar obter o solicitante'],
        'solicitante-obter-sucesso' => ['sucesso', 'Solicitante obtido com sucesso'],
        'solicitante-obter-vazio' => ['alerta', 'Nenhum solicitante foi obtido'],
        'solicitante-nome-indefinido' => ['alerta', 'O nome não foi informado'],
        'solicitante-senha-diferente' => ['alerta', 'As senhas não conferem'],
        'solicitante-senha-vazia' => ['alerta', 'A senha não foi informada'],
        'solicitante-tipo-indefinido' => ['alerta', 'Não foi especificado se o solicitante é uma pessoa física ou jurídica'],
    ];

    public static function obter($codigo)
    {
        if (!array_key_exists($codigo, self::$mensagens)) {
            $codigo = 'msg-nao-existe';
        }

        return self::$mensagens[$codigo];
    }
}
