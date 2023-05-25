# Api_REST_Lumen

Api rest com Laravel Lumen, possui crud para listar todos os elementos do banco, apenas um, inserir novo elemento com chave estrangeira.

### Pré-requisitos

As ferramentas utilizadas foram Laravel 8.2, Lumen 8.2, e MYSQL.

### Instalação
baixar o código, e executar composer install.

### Funcionalidades

A API conecta-se com a base de dados especificada, ela lista todos as orders, ou procurando por placa pegando a primeira.
O cadastro de novas orders podem ser feitos de duas formas, com um user ja existente informando seu id, ou criando um novo user informando seu nome.

## Rotas

### localhost:8000/listall ou localhost:8000/listall?page=N
Esta rota lista todos os dados e todas as colunas contidas na tabela service_orders, ela também tem uma paginação de 5 registros por pagina sendo "n" o numero da pagina desejada.


### localhost:8000/orders/ABC01234
Esta rota é responsável por mostar apenas os dados da order da respectiva placa (neste exemplo a placa ABC01234), substituindo o userId, pelo nome. 


### localhost:8000/new
Esta rota é responsável por cadatrar uma nova service_order em um user ja existente, é necessário que o id do user exista e seja passado.
exemplo do modelo JSON:
{
        "vehiclePlate" : "abc0001",
        "entryDateTime" : "0001-01-01 00:00",
        "exitDateTime" : "0001-01-01 00:00",
        "priceType" : "R$",
        "price" : "7000.00",
        "userId" : "2"
}
A rota também conta com validação para verificar se entryDateTime e exitDateTime estão no formato corretos.

### localhost:8000/newuser
Esta rota é responsável por cadatrar uma nova service_order em um user novo, apenas passando o nome aonde seria passado o userId, será criado um novo user na tabela user com o nome informado, e retornará o novo id que será inserido na tabela service_order na coluna userId.


---
