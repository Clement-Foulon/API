<?php

namespace Test\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Test\ApiBundle\Entity\User;

class UserController extends Controller {

    /**
     * @Rest\View()
     * @Rest\Post("/users")
     */
    public function postUsersAction(Request $request) {
        $user = new User();
        $user->setLogin($request->get('login'));

        $encoder = $this->get('security.password_encoder');
        $encoded = $encoder->encodePassword($user, $request->get('password'));
        $user->setPassword($encoded);

        $em = $this->get('doctrine.orm.entity_manager');
        $em->persist($user);
        $em->flush();
        return $user;
    }

    /**
     * @Rest\View()
     * @Rest\Patch("/users/{id}")
     */
    public function patchUserAction(Request $request) {
        $user = $this->get('doctrine.orm.entity_manager')
                ->getRepository('TestApiBundle:User')
                ->find($request->get('id'));

        if (empty($user)) {
            return new JsonResponse(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }
        if (!empty($user->getLogin())) {
            $user->setLogin($request->get('login'));
        }

        if (!empty($request->get('password'))) {
            $encoder = $this->get('security.password_encoder');
            $encoded = $encoder->encodePassword($user, $request->get('password'));
            $user->setPassword($encoded);
        }
        $em = $this->get('doctrine.orm.entity_manager');
        $em->merge($user);
        $em->flush();
        return $user;
    }

}
