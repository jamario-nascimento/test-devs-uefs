# Teste Técnico para a vaga de Engenheiro de Software no projeto UEFS - Avansys/ACP Group

Este desafio é para a posição de Engenheiro de Software e envolve a criação de uma API Restful usando PHP, o framework Laravel (versão 8 ou superior), o Sistema de Gerenciamento de Banco de Dados (SGBD) à sua escolha e Docker. O prazo para este desafio é de 5 dias, com a entrega dos códigos fonte via GitHub para análise no seguinte endereço de e-mail: epp@uefs.br. <br>
Faça um fork do repositório, aplique a solução e envie para avaliação.

## Critérios de Avaliação

- Conhecimento e uso de recursos do Laravel.
- Familiaridade com Docker e doDocker Compose.
- Organização e documentação  código.
- Competência em lógica de programação e nível de abstração.
- Aplicação dos princípios do conceito SOLID.
- Utilização de testes unitários (PHPUnit ou PEST).
- Adesão aos padrões PSR.
- Implementação eficaz de uma API Restful.
- Utilização adequada dos recursos do SGBD escolhido.

## Tarefas

Desenvolva uma API em Laravel que inclua o CRUD para:
- Usuários
- Posts
- Tags

As regras de estruturação da modelagem são:
- O usuário (users) possui diferentes postagens (posts).
- As postagens (posts) possuem várias palavras-chave (tags).

Implemente os seguintes endpoints com operações CRUD para:
- Usuários
- Posts
- Tags

**NOTA:**
As rotas devem ser acessadas com o prefixo /api. Por exemplo: /api/posts  
É essencial o desenvolvimento de um Dockerfile e um docker-compose para garantir que o projeto seja executado na máquina do avaliador.  
É de suma importância a descrição detalhada dos endpoints e funcionalidades para que o avaliador possa testar o projeto em sua máquina.

## Opcionais (Não obrigatórios, mas recomendados)

- Implementação de testes unitários.
- Uso de Swagger ou Scribe Documentation.
- Criação de uma interface gráfica simples para exposição dos dados (React, Vue ou Bootstrap).

Após a avaliação técnica, em caso de aprovação, entraremos em contato para uma conversa técnica sobre a implementação. Se o candidato não for aprovado, forneceremos um retorno com o aviso e o motivo.

<br>

### Boa sorte! <br>
Equipe de Desenvolvimento AVANSYS/ACP - Projeto UEFS


## Projeto - UEFS

Seguir os passos abaixo para a instalação do sistema:

## Iniciar os containers do docker

docker-compose up -d

## Instalar os pacotes do composer

docker-compose exec php-fpm composer install

## Instalar os pacotes do npm

docker-compose exec php-fpm npm install

## Limpar o cache do Laravel

docker-compose exec php-fpm php artisan config:clear
docker-compose exec php-fpm php artisan optimize

## Gerar as tabelas no banco de dados

docker-compose exec php-fpm php artisan migrate

## Teste de código

docker-compose exec php-fpm php artisan make:factory PostFactory

docker-compose exec php-fpm php artisan test

docker-compose exec php-fpm php artisan test --filter testShouldCreatePost
## Documentação - Swagger API

- [Swagger API](http://localhost/api/)
* Observação: É preciso Gerar a doc do swagger
 http://localhost/api/generation.php

## Sobre o Laravel

Laravel é um framework de aplicações web com sintaxe expressiva e elegante. Acreditamos que o desenvolvimento deve ser uma experiência agradável e criativa para ser verdadeiramente gratificante. Ele facilita o desenvolvimento facilitando tarefas comuns usadas em muitos projetos da web

## Documentação

- [Documentação](https://laravel.com/docs)
- [Laracasts](https://laracasts.com)

## Licença

O framework Laravel é um software de código aberto licenciado sob a [MIT license](https://opensource.org/licenses/MIT).
