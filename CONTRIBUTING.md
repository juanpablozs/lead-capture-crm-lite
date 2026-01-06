# Contribuciones

Este proyecto es personal. El contenido de este fichero sirve como guía rápida para mantener el proyecto en condiciones y realizar pruebas en local.

Recomendaciones básicas:

- Sigue PSR-12 y las WordPress Coding Standards (WPCS) para el código PHP.
- Ejecuta las pruebas y el análisis estático antes de cambios importantes:
  - `composer install`
  - `npm ci && npm run build`
  - `vendor\\bin\\phpunit -c tests\\phpunit.xml`
  - `vendor\\bin\\phpstan analyse -c phpstan.neon`
  - `vendor\\bin\\phpcs -p`
- Si realizas reestructuraciones del repositorio, haz una copia de seguridad antes.

Notas:

- No está configurado para recibir contribuciones externas; si en el futuro decides abrirlo, actualiza este documento.

Gracias.
