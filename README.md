# e-SIC Livre

O e-SIC Livre é um sistema Eletrônico do Serviço de Informação ao Cidadão (e-SIC) que permite aos seus usuários solicitar informações políticas e sociais de órgãos públicos, seguindo os parâmetros determinados na [LAI - Lei de Acesso à Informação (Lei nº 12.527/2011)](http://www.planalto.gov.br/ccivil_03/_ato2011-2014/2011/lei/l12527.htm).

O software foi desenvolvido inicialmente pela Secretaria Municipal de Planejamento, Fazenda e Tecnologia da Informação (SEMPLA - Natal/RN) e disponibilizado sobre a licença [GNU General Public License, version 2](https://www.gnu.org/licenses/old-licenses/gpl-2.0.html).

Este repositório é um fork do projeto originalmente disponibilizado em [https://softwarepublico.gov.br/gitlab/e-sic-livre/e-sic-livre](https://softwarepublico.gov.br/gitlab/e-sic-livre/e-sic-livre).


## Requisitos 

- Apache v2
- PHP v7.4
- Mysql v14.14
- Composer 1.9
- NPM 6.13
- Node 8.9

Observação: Requisitos de desenvolvimento, para produção ver na [Página Requisitos da Wiki](https://github.com/ciebit/esiclivre/wiki/Requisitos)


## Configuração

### 1. Banco de dados

Cria um banco de dados e importa, em ordem, os arquivos contidos na pasta `basedados`.

### 2. Dependências

Executar os seguintes comandos:

```
composer install
npm install
```

### 3. Build
```
npm run build
```

### 4. Configuração do ambiente

Fazer uma cópida do arquivo `settings.example.php` para o mesmo diretório mas com nome `settings.php`.