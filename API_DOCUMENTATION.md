# API Documentation

## Base URL
```
http://localhost:8000/api/v1
```

## Endpoints

### Fabricantes

#### GET /fabricantes
Obtener lista de fabricantes con paginación.

**Respuesta:**
```json
{
  "data": [
    {
      "id": 1,
      "nombre": "Samsung",
      "sector": "Electrónicos",
      "productos_count": 5,
      "created_at": "2025-01-08 10:00:00",
      "updated_at": "2025-01-08 10:00:00"
    }
  ],
  "links": {...},
  "meta": {...}
}
```

#### GET /fabricantes/{id}
Obtener un fabricante específico con sus productos.

**Respuesta:**
```json
{
  "data": {
    "id": 1,
    "nombre": "Samsung",
    "sector": "Electrónicos",
    "productos_count": 5,
    "productos": [
      {
        "id": 1,
        "nombre": "Galaxy S24",
        "descripcion": "Smartphone premium",
        "precio": 999.99,
        "stock": 50,
        "fabricante_id": 1
      }
    ],
    "created_at": "2025-01-08 10:00:00",
    "updated_at": "2025-01-08 10:00:00"
  }
}
```

#### POST /fabricantes
Crear un nuevo fabricante.

**Body:**
```json
{
  "nombre": "Apple",
  "sector": "Tecnología"
}
```

**Respuesta:**
```json
{
  "data": {
    "id": 2,
    "nombre": "Apple",
    "sector": "Tecnología",
    "productos_count": 0,
    "created_at": "2025-01-08 10:00:00",
    "updated_at": "2025-01-08 10:00:00"
  }
}
```

#### PUT /fabricantes/{id}
Actualizar un fabricante existente.

**Body:**
```json
{
  "nombre": "Apple Inc.",
  "sector": "Tecnología"
}
```

#### DELETE /fabricantes/{id}
Eliminar un fabricante (solo si no tiene productos asociados).

**Respuesta:**
```json
{
  "message": "Fabricante eliminado correctamente"
}
```

### Productos

#### GET /productos
Obtener lista de productos con paginación.

**Parámetros de consulta:**
- `fabricante_id`: Filtrar por fabricante
- `search`: Buscar por nombre

**Ejemplo:** `/productos?fabricante_id=1&search=galaxy`

**Respuesta:**
```json
{
  "data": [
    {
      "id": 1,
      "nombre": "Galaxy S24",
      "descripcion": "Smartphone premium",
      "precio": 999.99,
      "stock": 50,
      "fabricante_id": 1,
      "fabricante": {
        "id": 1,
        "nombre": "Samsung",
        "sector": "Electrónicos"
      },
      "created_at": "2025-01-08 10:00:00",
      "updated_at": "2025-01-08 10:00:00"
    }
  ],
  "links": {...},
  "meta": {...}
}
```

#### GET /productos/{id}
Obtener un producto específico.

#### POST /productos
Crear un nuevo producto.

**Body:**
```json
{
  "nombre": "iPhone 15",
  "descripcion": "Smartphone de Apple",
  "precio": 1199.99,
  "stock": 30,
  "fabricante_id": 2
}
```

#### PUT /productos/{id}
Actualizar un producto existente.

#### DELETE /productos/{id}
Eliminar un producto.

### Rutas adicionales

#### GET /fabricantes/{id}/productos
Obtener todos los productos de un fabricante específico.

## Códigos de estado HTTP

- `200 OK`: Solicitud exitosa
- `201 Created`: Recurso creado exitosamente
- `204 No Content`: Recurso eliminado exitosamente
- `400 Bad Request`: Datos de entrada inválidos
- `404 Not Found`: Recurso no encontrado
- `409 Conflict`: Conflicto (ej: fabricante con productos no se puede eliminar)
- `422 Unprocessable Entity`: Error de validación

## Errores de validación

```json
{
  "message": "Error de validación",
  "errors": {
    "nombre": ["El campo nombre es obligatorio."],
    "precio": ["El precio debe ser un número positivo."]
  }
}
```

## Paginación

Todas las listas incluyen metadatos de paginación:

```json
{
  "data": [...],
  "links": {
    "first": "http://localhost:8000/api/v1/productos?page=1",
    "last": "http://localhost:8000/api/v1/productos?page=3",
    "prev": null,
    "next": "http://localhost:8000/api/v1/productos?page=2"
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 3,
    "per_page": 15,
    "to": 15,
    "total": 45
  }
}
```

## Ejemplos con cURL

### Obtener fabricantes
```bash
curl -X GET "http://localhost:8000/api/v1/fabricantes" \
  -H "Accept: application/json"
```

### Crear fabricante
```bash
curl -X POST "http://localhost:8000/api/v1/fabricantes" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "nombre": "Sony",
    "sector": "Electrónicos"
  }'
```

### Crear producto
```bash
curl -X POST "http://localhost:8000/api/v1/productos" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "nombre": "PlayStation 5",
    "descripcion": "Consola de videojuegos",
    "precio": 499.99,
    "stock": 25,
    "fabricante_id": 1
  }'
```

### Buscar productos
```bash
curl -X GET "http://localhost:8000/api/v1/productos?search=galaxy&fabricante_id=1" \
  -H "Accept: application/json"
```