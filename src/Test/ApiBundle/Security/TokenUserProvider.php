<?php

namespace Test\ApiBundle\Security;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Doctrine\ORM\EntityRepository;

class TokenUserProvider implements UserProviderInterface {

    protected $authTokenRepository;
    protected $userRepository;

    public function __construct(EntityRepository $authTokenRepository, EntityRepository $userRepository) {
        $this->authTokenRepository = $authTokenRepository;
        $this->userRepository = $userRepository;
    }

    public function getAuthToken($authTokenHeader) {
        return $this->authTokenRepository->findOneByValue($authTokenHeader);
    }

    public function loadUserByUsername($login) {
        return $this->userRepository->findByLogin($login);
    }

    public function refreshUser(UserInterface $user) {
        throw new UnsupportedUserException();
    }

    public function supportsClass($class) {
        return 'Test\ApiBundle\Entity\User' === $class;
    }

}
