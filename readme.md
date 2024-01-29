### Демонстрационное развёртывание ресурсов библиотек в проект


[![HLEB2](https://img.shields.io/badge/HLEB-2-darkcyan)](https://github.com/phphleb/hleb) ![PHP](https://img.shields.io/badge/PHP-^8.2-blue) [![License: MIT](https://img.shields.io/badge/License-MIT%20(Free)-brightgreen.svg)](https://github.com/phphleb/hleb/blob/master/LICENSE)


Предназначено к использованию с фреймворком [HLEB2](https://github.com/phphleb/hleb).
Показывает минимальные возможности библиотеки [phphleb/updater](https://github.com/phphleb/updater).

### Установка

При помощи Composer:
 ```bash
composer require phphleb/demo-updater
 ```

### Демонстрационное развертывание

 ```bash
php console phphleb/demo-updater add
 ```

При развертывании библиотеки следующие файлы будут перемещены в проект (дизайн _base_ по умолчанию):

/vendor/phphleb/demo-updater/match-directory/rewrite/app/Commands/~DemoUpdaterOption/base/DemoTask.php-upd
в /app/Commands/DemoUpdaterOption/DemoTask.php

/vendor/phphleb/demo-updater/match-directory/rewrite/public/css/~demo-updater-design/base/base-design/demo.css-upd
в /public/css/demo-updater-design/base-design/demo.css

/vendor/phphleb/demo-updater/match-directory/rewrite/resources/views/~demo-updater-design/base/index.php-upd
в /resources/views/demo-updater-design/index.php

/vendor/phphleb/demo-updater/match-directory/rewrite/routes/~demo-updater-option/base/main.php-upd
в /routes/demo-updater-option/main.php

/vendor/phphleb/demo-updater/match-directory/config/config.json
в /storage/lib/phphleb/demo-updater/config.json

/vendor/phphleb/demo-updater/match-directory/rewrite/modules/~demo-updater-option/base/controllers/DemoModuleController.php-upd
в /modules/demo-updater-option/controllers/DemoModuleController.php

Теперь вся функциональность библиотеки добавлена в проект.
Если запросить список команд:

 ```bash
php console --list
 ```
То в списке появится новая команда **demo-updater-option/demo-task**, при запуске она отображает текущий дизайн из конфигурации.

Если перейти по адресу сайта site.ru/demo-page/, то будет выведено название текущего дизайна.
Чтобы его поменять, достаточно выполнить команду на добавление ещё раз, выбрав другой дизайн. Обновите страницу и название изменится.
Видно, что в зависимости от выбора при установке, можно конфигурировать вносимые таким образом данные в проект.

Также будет развёрнут демонстрационный модуль под названием _demo-updater-option_, в нём контроллер, последний будет доступен по адресу site.ru/demo-controller/.

### Откат данных
Для удаления функциональности библиотеки из проекта выполните:
 ```bash
php console phphleb/demo-updater remove
 ```
Эта команда уберёт все данные, внесенные предыдущей командой на добавление, кроме файла конфигурации,
который может пригодиться в дальнейшем.
