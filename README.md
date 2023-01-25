## O Problema
Dada uma palavra contínua, e um conjunto de regras, Joaquim precisa verificar se a senha é válida
baseada nas regras pedidas.
- Regras possíveis:
[x] minSize: tem pelo menos x caracteres.
[x] minUppercase: tem pelo menos x caracteres maiúsculos
[] minLowercase: tem pelo menos x caracteres minúsculos
[] minDigit: tem pelo menos x dígitos (0-9)
[x] minSpecialChars: tem pelo menos x caracteres especiais ( Os caracteres especiais são os
caracteres da seguinte string: "!@#$%^&*()-+\/{}[]" )
[] noRepeted: não tenha nenhum caractere repetido em sequência ( ou seja, "aab" viola esta
condição, mas "aba" não