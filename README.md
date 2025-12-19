# Tarea - Desarrollo en Plataformas

**Estudiante:** Carlo Indemini

**Fecha:** 19.12.2025

**Paralelo:** Paralelo 2

---

## Mis Decisiones de Diseño

### 1. Tabla

**Nombre de la tabla:** `citas`

**Campos:**

| Campo | Tipo | ¿Obligatorio? |
|-------|------|---------------|
| id_cita | INT AUTO_INCREMENT | Sí (PK) |
| nombre_clienta | VARCHAR(100) | Sí |
| telefono | VARCHAR(20) | Sí |
| servicio | VARCHAR(100) | Sí |
| fecha_cita | DATE | Sí |
| hora_cita | TIME | Sí |
| estado | ENUM('pendiente', 'completada', 'cancelada') | Sí (default: 'pendiente') |
| created_at | TIMESTAMP | Sí (automático) |
| updated_at | TIMESTAMP | Sí (automático) |


### 2. Tipos de servicio

Los servicios disponibles en la peluquería son:

- Corte
- Tinte
- Peinado
- Manicure
- Tratamiento


### 3. ¿Se puede eliminar registros?

**Respuesta:** **NO**

**Razón:**  
Se debe mantener el historial completo de citas para control de negocio y seguimiento de clientas, según lo solicitado por la socia de Sandra.

### 4. Link del repositorio
https://github.com/Cindemini/peluqueria-laravel


