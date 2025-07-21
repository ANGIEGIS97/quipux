
# Desafío WordPress Quipux

Este proyecto es una solución al desafío frontend de Quipux. Crea un entorno WordPress dockerizado con un tema personalizado y un plugin personalizado que expone una API REST.

## Instalación

1.  Clona el repositorio.
2.  Asegúrate de tener Docker y Docker Compose instalados.
3.  Ejecuta el siguiente comando en la raíz del proyecto:

    ```
    docker-compose up --build
    ```

4.  El sitio WordPress estará disponible en `http://localhost:8080`.
5.  El panel de administración de WordPress estará disponible en `http://localhost:8080/wp-admin/`. Aquí podrás gestionar todo el contenido del sitio, incluyendo las noticias, configuración del tema y plugins.

## Tema

El tema personalizado se llama `base-quipux` y es un tema hijo de `WP Bootstrap Starter`.

### Hojas de Estilo

El tema incluye las siguientes hojas de estilo:
- `style.css`: Estilos principales del tema
- `css/news.css`: Estilos específicos para la sección de noticias

### Plantillas de Página

El tema incluye las siguientes plantillas personalizadas:

#### Plantilla de Noticias (`template-noticias.php`)
- Muestra una lista paginada de noticias en un diseño de cuadrícula
- Incluye una sección hero con título y subtítulo
- Muestra 3 noticias por página con paginación
- Diseño responsivo con animaciones y efectos hover
- Soporte para imágenes destacadas y categorías

#### Plantilla de Iconos (`template-iconos.php`)
- Muestra una guía de uso de los iconos de Quipux
- Incluye ejemplos de iconos QICONS y Material Design
- Demuestra el uso de iconos en botones y tarjetas
- Incluye documentación de implementación

## Plugin

El plugin personalizado se llama `quipux-api` y expone una API REST para noticias.

### Endpoints

*   `GET /wp-json/quipux-api/v1/noticias`: Retorna una lista paginada de elementos de noticias.
*   `GET /wp-json/quipux-api/v1/noticias/{id}`: Retorna un elemento de noticia individual.
