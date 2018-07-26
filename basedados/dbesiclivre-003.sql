ALTER TABLE `lda_solicitacao`
    CHANGE `resposta` `resposta` VARCHAR(4000) NULL;

ALTER TABLE `lda_solicitante`
    CHANGE `logradouro` `logradouro` VARCHAR(200) NULL,
    CHANGE `numero` `numero` VARCHAR(20) NULL COMMENT 'numero do endereço',
    CHANGE `bairro` `bairro` VARCHAR(60) NULL,
    CHANGE `cep` `cep` VARCHAR(8) NULL,
    CHANGE `cidade` `cidade` VARCHAR(100) NULL,
    CHANGE `uf` `uf` CHAR(2) NULL,
    ADD `chave_confirmacao` CHAR(32) NULL AFTER `chave`;
