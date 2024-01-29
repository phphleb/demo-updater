<?php

declare(strict_types=1);

namespace Phphleb\DemoUpdater\DemoLogic;

use Hleb\Helpers\StorageLibConfigurator;
use JsonException;

/**
 * This class demonstrates the possible use of library logic
 * along with data deployed to the project.
 * In order to avoid creating significant duplicates of the code,
 * all possible part of it should be located in the library.
 *
 * Этот класс демонстрирует возможное использование логики библиотеки
 * вместе с развернутыми в проект данными.
 * Во избежание создания значительных дублей кода,
 * вся возможная часть его должна располагаться в библиотеке.
 */
class DeploymentManager
{
    /**
     * Getting a parameter from a configuration.
     *
     * Получение параметра из конфигурации.
     *
     * @throws JsonException
     */
    public static function getDesign(): string|false
    {
        $helper = new StorageLibConfigurator('phphleb/demo-updater');
        $config = $helper->getConfig('config.json');
        if (empty($config)) {
            return false;
        }
        return $config['design'];
    }
}

