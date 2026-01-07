# Lead Capture CRM Lite

Plugin ligero para WordPress que permite capturar y gestionar leads. Incluye un tipo de contenido personalizado (`lcc_lead`), un formulario (shortcode y bloque de Gutenberg), exportación CSV, webhook y un endpoint REST.

Resumen de características
- Tipo de contenido `lcc_lead` (no público, administración interna).
- Formulario frontend disponible como shortcode y bloque de Gutenberg.
- Página de ajustes (notificaciones, webhook, límite de peticiones por IP).
- Exportación de leads a CSV desde el área de administración.
- Endpoint REST: `GET /wp-json/lcc/v1/leads` (acceso restringido a administradores).

Requisitos mínimos
- PHP 8.0+
- WordPress 6.4+
- Composer (para dependencias PHP)
- Node.js (recomendado 18+) y `npm` (para compilar el bloque)
- Docker y Docker Compose (opcional, recomendado para entorno local reproducible)

Instalación (genérica)
1. Clona o descarga este repositorio en tu máquina:
   ```bash
   git clone <repo-url>
   cd lead-capture-crm-lite
   ```
2. Instala las dependencias PHP con Composer:
   ```bash
   composer install
   ```
3. Instala las dependencias JavaScript y genera los archivos del bloque:
   ```bash
   npm ci
   npm run build
   ```
4. Despliega el plugin en una instalación de WordPress:
   - Copia la carpeta del plugin a `wp-content/plugins/` y actívalo desde el panel de administración; o
   - Usa el `docker-compose.yml` incluido para levantar un entorno WordPress y activar el plugin allí.

Activación y comprobación
- Activa el plugin desde el panel de administración de WordPress (Plugins).
- Comprueba que el CPT `lcc_lead` está registrado en `wp-admin` en la URL `/wp-admin/edit.php?post_type=lcc_lead`.

Uso básico
- Shortcode: añade `[lcc_lead_form]` en cualquier página o entrada para mostrar el formulario.
- Bloque: inserta "Lead Capture Form" desde el editor de bloques; en el inspector puedes ajustar si mostrar el campo `company`, el estado por defecto y una URL de redirección.
- Ajustes: ve a Settings > Lead Capture CRM Lite para configurar notificaciones por correo, webhook y límite de peticiones.
- Exportación: desde la sección de exportación del plugin puedes descargar un CSV con todos los leads.

REST API
- Endpoint: `GET /wp-json/lcc/v1/leads`.
- Requiere un usuario con la capacidad `manage_options` (administrador).
- Parámetros soportados: `status`, `after`, `before`, `per_page`, `page`.

Pruebas y análisis estático (desarrollo)
- PHPUnit (requiere el WordPress test suite y la variable de entorno `WP_TESTS_DIR` apuntando a `wordpress-tests-lib`):
  ```bash
  vendor/bin/phpunit -c tests/phpunit.xml
  ```
- PHPCS (WPCS):
  ```bash
  vendor/bin/phpcs -p
  ```
- PHPStan:
  ```bash
  vendor/bin/phpstan analyse -c phpstan.neon
  ```
- Compilar JS:
  ```bash
  npm run build
  ```

Notas de seguridad
- Todas las entradas y salidas se sanitizan y escapan según las buenas prácticas de WordPress.
- Formularios usan nonce y honeypot; existe limitación por IP mediante transients para mitigar spam.
- Las llamadas a webhook son asíncronas/no bloqueantes; los errores se registran cuando `WP_DEBUG` está activo.

Estructura importante
- Archivo de arranque del plugin: `lead-capture-crm-lite.php`
- Código fuente PHP: `src/`
- Código del bloque (fuente): `assets/block/src`
- Código del bloque (compilado): `assets/block/build`
- Pruebas: `tests/`
- `docker-compose.yml` (para levantar un entorno local reproducible)

Licencia
- MIT

Contribuciones y notas
- Este repositorio contiene documentación y herramientas para desarrollo. Si usas este código, sigue las instrucciones de `CONTRIBUTING.md` para pruebas y verificación.

Capturas
- Si deseas añadir capturas de pantalla, colócalas en `assets/screenshots/`.

Fin.

