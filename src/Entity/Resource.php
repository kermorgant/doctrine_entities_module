<?php

namespace DoctrineEntitiesModule\Entity;

class Resource
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    public static function createFromRequest(ResourceCreationRequest $request): self
    {
        $resource = new self();
        $resource->name = $request->name;

        return $resource;
    }

    public function updateFromRequest(ResourceEditRequest $request): void
    {
        $this->name = $request->name;
    }

    public static function hydrateFromRecord($row): self
    {
        $resource = new self();
        $resource->id = (int)$row['id'];
        $resource->name = $row['name'];

        return $resource;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
