<?php

namespace DoctrineEntitiesModule\Form\Type\Admin;

use PrestaShopBundle\Form\Admin\Type\CommonAbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use DoctrineEntitiesModule\Enum\ModuleSetting;

class ModuleConfigType extends CommonAbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'translation_domain' => ModuleSetting::TRANSLATION_DOMAIN_ADMIN,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'doctrineentitiesmodule_admin_config';
    }
}
