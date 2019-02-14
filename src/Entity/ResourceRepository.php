<?php

namespace DoctrineEntitiesModule\Entity;

use Doctrine\ORM\EntityManagerInterface;
use Employee;
use PrestaShopBundle\Exception\NotImplementedException;
use PrestaShop\PrestaShop\Adapter\LegacyContext as ContextAdapter;
use RuntimeException;
use Shop;

class ResourceRepository
{
    const RESOURCE_TABLE = 'module_doctrineentitiesmodule_resource';

    /**
     * @var int
     */
    private $languageId;

    /**
     * @var int
     */
    private $shopId;

    public function __construct(
        ContextAdapter $contextAdapter,
        EntityManagerInterface $em
    ) {
        $context = $contextAdapter->getContext();

        if (!$context->employee instanceof Employee) {
            throw new RuntimeException('Determining the active language requires a contextual employee instance.');
        }

        $languageId = $context->employee->id_lang;
        $this->languageId = (int) $languageId;

        if (!$context->shop instanceof Shop) {
            throw new RuntimeException('Determining the active shop requires a contextual shop instance.');
        }

        $shop = $context->shop;
        if ($shop->getContextType() !== $shop::CONTEXT_SHOP) {
            throw new NotImplementedException('Shop context types other than "single shop" are not supported');
        }

        $this->shopId = $shop->getContextualShopId();

        $this->em = $em;
        $this->repository = $em->getRepository(Resource::class);
    }

    /**
     * @return Resource[]
     */
    public function getResources(): array
    {
        $qb = $this->repository->createQueryBuilder('r');

        return $qb->getQuery()->getResult();
    }

    public function find(int $id): ?Resource
    {
        return $this->repository->find($id);
    }

    public function add(Resource $object): void
    {
        $this->em->persist($object);
        $this->em->flush();
    }

    public function save(Resource $object): void
    {
        $this->em->persist($object);
        $this->em->flush();
    }
}
