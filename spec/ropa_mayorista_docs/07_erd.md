# 7. Modelo Entidad-Relación (ERD)
## Sistema de Venta de Ropa al por Mayor

A continuación se presenta el modelo relacional de la base de datos `db_ropa_mayorista`.

```mermaid
erDiagram
    roles {
        int id_rol PK
        varchar nombre
        text descripcion
    }
    
    usuarios {
        int id_usuario PK
        int id_rol FK
        varchar nombre
        varchar apellido
        varchar correo
        varchar telefono
        varchar password_hash
        boolean estado
        datetime fecha_registro
    }
    
    categorias {
        int id_categoria PK
        varchar nombre
        text descripcion
        boolean estado
    }
    
    productos {
        int id_producto PK
        int id_categoria FK
        varchar nombre
        varchar sku
        text descripcion
        decimal precio_mayorista
        int stock
        boolean estado
        varchar img_principal
        varchar telefono_vendedor
        datetime fecha_creacion
    }
    
    producto_imagenes {
        int id_imagen PK
        int id_producto FK
        varchar ruta_imagen
        int orden
    }
    
    configuraciones {
        int id_config PK
        varchar clave
        varchar valor
        varchar descripcion
    }
    
    sesiones {
        varchar id_sesion PK
        int id_usuario FK
        varchar ip_address
        varchar user_agent
        datetime ultima_actividad
    }
    
    auditoria_logs {
        int id_log PK
        int id_usuario FK
        varchar accion
        varchar tabla_afectada
        int id_registro_afectado
        datetime fecha
        varchar ip_address
    }

    roles ||--o{ usuarios : "asigna"
    categorias ||--o{ productos : "clasifica"
    productos ||--o{ producto_imagenes : "posee"
    usuarios ||--o{ sesiones : "mantiene"
    usuarios ||--o{ auditoria_logs : "genera"
```

### Notas del Modelo
- Las relaciones son de integridad referencial dura (InnoDB) para evitar registros huérfanos.
- El campo `telefono_vendedor` en la tabla `productos` permite que diferentes productos puedan derivar a diferentes números de WhatsApp si fuese necesario. Si todos derivan al mismo, puede usarse la tabla `configuraciones`.
