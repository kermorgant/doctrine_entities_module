<?php

namespace DoctrineEntitiesModule\Form\Type\Admin\Configure;

use PrestaShop\PrestaShop\Core\Form\FormHandler;
use PrestaShopBundle\Entity\Repository\TabRepository;

/**
 * based on CustomerPreferencesFormHandler.php
 */
final class ModuleSettingsFormHandler extends FormHandler
{
    /**
     * @var TabRepository
     */
    private $tabRepository;
    /**
     * {@inheritdoc}
     */
    public function save(array $data)
    {
        $errors = parent::save($data);

        return $errors;
    }

    /**
     * @param TabRepository $tabRepository
     */
    public function setTabRepository(TabRepository $tabRepository)
    {
        $this->tabRepository = $tabRepository;
    }
}
