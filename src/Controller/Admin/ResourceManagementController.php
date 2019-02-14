<?php

namespace DoctrineEntitiesModule\Controller\Admin;


use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use PrestaShopBundle\Security\Annotation\AdminSecurity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use DoctrineEntitiesModule\Entity\Resource;
use DoctrineEntitiesModule\Entity\ResourceCreationRequest;
use DoctrineEntitiesModule\Entity\ResourceEditRequest;
use DoctrineEntitiesModule\Entity\ResourceRepository;
use DoctrineEntitiesModule\Enum\ModuleSetting;
use DoctrineEntitiesModule\Form\Type\Admin\ResourceCreationType;
use DoctrineEntitiesModule\Form\Type\Admin\ResourceEditType;

class ResourceManagementController extends FrameworkBundleAdminController
{
    /**
     * @return Response
     */
    public function index(Request $request)
    {
        $resources = $this->get(ResourceRepository::class)->getResources();
        $legacyController = $request->attributes->get('_legacy_controller');

        return $this->render('@Modules/doctrine_entities_module/views/admin/resource/index.html.twig', [
            'layoutTitle' => $this->get('translator')->trans('Doctrine Entities Module Configuration', [], ModuleSetting::TRANSLATION_DOMAIN_ADMIN),
            'resources' => $resources,
            'help_link' => $this->generateSidebarLink($legacyController),
        ]);
    }

    /**
     * @Security("is_granted('MOD_DEM_CREATE_RESOURCE')")
     */
    public function create(Request $request)
    {
        $creationRequest = new ResourceCreationRequest();
        $form = $this->createForm(ResourceCreationType::class, $creationRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $resource = Resource::createFromRequest($creationRequest);
            $this->get(ResourceRepository::class)->add($resource);

            return $this->redirectToRoute('doctrineentitiesmodule_admin_resources');
        }

        $legacyController = $request->attributes->get('_legacy_controller');

        return $this->render('@Modules/doctrine_entities_module/views/admin/resource/creation.html.twig', [
            'layoutTitle' => $this->get('translator')->trans('Resource Creation', [], ModuleSetting::TRANSLATION_DOMAIN_ADMIN),
            'help_link' => $this->generateSidebarLink($legacyController),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Security("is_granted('MOD_DEM_EDIT_RESOURCE', id)")
     */
    public function edit(Resource $resource, Request $request)
    {
        $editRequest = new ResourceEditRequest($resource);
        $form = $this->createForm(ResourceEditType::class, $editRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $resource->updateFromRequest($editRequest);
            $this->get(ResourceRepository::class)->save($resource);

            return $this->redirectToRoute('doctrineentitiesmodule_admin_resources');
        }

        $legacyController = $request->attributes->get('_legacy_controller');

        return $this->render('@Modules/doctrine_entities_module/views/admin/resource/edit.html.twig', [
            'layoutTitle' => $this->get('translator')->trans('Resource Modification', [], ModuleSetting::TRANSLATION_DOMAIN_ADMIN),
            'help_link' => $this->generateSidebarLink($legacyController),
            'form' => $form->createView(),
        ]);
    }
}
