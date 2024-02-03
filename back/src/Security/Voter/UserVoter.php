<?php 
// Logique qui décide si l'utilisateur a le droit ou non de faire une action (comme modifier ou supprimer).
namespace App\Security\Voter;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class UserVoter extends Voter
{
    // Cette méthode vérifie si ce Voter doit être utilisé pour la décision.
    protected function supports(string $attribute, $subject): bool
    {
        return in_array($attribute, ['EDIT', 'DELETE']) && $subject instanceof User;
    }

    // Cette méthode contient la logique qui détermine si l'utilisateur peut faire l'action.
    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // On vérifie si l'utilisateur est connecté et s'il est l'utilisateur concerné par l'action.
        if (!$user instanceof User) {
            return false;
        }

        // On autorise l'utilisateur à modifier ou supprimer son propre profil.
        return $user === $subject;
    }
}
