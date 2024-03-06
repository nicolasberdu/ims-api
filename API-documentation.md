# **Servicio de Inventario** [Api-Docs]

## Autenticación
El servicio de inventario brinda autorizacion al cliente por medio de tokens de tipo _bearer_

Para obtener un token de autorizacion primero necesitas tener un usuario en el servicio

<br>
<hr>

### Registro
#### Url: **[POST]** `http://tu.dominio/api/register`
#### Body:
- **name:** required | string
- **email:** required | email | unico
- **password:** required | string



#### Ejemplo de request:
```
POST /api/register HTTP/1.1
Host: 127.0.0.1:8000
Content-Type: application/x-www-form-urlencoded
Content-Length: 68

name={{username}}&email={{email}}&password={{password}}
```

<br>
<hr>

### Login
#### Url: **[POST]** `http://tu.dominio/api/login`
#### Body:
- **email:** required | email | unico
- **password:** required | string

#### Ejemplo de request:
```
POST /api/login HTTP/1.1
Host: 127.0.0.1:8000
Content-Type: application/x-www-form-urlencoded
Content-Length: 50

email={{email}}&password={{password}}
```
<br>
<hr>

### User Info
#### Url: **[GET]** `http://tu.dominio/api/userinfo`
#### Header:
- **Authorization:** Bearer {{token}}


#### Ejemplo de request:
```
GET /api/userinfo HTTP/1.1
Host: 127.0.0.1:8000
Accept: application/json
Authorization: Bearer 1|F9HrCmmQQ7811j4HhwfD1AqRQVvY3oRMFOrcbUEm70577387
```

## Categorias
### Index (indice)
#### Url: **[GET]** `http://tu.dominio/api/categories`
#### Header:
- **Authorization:** Bearer {{token}}
#### Query Params
- **per_page:** integer
- **search:** string 
#### Ejemplo de request:
```
GET /api/categories?per_page=5&search=egoria de ejem HTTP/1.1
Host: 127.0.0.1:8000
Authorization: Bearer 1|qkJE5ujQKPaB9KJKqp043KvWzvHHwmTStLIFMZsw77502b92
```
#### Ejemplo de response:
```
{
    "count": 5,
    "next": "http://127.0.0.1:8000/api/categories?per_page=5&search=egoria%20de%20ejem&page=2",
    "previous": null,
    "results": [
        {
            "code": "cat10",
            "category": "categoria 10",
            "description": "categoria de ejemplo",
            "created_at": "2024-03-05T14:27:03.000000Z",
            "updated_at": "2024-03-05T14:27:03.000000Z",
            "url": "http://127.0.0.1:8000/api/categories/cat10"
        },
        {
            "code": "cat11",
            "category": "categoria 11",
            "description": "categoria de ejemplo",
            "created_at": "2024-03-05T14:27:10.000000Z",
            "updated_at": "2024-03-05T14:27:10.000000Z",
            "url": "http://127.0.0.1:8000/api/categories/cat11"
        }
    ]
}
```

<br>
<hr>

### Create (crear)
#### Url: **[POST]** `http://tu.dominio/api/categories`
#### Header:
- **Authorization:** Bearer {{token}}
#### Body: 
- **code:** required | string | unico
- **category:** required | string | unico
- **description:** string

#### Ejemplo de request:
```
POST /api/categories HTTP/1.1
Host: 127.0.0.1:8000
Authorization: Bearer 1|qkJE5ujQKPaB9KJKqp043KvWzvHHwmTStLIFMZsw77502b92
Content-Type: application/x-www-form-urlencoded
Content-Length: 71

code=cat13&category=categoria%2013&description=categoria%20de%20ejemplo
```
#### Ejemplo de response:
```
"Recurso creado exitosamente"
```

<br>
<hr>

### Show (mostrar)
#### Url: **[GET]** `http://tu.dominio/api/categories/{code}`
#### Header:
- **Authorization:** Bearer {{token}}

#### Ejemplo de request:
```
GET /api/categories/cat5 HTTP/1.1
Host: 127.0.0.1:8000
Authorization: Bearer 3|GBsVuPfWhi3Ifq9NzEGyxFLEXmCvhRrYeiwEzkGIca437c7b
```
#### Ejemplo de response:
```
{
    "code": "cat5",
    "category": "categoria 5",
    "description": "categoria de ejemplo",
    "created_at": "2024-03-05T14:26:17.000000Z",
    "updated_at": "2024-03-05T14:26:17.000000Z",
    "url": "http://127.0.0.1:8000/api/categories/cat5"
}
```

<br>
<hr>

### Update (actualizar)
#### Url: **[PUT]** `http://tu.dominio/api/categories/{code}`
#### Header:
- **Authorization:** Bearer {{token}}
#### Body: 
- **code:** string | unico
- **category:** string | unico
- **description:** string

#### Ejemplo de request:
```
PUT /api/categories/cat6 HTTP/1.1
Host: 127.0.0.1:8000
Authorization: Bearer 1|qkJE5ujQKPaB9KJKqp043KvWzvHHwmTStLIFMZsw77502b92
Content-Type: application/x-www-form-urlencoded
Content-Length: 74

category=categoria%2060&description=categoria%20de%20ejemplo%20actualizada
```
#### Ejemplo de response:
```
{
    "code": "cat6",
    "category": "categoria 60",
    "description": "categoria de ejemplo actualizada",
    "created_at": "2024-03-05T14:26:40.000000Z",
    "updated_at": "2024-03-05T23:03:04.000000Z"
}
```

<br>
<hr>

### Delete (eliminar)
#### Url: **[DELETE]** `http://tu.dominio/api/categories/{code}`
#### Header:
- **Authorization:** Bearer {{token}}

#### Ejemplo de request:
```
DELETE /api/categories/cat5 HTTP/1.1
Host: 127.0.0.1:8000
Authorization: Bearer 3|GBsVuPfWhi3Ifq9NzEGyxFLEXmCvhRrYeiwEzkGIca437c7b
```
#### Ejemplo de response:
```
"Eliminado exitosamente"
```


## Productos

### Index (indice)
#### Url: **[GET]** `http://tu.dominio/api/products`
#### Header:
- **Authorization:** Bearer {{token}}
#### Query Params
- **per_page:** integer
- **search:** string 
#### Ejemplo de request:
```
GET /api/products HTTP/1.1
Host: 127.0.0.1:8000
Authorization: Bearer 1|qkJE5ujQKPaB9KJKqp043KvWzvHHwmTStLIFMZsw77502b92
```
#### Ejemplo de response:
```
{
    "count": 4,
    "next": null,
    "previous": null,
    "results": [
        {
            "code": 510017,
            "product_name": "producto 7",
            "description": "producto de ejemplo",
            "category_code": null,
            "category_url": null,
            "price": 10.07,
            "is_enabled": 1,
            "created_at": "2024-03-05T15:28:26.000000Z",
            "updated_at": "2024-03-05T15:28:26.000000Z",
            "url": "http://127.0.0.1:8000/api/products/510017"
        },
        {
            "code": 510018,
            "product_name": "producto 8",
            "description": "producto de ejemplo",
            "category_code": "cat10",
            "category_url": "http://127.0.0.1:8000/api/categories/cat10",
            "price": 10.07,
            "is_enabled": 1,
            "created_at": "2024-03-05T20:05:02.000000Z",
            "updated_at": "2024-03-05T20:05:02.000000Z",
            "url": "http://127.0.0.1:8000/api/products/510018"
        }
    ]
}
```

<br>
<hr>

### Create (crear)
#### Url: **[POST]** `http://tu.dominio/api/products`
#### Header:
- **Authorization:** Bearer {{token}}
#### Body: 
- **code:** required | string | unico
- **product_name:** required | string | unico
- **description:** string
- **category_code:** string | exist:api.categories
- **price:** decimal:.2
- **is_enabled:** boolean[1,0]

#### Ejemplo de request:
```
POST /api/products HTTP/1.1
Host: 127.0.0.1:8000
Authorization: Bearer 1|qkJE5ujQKPaB9KJKqp043KvWzvHHwmTStLIFMZsw77502b92
Content-Type: application/x-www-form-urlencoded
Content-Length: 161

code=510021&product_name=producto%2021&description='%3B%20%3Cscript%3Ealert('Vulnerable%20to%20XSS!')%3C%2Fscript%3E&category_code=cat10&price=10.07&is_enabled=1
```
#### Ejemplo de response:
```
"Recurso creado exitosamente"
```

<br>
<hr>

### Show (mostrar)
#### Url: **[GET]** `http://tu.dominio/api/products/{code}`
#### Header:
- **Authorization:** Bearer {{token}}

#### Ejemplo de request:
```
GET /api/products/510022 HTTP/1.1
Host: 127.0.0.1:8000
Authorization: Bearer 1|qkJE5ujQKPaB9KJKqp043KvWzvHHwmTStLIFMZsw77502b92
```
#### Ejemplo de response:
```
{
    "code": 510022,
    "product_name": "producto 22",
    "description": "producto de ejemplo",
    "category_code": "cat6",
    "category_url": "http://127.0.0.1:8000/api/categories/cat6",
    "price": 10.07,
    "is_enabled": 1,
    "created_at": "2024-03-05T23:00:51.000000Z",
    "updated_at": "2024-03-05T23:00:51.000000Z",
    "url": "http://127.0.0.1:8000/api/products/510022"
}
```

<br>
<hr>

### Update (actualizar)
#### Url: **[PUT]** `http://tu.dominio/api/products/{code}`
#### Header:
- **Authorization:** Bearer {{token}}
#### Body: 
- **code:**  string | unico
- **product_name:**  string | unico
- **description:** string
- **category_code:** string | exist:api.categories
- **price:** decimal:.2
- **is_enabled:** boolean[1,0]

#### Ejemplo de request:
```
PUT /api/products/510022 HTTP/1.1
Host: 127.0.0.1:8000
Authorization: Bearer 1|qkJE5ujQKPaB9KJKqp043KvWzvHHwmTStLIFMZsw77502b92
Content-Type: application/x-www-form-urlencoded
Content-Length: 121

product_name=producto%20actualizado%206&description=descripcion%20actualizada&category_code=cat6&price=20.35&is_enabled=0
```
#### Ejemplo de response:
```
{
    "code": 510022,
    "product_name": "producto actualizado 6",
    "description": "descripcion actualizada",
    "category_code": "cat6",
    "price": "20.35",
    "is_enabled": "0",
    "created_at": "2024-03-05T23:00:51.000000Z",
    "updated_at": "2024-03-05T23:02:13.000000Z"
}
```

<br>
<hr>

### Delete (eliminar)
#### Url: **[DELETE]** `http://tu.dominio/api/products/{code}`
#### Header:
- **Authorization:** Bearer {{token}}

#### Ejemplo de request:
```
DELETE /api/products/510016 HTTP/1.1
Host: 127.0.0.1:8000
Authorization: Bearer 1|qkJE5ujQKPaB9KJKqp043KvWzvHHwmTStLIFMZsw77502b92
```
#### Ejemplo de response:
```
"Eliminado exitosamente"
```

