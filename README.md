# Lead Capture CRM Lite

Proyecto personal: implementación ligera de captura de leads para WordPress. No es un proyecto colaborativo; las instrucciones aquí son para uso personal y para facilitar el despliegue y las pruebas en el entorno local.

Resumen
- CPT "lcc_lead" (Leads) privado.
- Formulario en frontend disponible por shortcode y bloque de Gutenberg.
- Página de ajustes (Settings > Lead Capture CRM Lite): notificaciones, webhook, rate limit.
- Exportar leads a CSV desde la administración.
- REST API: GET /wp-json/lcc/v1/leads (requiere manage_options).
- Desarrollo con Composer, PHPUnit, PHPCS, PHPStan y @wordpress/scripts para el bloque.

Requisitos
- PHP 8.0+
- WordPress 6.4+
- Composer
- Node.js (recomendado 18+)
- Docker & Docker Compose (opcional, recomendado para entorno local)

Instalación rápida (PowerShell)
1. Coloca el plugin en la ruta del proyecto:
   c:\Users\carde\Desktop\crm\lead-capture-crm-lite

2. Instalar dependencias PHP:
   ```powershell
   cd 'c:\Users\carde\Desktop\crm\lead-capture-crm-lite'
   composer install
   ```

3. Instalar dependencias JS y compilar bloque:
   ```powershell
   npm ci
   npm run build
   ```

4. Levantar entorno WordPress (opcional, usa docker-compose.yml incluido):
   ```powershell
   docker compose up -d
   # Sitio WP en http://localhost:8000
   ```

5. Activar el plugin:
   - Desde el administrador de WordPress: Plugins > Lead Capture CRM Lite > Activar
   - O con WP-CLI dentro del contenedor:
     ```powershell
     docker compose exec wordpress wp plugin activate lead-capture-crm-lite --allow-root
     ```

Uso
- Shortcode: añadir `[lcc_lead_form]` en cualquier página/post.
- Bloque: "Lead Capture Form" en el editor de bloques (Inspector: mostrar/ocultar campo company, estado por defecto, URL de redirección).
- Ajustes: Settings > Lead Capture CRM Lite — configurar email, webhook y rate limit.
- Exportar: Settings > Export Leads (botón "Export as CSV").

REST API
- Endpoint: GET /wp-json/lcc/v1/leads
- Requiere usuario con capability `manage_options`.
- Soporta parámetros: status, after, before, per_page, page.

Pruebas y análisis estático
- PHPUnit (requiere WordPress test suite configurado y variable WP_TESTS_DIR apuntando a wordpress-tests-lib):
  ```powershell
  vendor\bin\phpunit -c tests\phpunit.xml
  ```
- PHPCS (WPCS):
  ```powershell
  vendor\bin\phpcs -p
  ```
- PHPStan:
  ```powershell
  vendor\bin\phpstan analyse -c phpstan.neon
  ```
- Build JS:
  ```powershell
  npm run build
  ```

Notas de seguridad y operación
- Todas las entradas se sanitizan y escapan donde corresponde.
- Formularios usan nonce y honeypot; hay limitación por IP mediante transients.
- Webhook se realiza con wp_remote_post y no bloquea la experiencia del usuario; fallos se registran cuando WP_DEBUG está activo.

Archivos importantes
- Plugin bootstrap: `lead-capture-crm-lite.php`
- Código fuente PHP: `src/`
- Bloque (fuente): `assets/block/src`
- Bloque compilado: `assets/block/build`
- Tests: `tests/`
- `docker-compose.yml` (entorno de desarrollo)

Licencia
- MIT — uso personal y privado.

Capturas
- Añadir capturas en `assets/screenshots/` si se desea guardar imágenes de la interfaz.

Fin.

