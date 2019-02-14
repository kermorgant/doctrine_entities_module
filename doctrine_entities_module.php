<?php

use PrestaShop\PrestaShop\Adapter\SymfonyContainer;

require_once(__DIR__ . '/vendor/autoload.php');

if (!defined('_PS_VERSION_')) {
    exit;
}

class Doctrine_Entities_Module extends Module
{
    const MODULE_NAME = 'DoctrineEntitiesModule';
    protected $config_form = false;

    // legacy way of adding an item in the sidebar
    public $tabs = array(
        // links to controllers/admin/DoctrineEntitiesController
        array('name' => 'Doctrine Entities', 'class_name' => 'DoctrineEntitiesModule', 'parent_class_name' => 'ShopParameters')
    );

    public function __construct()
    {
        $this->name = 'doctrine_entities_module';
        $this->tab = 'front_office_features';
        $this->version = '0.1.0';
        $this->author = 'MK';
        $this->need_instance = 1;
        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Doctrine Entities');
        $this->description = $this->l('Enjoy Doctrine Entities declared in a module');
        $this->ps_versions_compliancy = array('min' => '1.7.5', 'max' => _PS_VERSION_);
    }

    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {
        return parent::install() &&
            $this->registerHook('header') &&
            $this->registerHook('backOfficeHeader') &&
            $this->registerHook('displayLeftColumn') &&
            DoctrineEntitiesModule\Schema\SchemaManager::create();
    }

    public function uninstall()
    {
        DoctrineEntitiesModule\Schema\SchemaManager::uninstall();

        return parent::uninstall();
    }

    /**
     * triggers creation of a 'Configure' link in the back office module list
     */
    public function getContent()
    {
        $container = SymfonyContainer::getInstance();
        Tools::redirectAdmin($container->get('router')->generate('doctrineentities_admin_config'));
    }

    /**
     * Add the CSS & JavaScript files you want to be loaded in the BO.
     */
    public function hookBackOfficeHeader()
    {
        if (Tools::getValue('module_name') == $this->name) {
            $this->context->controller->addJS($this->_path.'views/js/back.js');
            $this->context->controller->addCSS($this->_path.'views/css/back.css');
        }
    }

    /**
     * Add the CSS & JavaScript files you want to be added on the FO.
     */
    public function hookHeader()
    {
        $this->context->controller->addJS($this->_path.'/views/js/front.js');
        $this->context->controller->addCSS($this->_path.'/views/css/front.css');
    }
}
