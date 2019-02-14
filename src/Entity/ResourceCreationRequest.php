<?php

namespace DoctrineEntitiesModule\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class ResourceCreationRequest
{
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
}
