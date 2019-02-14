<?php

namespace DoctrineEntitiesModule\Form;

use PrestaShop\PrestaShop\Adapter\Configuration;
use PrestaShop\PrestaShop\Core\Configuration\DataConfigurationInterface;

/**
 * Class is responsible for saving & loading module configuration.
 */
class ModuleConfigurationAdapter implements DataConfigurationInterface
{
    /**
     * @var Configuration
     */
    private $configuration;

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfiguration()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function updateConfiguration(array $config)
    {
        if ($this->validateConfiguration($config)) {
        }

        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function validateConfiguration(array $config)
    {
        return true;
    }
}
