<?php

namespace DoctrineEntitiesModule\Controller\Admin;

use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use PrestaShopBundle\Security\Annotation\AdminSecurity;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use DoctrineEntitiesModule\Enum\ModuleSetting;

class ModuleConfigController extends FrameworkBundleAdminController
{
    const TRANSLATION_DOMAIN = 'Modules.DoctrineEntitiesModule.Admin';

    /**
     * @return Response
     * @AdminSecurity("is_granted('read', request.get('_legacy_controller'))", message="Access denied.")
     */
    public function index(Request $request)
    {
        $form = $this->get('doctrineentitiesmodule.admin.module_config.form_handler')->getForm();
        $legacyController = $request->attributes->get('_legacy_controller');

        return $this->render('@Modules/doctrine_entities_module/views/admin/module_config.html.twig', [
            'layoutTitle' => $this->get('translator')->trans('Doctrine Entities Module Configuration', [], ModuleSetting::TRANSLATION_DOMAIN_ADMIN),
            'form' => $form->createView(),
            'help_link' => $this->generateSidebarLink($legacyController),
        ]);
    }


    /**
     * @AdminSecurity("is_granted(['read','update', 'create','delete'], request.get('_legacy_controller'))", message="You do not have permission to update this.", redirectRoute="doctrineentitiesmodule_admin_config")
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function process(Request $request)
    {
        $formHandler = $this->get('doctrineentitiesmodule.admin.module_config.form_handler');
        $form = $formHandler->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $data = $form->getData();

            if ($errors = $formHandler->save($data)) {
                $this->flashErrors($errors);
                return $this->redirectToRoute('doctrineentitiesmodule_admin_config');
            }
            $this->addFlash('success', $this->trans('Settings saved', ModuleSetting::TRANSLATION_DOMAIN_ADMIN));
        }

        return $this->redirectToRoute('doctrineentitiesmodule_admin_config');
    }
}
