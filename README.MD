# MultiStockSync Backend API Documentation

## Introduction
This documentation provides an overview of the API endpoints available in the Laravel backend for the Multi-Stock-Sync-Back project. Each endpoint is described with its purpose, request method, and parameters.

## Base URL
The base URL for all API endpoints is:

```
http://your-domain.com/api
```

## Endpoints

## 1. User endpoints

Endpoints dedicated to authentication and account creation for working in the system.

### Authentication
- **Login**
    - **URL:** `/login`
    - **Method:** `POST`
    - **Parameters:**
        - `email` (string, required)
        - `password` (string, required)
    - **Request Example:**
    ```json
    {
        "email": "user@example.com",
        "password": "yourpassword"
    }
    ```
    - **Response Example:**
    ```json
    {
    "user": {
        "id": 2,
        "nombre": "Astronaut",
        "apellidos": "Markus",
        "telefono": "+9999999999",
        "email": "email@gmail.com",
        "nombre_negocio": "Astronaut Markus Negocio",
        "created_at": "2025-01-02T13:14:37.000000Z",
        "updated_at": "2025-01-02T13:14:37.000000Z"
    },
    "token": "TOKEN_CODE"
    }
    ```
    - **Response Example (Incorrect password):**
    ```json
    {
        "message": "Credenciales inválidas"
    }
    ```
    - **Response Example (Incorrect email or user not exists):**
    ```json
    {
        "message": "Usuario no encontrado"
    }
    ```


- **Register**
    - **URL:** `/register`
    - **Method:** `POST`
    - **Parameters:**
        - `nombre` (string, required)
        - `apellidos` (string, required)
        - `telefono` (string, required)
        - `email` (string, required)
        - `nombre_negocio` (string, required)
        - `password` (string, required)
        - `password_confirmation` (string, required)
    - **Request Example:**
    ```json
    {
        "nombre":"Astronaut",
        "apellidos":"Markus",
        "telefono":"+99999999999",
        "email":"email@gmail.com",
        "nombre_negocio":"Astronaut Markus Negocio",
        "password":"password_here",
        "password_confirmation":"password_here"
    }
    ```
    - **Response Example:**
    ```json
    {
        "user": {
            "nombre": "Astronaut",
            "apellidos": "Markus",
            "telefono": "+99999999999",
            "email": "email@gmail.com",
            "nombre_negocio": "Astronaut Markus Negocio",
            "updated_at": "2025-01-02T13:26:52.000000Z",
            "created_at": "2025-01-02T13:26:52.000000Z",
            "id": 3
        },
        "message": "Usuario creado correctamente"
    }
    ```

- **Logout**
    - **URL:** `/logout`
    - **Method:** `POST`
    - **Headers:**
        - `Authorization: Bearer {token}`


## 2. Clientes endpoints

Endpoints dedicated to the creation of new "clients" for the user's business, interested in purchasing at their point of sale.

- **Clientes list**
    - **URL:** `/clientes`
    - **Method:** `GET`
    - **Response Example:**
    ```json
    "data": [
        {
            "id": 1,
            "tipo_cliente_id": 1,
            "extranjero": 0,
            "rut": "12345678-9",
            "razon_social": "Empresa Ejemplo",
            "giro": "Comercio",
            "nombres": "Juan",
            "apellidos": "Pérez",
            "direccion": "Calle Falsa 123",
            "comuna": "Santiago",
            "region": "Metropolitana",
            "ciudad": "Santiago",
            "created_at": "2025-01-07T14:50:30.000000Z",
            "updated_at": "2025-01-07T14:50:30.000000Z",
            "tipo_cliente": {
                "id": 1,
                "tipo": "Empresa",
                "created_at": "2025-01-07T14:49:41.000000Z",
                "updated_at": "2025-01-07T14:49:41.000000Z"
            }
        },
        {
            "id": 2,
            "tipo_cliente_id": 2,
            "extranjero": 0,
            "rut": "12345678-9",
            "razon_social": "Persona",
            "giro": "Comercio",
            "nombres": "Juan 2",
            "apellidos": "2",
            "direccion": "Calle Falsa 444",
            "comuna": "Santiago",
            "region": "Metropolitana",
            "ciudad": "Santiago",
            "created_at": "2025-01-07T14:50:52.000000Z",
            "updated_at": "2025-01-07T14:50:52.000000Z",
            "tipo_cliente": {
                "id": 2,
                "tipo": "Persona",
                "created_at": "2025-01-07T14:49:41.000000Z",
                "updated_at": "2025-01-07T14:49:41.000000Z"
            }
        }
    ]
    ```
- **Create cliente**
    - **URL:** `/clientes`
    - **Method:** `POST`
    - **Parameters:**
        - `tipo_cliente_id` (int, required) use 1:empresa or 2:persona only.
        - `extranjero` (boolean, required)
        - `rut` (string, required)
        - `razon_social` (string, required)
        - `giro` (string, required)
        - `nombres` (string, required)
        - `apellidos` (string, required)
        - `direccion` (string, required)
        - `comuna` (string, required)
        - `region` (string, required)
        - `ciudad` (string, required)
    - **Request Example:**
    ```json
    {
        "tipo_cliente_id": 2,
        "extranjero": false,
        "rut": "12345678-9",
        "razon_social": "Persona",
        "giro": "Comercio",
        "nombres": "Juan 2",
        "apellidos": "2",
        "direccion": "Calle Falsa 444",
        "comuna": "Santiago",
        "region": "Metropolitana",
        "ciudad": "Santiago"
    }
    ```
    - **Response Example:**
    ```json
    {
        "message": "Cliente creado con éxito",
        "data": {
            "tipo_cliente_id": 2,
            "extranjero": false,
            "rut": "12345678-9",
            "razon_social": "Persona",
            "giro": "Comercio",
            "nombres": "Juan 2",
            "apellidos": "2",
            "direccion": "Calle Falsa 444",
            "comuna": "Santiago",
            "region": "Metropolitana",
            "ciudad": "Santiago",
            "updated_at": "2025-01-07T15:39:14.000000Z",
            "created_at": "2025-01-07T15:39:14.000000Z",
            "id": 3
        }
    }
    ```
- **Update cliente**
    - **URL:** `/clientes/{id}`
    - **Method:** `PATCH`
    - **Parameters:**
        - `tipo_cliente_id` (int, optional)
        - `extranjero` (boolean, optional)
        - `rut` (string, optional)
        - `razon_social` (string, optional)
        - `giro` (string, optional)
        - `nombres` (string, optional)
        - `apellidos` (string, optional)
        - `direccion` (string, optional)
        - `comuna` (string, optional)
        - `region` (string, optional)
        - `ciudad` (string, optional)
    - **Request Example:**
    ```json
    {
        "tipo_cliente_id": 2,
        "extranjero": false,
        "rut": "12345678-9",
        "razon_social": "Persona",
        "giro": "Comercio",
        "nombres": "Marcos",
        "apellidos": "Reyes",
        "direccion": "Calle Falsa 444",
        "comuna": "Santiago",
        "region": "Metropolitana",
        "ciudad": "Santiago"
    }
    ```
    - **Response Example:**
    ```json
    {
        "message": "Cliente actualizado con éxito",
        "data": {
            "id": 2,
            "tipo_cliente_id": 2,
            "extranjero": false,
            "rut": "12345678-9",
            "razon_social": "Persona",
            "giro": "Comercio",
            "nombres": "Marcos",
            "apellidos": "Reyes",
            "direccion": "Calle Falsa 444",
            "comuna": "Santiago",
            "region": "Metropolitana",
            "ciudad": "Santiago",
            "created_at": "2025-01-09T15:30:21.000000Z",
            "updated_at": "2025-01-09T15:48:21.000000Z"
        }
    }
    ```

- **Delete cliente**
    - **URL:** `/clientes/{id}`
    - **Method:** `DELETE`
    - **Response Example:**
    ```json
    {
        "message": "Cliente eliminado con éxito"
    }
    ```

## 3. Productos endpoints


- **Productos list**
    - **URL:** `/productos`
    - **Method:** `GET`
    - **Response Example:**
    ```json
    [
        {
        "id": 1,
        "nombre": "Peluche FumoFumos edicion limitada",
        "sku": "PEL-7894",
        "tipo": 1,
        "marca": {
            "id": 1,
            "nombre": "Sin Marca",
            "imagen": "",
            "created_at": "2025-01-08T13:39:15.000000Z",
            "updated_at": "2025-01-08T13:39:15.000000Z"
        },
        "control_stock": 1,
        "precio": "9990.00",
        "permitir_venta_no_stock": 0,
        "nombre_variante": null,
        "control_series": 1,
        "permitir_venta_decimales": 0,
        "created_at": "2025-01-08T16:40:38.000000Z",
        "updated_at": "2025-01-08T16:40:38.000000Z",
        "tipo_producto": {
            "id": 1,
            "producto": "No especificado",
            "created_at": "2025-01-08T13:39:16.000000Z",
            "updated_at": "2025-01-08T13:39:16.000000Z"
        },
        "stock": null
    },
    ]
    ```

- **Create producto**
    - **URL:** `/productos`
    - **Method:** `POST`
    - **Parameters:**
        - `nombre` (string, required)
        - `extranjero` (boolean, required)
        - `tipo` (int, required)
        - `marca` (int, required)
        - `sku` (string, optional) // If you don't send it, the system generates one.
        - `control_stock` (boolean, required)
        - `precio` (int, required)
        - `permitir_venta_no_stock` (boolean, required)
        - `control_series` (boolean, required)
        - `permitir_venta_decimales` (boolean, required)
    - **Request Example:**
    ```json
    {
        "nombre": "Ventilador Amarillo",
        "tipo": 1, // "no especificado"
        "marca": 1, // "sin marca"
        "sku":"MLC_2813812", // "optional field"
        "control_stock": true,
        "precio":25990,
        "permitir_venta_no_stock": false,
        "control_series": false,
        "permitir_venta_decimales": false
    }

    ```
    - **Response Example:**
    ```json
    {
        "message": "Producto creado correctamente",
        "producto": {
            "nombre": "Ventilador Amarillo",
            "sku": "MLC_2813812",
            "tipo": 1,
            "marca": 1,
            "control_stock": true,
            "precio": 25990,
            "permitir_venta_no_stock": false,
            "control_series": false,
            "permitir_venta_decimales": false,
            "updated_at": "2025-01-09T16:55:03.000000Z",
            "created_at": "2025-01-09T16:55:03.000000Z",
            "id": 22
        }
    }
    ```

- **Update producto**
    - **URL:** `/productos/{id}`
    - **Method:** `PATCH`
    - **Parameters:**
        - `nombre` (string, optional)
        - `extranjero` (boolean, optional)
        - `tipo` (int, optional)
        - `marca` (int, optional)
        - `sku` (string, optional) // If you don't send it, the system generates one.
        - `control_stock` (boolean, optional)
        - `precio` (int, optional)
        - `permitir_venta_no_stock` (boolean, optional)
        - `control_series` (boolean, optional)
        - `permitir_venta_decimales` (boolean, optional)
    - **Request Example:**
    ```json
    {
        "nombre": "Ventilador Amarillo",
        "tipo": 1, // "no especificado"
        "marca": 1, // "sin marca"
        "control_stock": true,
        "precio":25990,
        "permitir_venta_no_stock": false,
        "control_series": false,
        "permitir_venta_decimales": false
    }

    ```
    - **Response Example:**
    ```json
    {
        "message": "Producto actualizado correctamente",
        "producto": {
            "id": 22,
            "nombre": "Ventilador Amarillo",
            "sku": "VEN-9931",
            "tipo": 1,
            "marca": 1,
            "control_stock": true,
            "precio": "25990.00",
            "permitir_venta_no_stock": false,
            "nombre_variante": null,
            "control_series": false,
            "permitir_venta_decimales": false,
            "created_at": "2025-01-09T16:55:03.000000Z",
            "updated_at": "2025-01-09T18:03:37.000000Z"
        }
    }
    ```
- **Delete producto**
    - **URL:** `/productos/{id}`
    - **Method:** `DELETE`
    - **Response Example:**
    ```json
    {
    "message": "Producto eliminado correctamente"
    }
    ```

## 4. Marcas endpoints

- **Marcas list**
    - **URL:** `/marcas`
    - **Method:** `GET`
    - **Response Example:**
    ```json
    [
        {
        "id": 1,
        "nombre": "Sin Marca",
        "imagen": "",
        "created_at": "2025-01-08T13:39:15.000000Z",
        "updated_at": "2025-01-08T13:39:15.000000Z"
        },
        {
            "id": 2,
            "nombre": "Marca Fumo",
            "imagen": "https://example.com/logo-fumo.png",
            "created_at": "2025-01-08T16:42:00.000000Z",
            "updated_at": "2025-01-08T16:42:00.000000Z"
        },
    ]
    ```

- **Create marca**
    - **URL:** `/marcas`
    - **Method:** `POST`
    - **Parameters:**
        - `nombre` (string, required)
        - `imagen` (string, optional)
    - **Request Example:**
    ```json
    {
        "nombre": "Marca Fumo",
        "imagen": "https://example.com/logo-fumo.png",
    }
    ```
    - **Response Example:**
    ```json
    {
        "message": "Marca creada correctamente",
        "marca": {
            "nombre": "Marca Fumo",
            "imagen": "https://example.com/logo-fumo.png",
            "updated_at": "2025-01-09T18:11:35.000000Z",
            "created_at": "2025-01-09T18:11:35.000000Z",
            "id": 20
        }
    }
    ```

- **Update marca**
    - **URL:** `/marcas/{id}`
    - **Method:** `PATCH`
    - **Parameters:**
        - `nombre` (string, optional)
        - `imagen` (string, optional)
    - **Request Example:**
    ```json
    {
        "nombre": "Marca Fumo 2",
        "imagen": "https://example.com/logo-fumo.png",
    }
    ```
    - **Response Example:**
    ```json
    {
        "message": "Marca actualizada parcialmente correctamente",
        "marca": {
            "id": 2,
            "nombre": "Marca Fumo 2",
            "imagen": "https://example.com/logo-fumo.png",
            "created_at": "2025-01-08T16:42:00.000000Z",
            "updated_at": "2025-01-09T18:16:39.000000Z"
        }
    }
    ```

- **Delete marca**
    - **URL:** `/marcas/{id}`
    - **Method:** `DELETE`
    - **Response Example:**
    ```json
    {
        "message": "Marca eliminada correctamente"
    }
    ```

## Conclusion
This documentation provides a starting point for understanding and using the API endpoints available in the Laravel backend. For more detailed information, please refer to the specific endpoint documentation or contact the development team.