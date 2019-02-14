<?php

namespace DoctrineEntitiesModule\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class ResourceEditRequest
{
    private $id;

    /**
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Resource name must be at least {{ limit }} characters long",
     *      maxMessage = "Resource name cannot be longer than {{ limit }} characters"
     * )
     * @Assert\NotNull(message = "Resource name cannot be null")
     */
    public $name;

    public function __construct(Resource $resource)
    {
        $this->id = $resource->getId();
        $this->name = $resource->getName();
    }

    public function getId(): int
    {
        return $this->id;
    }
}
