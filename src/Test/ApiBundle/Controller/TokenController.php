<?php

namespace Test\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Test\ApiBundle\Entity\Token;

class TokenController extends Controller {

    /**
     * @Rest\View()
     * @Rest\Post("/tokens")
     */
    public function postTokensAction(Request $request) {
        $em = $this->get('doctrine.orm.entity_manager');

        $user = $em->getRepository('TestApiBundle:User')
                ->findOneByLogin($request->get('login'));

        if (!$user) {
            return new JsonResponse(['message' => 'invalid'], Response::HTTP_BAD_REQUEST);
        }

        $token = new Token();
        $token->setValue(base64_encode(random_bytes(50)));
        $token->setCreatedAt(new \DateTime('now'));
        $token->setUser($user);

        $em->persist($token);
        $em->flush();

        return $token;
    }

    /**
     * @Rest\View()
     * @Rest\Delete("/tokens/{id}")
     */
    public function removeTokenAction(Request $request) {
        $em = $this->get('doctrine.orm.entity_manager');
        $authToken = $em->getRepository('TestApiBundle:Token')
                ->find($request->get('id'));

        if ($authToken) {
            $em->remove($authToken);
            $em->flush();
        } else {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException();
        }
    }

}
