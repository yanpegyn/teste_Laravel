## Comandos Utilizados

composer create-project --prefer-dist laravel/laravel teste

CREATE SCHEMA `laravel` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;

php artisan make:model Categoria -m

php artisan make:model Produto -m

composer require laravel/passport

php artisan migrate

php artisan passport:install

php artisan make:controller PassportAuthController

php artisan make:controller CategoriaController

php artisan serve

## Observações

Para enviar comandos aos CRUD's é necessário estar autenticado.\
Após o Login, em caso de sucesso, será retornado um Token.\
O Token deve ser enviado no Header "Authorization" com o tipo Bearer, para que seja possível acessar rotas de CRUD.

Há um arquivo chamado "Insomnia.json", que pode ser importado no Insomnia Core, o que ajuda a visualizar as rotas.\
Link para download do Insomnia: [Download Insomnia Core](https://insomnia.rest/download/)

## Rotas de Cadastro e Autenticação

**_Registro: /api/register_**\
method: POST
```
{
	"name": "required|min:3",
	"email": "required|email",
	"password": "required|min:8"
}
```

**_Login: /api/login_**\
method: POST
```
{
	"email": "required|email",
	"password": "required|min:8"
}
```

## CRUD de Categoria

**_Create: /api/categoria_**\
method: POST
```
{
	"nome": "required|String"
}
```

**_Read (all): /api/categoria_**\
**_Read (single): /api/categoria/{id}_**\
method: GET

**_Update: /api/categoria/{id}_**\
method: PUT
```
{
	"nome": "required|String"
}
```

**_Delete: /api/categoria/{id}_**\
method: DELETE

## CRUD de Produto

**_Create: /api/produto_**\
method: POST
```
{
	"categoria_id": "required|exists:categorias,id",
	"nome": "required|String",
	"preco": "required|numeric|min:0"
}
```

**_Read (all): /api/produto_**\
**_Read (single): /api/produto/{id}_**\
method: GET

**_Update: /api/produto/{id}_**\
method: PUT
```
{
	"categoria_id": "required|exists:categorias,id",
	"nome": "required|String",
	"preco": "required|numeric|min:0"
}
```

**_Delete: /api/produto/{id}_**\
method: DELETE
