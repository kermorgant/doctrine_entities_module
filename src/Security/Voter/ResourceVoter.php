<?php

namespace DoctrineEntitiesModule\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class ResourceVoter extends Voter
{
    const CREATE = 'MOD_DEM_CREATE_RESOURCE';
    const EDIT = 'MOD_DEM_EDIT_RESOURCE';

    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, [self::EDIT, self::CREATE])) {
            return true;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        switch ($attribute) {
            case self::EDIT:
                return $this->canEdit($user, $subject);
                break;
            case self::CREATE:
                return $this->canCreate($user);
                break;
        }

        throw new \LogicException('This code should not be reached!');
    }

    /**
     * @param Employee $user
     */
    private function canCreate($user): bool
    {
        return true;
    }

    /**
     * @param Employee $user
     */
    private function canEdit($user, $id): bool
    {
        return true;
    }
}
