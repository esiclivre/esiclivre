<?php

return [
    'app' => [
        'name' => 'e-SIC Livre',
        'description' => 'Sistema Eletrônico do Serviço de Informação ao Cidadão',
        'keyWords' => 'SIC, sistema, informação, acesso, governo, solicitação',
        'url' => 'http://localhost/esiclivre/',
        'entityContact' => [
            'name' => 'Gabinete',
            'phone' => '(88) 1234-5678',
            'mail' => 'contato@orgao.ce.gov.br',
            'address' => 'Rua Nome, nº 00, Bairro, Cidade, Estado - CEP: 00.000-000',
            'serviceHours' => '0h às 0h'
        ]
    ],
    'database' => [
        'drive' => 'mysql',
        'host' => 'localhost',
        'name' => 'esiclivre',
        'password' => '',
        'user' => 'root',
    ],
    'environment' => [
        'mode' => 'development',
        'encoding' => 'utf-8'
    ],
    'session' => [
        'name' => 'esiclivre'
    ],
    'mailSender' => [
        'library' => 'phpmailer',
        'authentication' => true,
        'host' => 'mail.address.com',
        'port' => 587,
        'protocol' => 'tls',
        'name' => 'eSIC Livre',
        'mail' => 'esic@mail.gov.br',
        'user' => 'esic@mail.gov.br',
        'password' => '',
        'verifyCertificates' => false
    ]
];
