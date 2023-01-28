# Senha válida
## Prova Backend
<p align="justify">
Joaquim é um jovem estudante que está fazendo junto com sua classe um sistema para sua faculdade.
Cada aluno foi responsável por uma parte do sistema e Joaquim está responsável pela parte do sistema
que verifica a força da senha.
Tendo em vista que o sistema pode ter vários níveis de acesso diferentes, a API que Joaquim deve
produzir precisa trabalhar com vários conjuntos de regras.
</p>

## O Problema
<p align="justify">
Dada uma palavra contínua, e um conjunto de regras, Joaquim precisa verificar se a senha é válida
baseada nas regras pedidas.
</p>
<p>Regras possíveis:</p>

- [x] minSize: tem pelo menos x caracteres.
- [x] minUppercase: tem pelo menos x caracteres maiúsculos
- [X] minLowercase: tem pelo menos x caracteres minúsculos
- [x] minDigit: tem pelo menos x dígitos (0-9)
- [x] minSpecialChars: tem pelo menos x caracteres especiais ( Os caracteres especiais são os
caracteres da seguinte string: "!@#$%^&*()-+\/{}[]" )
[x] noRepeted: não tenha nenhum caractere repetido em sequência ( ou seja, "aab" viola esta
condição, mas "aba" não

## Requisitos
- PHP >= 7.3

### Executando o Projeto
```bash
# Clonar repositório
$ git clone https://github.com/leonardo99/passwordRules

# Acessar a pasta do projeto
$ cd passwordRules

# Baixar as bibliotecas necessárias para executar o projeto
$ composer install --no-scripts

# Gerar chave do projeto
$ php artisan key:generate

# Iniciar o servidor
$ php artisan serve

#O servidor irá iniciar na porta: 8000 - acesse <http://localhost:8000>
```
## Tecnologias

Foram usadas as seguintes tecnologias no desenvolvimento do projeto:

- [Laravel] (https://laravel.com)

Documentação API: https://documenter.getpostman.com/view/4943137/2s8ZDeUz8L 