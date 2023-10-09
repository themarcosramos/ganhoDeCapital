# Code Challenge : Ganho de Capital

 Para o desenvolvimento do projeto optei por utilizar a linguagem que tenho mais experiência que no caso é a linguagem PHP.


## Dependências ou Pré-requisitos 
 Para a execução  localmente na máquina é necessário ter instalado o: 

    PHP 8.0
    Composer 2.6.2


### Executando o cli
 Para execução do projeto baixe o projeto acesse o diretório do projeto e execute o comando 

 ```
 composer install 
 ```

 start o php  se por acaso não estiver startado, se desloque até  o diretório   ``` cli/ ```  e execute o comando 

``` php index.php < input.txt ```

 e depois pressione o enter, se deseja que sua entrada de dado não seja um arquivo, e sim gostaria de inserir manualmente 


 ``` php index.php ``` [Dados respeitando o modelo](#modelo-dados-para-ser-inserido-manualmente)
 
  e depois pressione o enter


### Modelo dados para ser inserido manualmente
 - `[{"operation":"buy", "unit-cost":10.00, "quantity": 10000},{"operation":"sell", "unit-cost":20.00, "quantity": 5000}]`


### Modelo dados para o arquivo
 - `[{"operation":"buy", "unit-cost":10.00, "quantity": 10000},{"operation":"sell", "unit-cost":20.00, "quantity": 5000}]`

  - `[{"operation":"buy", "unit-cost":20.00, "quantity": 10000},{"operation":"sell", "unit-cost":10.00, "quantity": 5000}]`


### Saída de dados 
- `[{"tax":0},{"tax":10000}][{"tax":0},{"tax":0}],`


### Teste 
 para execução do teste  que foram desenvolvido a principal biblioteca de teses  do php que o PHPUnit  execute o comando a seguir  pelo terminal  na raiz  do projeto 

```
   vendor/phpunit/phpunit/phpunit -c tests/phpunit.unit.xml --no-coverage"
``` 

## Sobre o projeto
 Para o desenvolvimento  do projeto  pensei inicialmente em fazer utilizando Domain Driven Design  com a  camada cálculos na camada de Application, porém entender  que poderia  está fazendo over engineering, então optei utiliza uma versão mais enxuta  do MVC , garantido a "simplicidade" e "elegância" exigida no teste.
