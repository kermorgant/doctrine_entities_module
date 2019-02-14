<?php

namespace DoctrineEntitiesModule\Form\Type\Admin;

use PrestaShopBundle\Form\Admin\Type\CommonAbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use DoctrineEntitiesModule\Enum\ModuleSetting;

class ResourceEditType extends CommonAbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class);
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
        return 'doctrineentitiesmodule_admin_resource';
    }
}
