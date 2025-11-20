pdftogether
================

Resumo
-----------

pdftogether é uma aplicação Laravel que facilita a união de PDFs por meio de uma interface web simples e de um serviço PDF central (PdfService.php).

Recursos
----------

Upload: interface web para enviar arquivos PDF.
União: combinar múltiplos PDFs em um único arquivo.

Serviço: arquitetura com um serviço dedicado (PdfService) para encapsular a lógica de PDF.

Testes
---------

Base de testes com PHPUnit pronta para expansão.

Instalação Rápida
--------------------

Pré-requisitos: PHP 8.x, Composer, Node.js/npm (opcional para assets), e um banco de dados compatível.

Passos:

1. `composer install`
2. Copie o `.env.example` para `.env` e ajuste as variáveis de ambiente.
3. `php artisan key:generate`
4. `php artisan migrate`
5. `php artisan storage:link`
6. (Frontend) `npm install` e `npm run build`
7. Inicie o servidor: `php artisan serve` ou `docker-compose up -d` se usar Docker.

Uso
-----

Interface: abra `http://localhost:8000` (ou a porta exibida) e use a página de upload para enviar e unir PDFs.

Programático: utilize `PdfService.php` para integrar operações de união em outros serviços ou comandos Artisan.

Contribuição
-------------

Como contribuir: abra issues para bugs/feature requests e envie pull requests seguindo PSR-12.

Testes: rode os testes com PHPUnit.

Licença
--------

Licença: MIT — atualize conforme necessário ou adicione o arquivo LICENSE.
