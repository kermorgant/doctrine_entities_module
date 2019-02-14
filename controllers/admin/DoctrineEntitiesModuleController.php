<?php

use PrestaShop\PrestaShop\Adapter\SymfonyContainer;

/**
 * Legacy way of adding actions to the sidebar
 * Let's get out of this as fast as possible and use the symfony way instead...
 */
class DoctrineEntitiesModuleController extends ModuleAdminController
{
    public function __construct()
    {
        $this->display = 'view';
        parent::__construct();

        if (!$this->module->active) {
            Tools::redirectAdmin($this->context->link->getAdminLink('AdminHome'));
        }
    }

    public function renderView()
    {
        $container = SymfonyContainer::getInstance();
        Tools::redirectAdmin($container->get('router')->generate('doctrineentitiesmodule_admin_resources'));
    }
}
