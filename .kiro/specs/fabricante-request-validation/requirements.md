# Requirements Document

## Introduction

Esta funcionalidad implementará Form Request classes para el modelo Fabricante en Laravel, separando la lógica de validación del controlador y proporcionando una estructura más limpia y mantenible para la validación de datos de entrada.

## Requirements

### Requirement 1

**User Story:** Como desarrollador, quiero tener Form Request classes para Fabricante, para que la validación esté separada del controlador y sea más fácil de mantener y reutilizar.

#### Acceptance Criteria

1. WHEN se crea un nuevo fabricante THEN el sistema SHALL validar los datos usando una StoreFabricanteRequest
2. WHEN se actualiza un fabricante existente THEN el sistema SHALL validar los datos usando una UpdateFabricanteRequest
3. WHEN los datos de entrada son inválidos THEN el sistema SHALL retornar errores de validación apropiados
4. WHEN la validación es exitosa THEN el sistema SHALL permitir que la operación continúe

### Requirement 2

**User Story:** Como desarrollador, quiero que las reglas de validación estén centralizadas en las Request classes, para que sean consistentes y fáciles de modificar.

#### Acceptance Criteria

1. WHEN se valida el nombre THEN el sistema SHALL verificar que sea requerido, string, máximo 255 caracteres y único en la tabla fabricantes
2. WHEN se valida el sector THEN el sistema SHALL verificar que sea requerido, string y uno de los valores permitidos (Automotriz, Electrónica, Alimentación, Textil, Otros)
3. WHEN se actualiza un fabricante THEN el sistema SHALL excluir el registro actual de la validación de unicidad del nombre
4. WHEN hay errores de validación THEN el sistema SHALL retornar mensajes de error personalizados en español

### Requirement 3

**User Story:** Como desarrollador, quiero que el controlador use las Form Request classes, para que el código sea más limpio y la validación esté automatizada.

#### Acceptance Criteria

1. WHEN el método store es llamado THEN el sistema SHALL usar StoreFabricanteRequest para validación automática
2. WHEN el método update es llamado THEN el sistema SHALL usar UpdateFabricanteRequest para validación automática
3. WHEN la validación falla THEN el sistema SHALL automáticamente redirigir con errores sin código adicional en el controlador
4. WHEN la validación es exitosa THEN el controlador SHALL recibir solo datos validados