
# NUTRIPOINT - API REST (TPE 3)

Este repositorio contiene la API REST para el proyecto Nutripoint, desarrollada para la materia Web 2.

## Despliegue e Instalación

1.  **Clonar** este repositorio en la carpeta `htdocs` de XAMPP:
    `git clone https://github.com/SantinoFaccioli/nutripoint_api.git`
2.  **Base de Datos:** Importar el archivo `db/db_nutripoint.sql` en phpMyAdmin. La API se conecta a esta base de datos (la misma del TPE 2).
3.  **Servidor:** Iniciar Apache y MySQL desde XAMPP.
4.  **Probar:** Todos los *endpoints* deben probarse con un cliente de API como **Postman**. La URL base es `http://localhost/nutripoint_api/api/` (o el nombre de tu carpeta).

---

## Documentación de la API (Endpoints)

A continuación se documentan todos los servicios RESTful disponibles.

### Rol A (Merlina López)

#### 1. Listar Colección Completa (con Ordenamiento)
Retorna todos los productos de la base de datos. Cumple con el requisito obligatorio de listado y el opcional de ordenamiento por múltiples campos

* **URL:** `productos/todos`
* **Método:** `GET`
* **Parámetros (Opcionales):**
    * `sort` (campo): Ordena por un campo específico. Campos permitidos: `id_producto`, `nombre`, `precio`, `stock`, `id_categoria`.
    * `order` (dirección): `ASC` (ascendente) o `DESC` (descendente).
* **Ejemplo de uso (ordenado por precio, descendente):**
    `GET http://localhost/nutripoint_api/api/productos/todos?sort=precio&order=desc`
* **Respuesta (Éxito):** `200 OK`
    ```json
    [
        {
            "id_producto": 3,
            "id_categoria": 2,
            "nombre": "hamburguesa de lentejas X4un",
            "precio": "9500",
            ...
        },
        {
            "id_producto": 2,
            "id_categoria": 1,
            "nombre": "ravioles",
            "precio": "8500",
            ...
        }
    ]
    ```

#### 2. Modificar un Producto (PUT)
Actualiza los datos de un producto existente, identificado por su ID.

* **URL:** `productos/:id` (ej: `/api/productos/5`)
* **Método:** `PUT`
* **Cuerpo (Body) Requerido (JSON):**
    Se deben enviar **todos** los campos del producto para la actualización.
    ```json
    {
        "nombre": "Nuevos Copos de Maíz",
        "precio": 2000,
        "stock": 15,
        "descripcion": "Caja de 50gr, ahora sin azúcar.",
        "id_categoria": 3,
        "en_oferta": 0,
        "imagen_producto": "img_copos.jpg"
    }
    ```
* **Respuesta (Éxito):** `200 OK`
    ```json
    "Producto con id=5 actualizado con éxito."
    ```
* **Respuesta (Errores):**
    * `404 Not Found`: "El producto con id=5 no existe."
    * `400 Bad Request`: "Faltan datos obligatorios para la modificación."

---

### Rol B (Santino Faccioli)

#### 1. Listar Productos en Oferta
Retorna solo los productos marcados como "en oferta" (`en_oferta = 1`).

* **URL:** `productos`
* **Método:** `GET`
* **[Santino: Por favor, completá cualquier detalle adicional aquí]**

#### 2. Obtener un Producto por ID (en Oferta)
Retorna un único producto (solo si está en oferta).

* **URL:** `productos/:id` (ej: `/api/productos/3`)
* **Método:** `GET`
* **[ a completar]**

#### 3. Crear un Producto (POST)
Agrega un nuevo producto a la base de datos.

* **URL:** `productos`
* **Método:** `POST`
* **[ a completar]**

#### 4. Filtrar Productos por Categoría (Opcional)
Retorna productos en oferta que pertenecen a una categoría específica.

* **URL:** `productos/categoria/:id_categoria` (ej: `/api/productos/categoria/2`)
* **Método:** `GET`
* **[ a completar]**

````
