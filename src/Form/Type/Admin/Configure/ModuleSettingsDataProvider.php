<?php

namespace DoctrineEntitiesModule\Form\Type\Admin\Configure;

use PrestaShop\PrestaShop\Core\Configuration\DataConfigurationInterface;
use PrestaShop\PrestaShop\Core\Form\FormDataProviderInterface;
use Symfony\Component\Translation\TranslatorInterface;
use DoctrineEntitiesModule\Enum\ModuleSetting;

final class ModuleSettingsDataProvider implements FormDataProviderInterface
{
    /**
     * @var DataConfigurationInterface
     */
    private $moduleAdminConfiguration;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    public function __construct(
        DataConfigurationInterface $moduleAdminConfiguration,
        TranslatorInterface $translator
    ) {
        $this->moduleAdminConfiguration = $moduleAdminConfiguration;
        $this->translator = $translator;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return [
            'doctrineentitiesmoduleConfig' => $this->moduleAdminConfiguration->getConfiguration(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function setData(array $data)
    {
        if ($errors = $this->validate($data)) {
            return $errors;
        }

        return true;
    }

    /**
     * Perform validations on form data.
     *
     * @param array $data
     *
     * @return array Array of errors if any
     */
    private function validate(array $data)
    {
        $errors = [];

        return $errors;
    }
}
