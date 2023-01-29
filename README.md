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

## Estrutura do Projeto
- `App/Http/Controllers/RulesPassworController`: Usado para gerenciar as requisições e chamar método de validação da senha para retornar o resultado.

- `App/Services/RuleService`: Classe com implementação responsável pela regra de negócio para realizar a validação da senha. Nela está contida o método `verifyRules`.
    - `verifyRules`: Tem a função de receber um array contendo as regras passadas pelo usuário. Nesse array, são feitas iterações por meio de um `foreach()`. Para cada regra válida é usada a função `call_user_func_array()` para chamar um método com o nome contido na propriedade rule, onde é passando as propriedades rule e value. O método chamado verifica por meio de expressão regular se a senha passada atende os requisitos. Caso o valor retornado seja falso, o nome da regra é adicionado ao array `$validationResult`. Após o loop, é feita uma verificação do tamanho do array `$validationResult`, caso o valor seja maior que zero, é retornado um array com chave verify definida como false e o array `$validationResult` contendo as regras que não foram satisfeitas. Se o tamanho for igual a zero, verifiy é definida como true e o array pessado com valor vazio. 

- `App/Services/RuleRepository`: Essa classe contém os métodos que são herdados pela classe `App/Services/RuleService`. Esses métodos verificam se a senha passada pelo usuário atende a determinados requisitos. Ao final é retornado um array contendo o nome da regra de validação e um valor booleano para indicar se a regra foi ou não atendida.
    - `minSize`: verifica se a senha tem pelo menos o valor definido pelo usuário de caracteres.
    - `minSpecialChars`: verifica se a senha contém a quantidade de caracteres especiais definidas pelo usuário.
    - `minUppercase`: verifica se a senha contém a quantidade de letras maiúsculas definidas pelo usuário.
    - `minLowercase`: verifica se a senha contém a quantidade de letras minúsculas definidas pelo usuário.
    - `minDigit`: verifica se a senha contém a quantidade de dígitos definidos pelo usuário.
    - `noRepeted`: verifica se a senha contém a quantidade definida pelo usuário de caractere repetido.
    
## Links
- Documentação API: https://documenter.getpostman.com/view/4943137/2s8ZDeUz8L
- Endpoint de teste: https://passwordtest.fly.dev/api/verify