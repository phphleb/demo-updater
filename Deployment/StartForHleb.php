<?php

declare(strict_types=1);

namespace Phphleb\DemoUpdater\Deployment;

use Hleb\Helpers\StorageLibConfigurator;
use Hleb\Main\Console\Commands\Deployer\DeploymentLibInterface;
use JsonException;
use Phphleb\Updater\AddAction;
use Phphleb\Updater\RemoveAction;

class StartForHleb implements DeploymentLibInterface
{
    private bool $noInteraction = false;

    private bool $quiet = false;

    /**
     * @param array $config - configuration for deploying libraries,
     *                        sample in updater.json file.
     *                      - конфигурация для развертывания библиотек,
     *                        образец в файле updater.json.
     */
    public function __construct(private readonly array $config)
    {
    }

    /**
     * @inheritDoc
     */
    #[\Override]
    public function noInteraction(): void
    {
        $this->noInteraction = true;
    }

    /**
     * @inheritDoc
     */
    #[\Override]
    public function help(): string|false
    {
        return 'Performs a demo deployment/rollback for the `demo-updater` component.';
    }

    /**
     * @inheritDoc
     *
     * @throws JsonException
     */
    #[\Override]
    public function add(): int
    {
        $action = new AddAction($this->config, $this->noInteraction, $this->quiet);
        $code = $action->run();

        // Get the final value of the settings.
        // Получение конечного значение настроек.
        $options = $action->getOptions();

        // Entering the current value of the parameter into the configuration.
        // Внесение в конфигурацию текущего значения параметра.
        $design = $options['demo-updater-design'];
        $helper = new StorageLibConfigurator($this->config['component']);
        $result = $helper->setConfigOption('config.json', 'design', $design);

        // Returned execution code (0 - successful).
        // Возвращаемый код выполнения (0 - успешно).
        return $code ?: (int)(!$result);
    }

    /**
     * @inheritDoc
     */
    #[\Override]
    public function remove(): int
    {
        return (new RemoveAction($this->config, $this->noInteraction, $this->quiet))->run();
    }

    /**
     * Returns the library class loading map required for deployment
     * in the format: classname => realpath.
     * This is needed in case for some reason these classes
     * are not supported by the current class loaders.
     * In most cases, returning an empty array will suffice.
     *
     * Возвращает необходимую для развертывания карту загрузки
     * классов библиотеки в формате: classname => realpath.
     * Это нужно в случае, если по какой-то причине эти классы
     * не поддерживаются текущими загрузчиками классов.
     * В большинстве случаев будет достаточно вернуть пустой массив.
     *
     * @inheritDoc
     */
    #[\Override]
    public function classmap(): array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    #[\Override]
    public function quiet(): void
    {
        $this->quiet = true;
    }
}