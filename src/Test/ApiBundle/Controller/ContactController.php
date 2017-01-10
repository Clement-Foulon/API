<?php

namespace Test\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Test\ApiBundle\Entity\Contact;
use Test\ApiBundle\Entity\Adresse;
use FOS\RestBundle\Controller\Annotations as Rest;

class ContactController extends Controller {

    /**
     * @Rest\View()
     * @Rest\Get("/contacts")
     */
    public function getContactsAction() {
        $contacts = $this->get('doctrine.orm.entity_manager')
                ->getRepository('TestApiBundle:Contact')
                ->findAll();

        return $contacts;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/contacts/{id}")
     */
    public function getContactAction($id) {
        $contact = $this->get('doctrine.orm.entity_manager')
                ->getRepository('TestApiBundle:Contact')
                ->find($id);

        if (empty($contact)) {
            return new JsonResponse(['message' => 'Contact not found'], Response::HTTP_NOT_FOUND);
        }

        return $contact;
    }

    /**
     * @Rest\View()
     * @Rest\Post("/contacts")
     */
    public function postContactsAction(Request $request) {
        $contact = new Contact();
        $contact->setCivilite($request->get('civilite'));
        $contact->setNom($request->get('nom'));
        $contact->setPrenom($request->get('prenom'));
        $contact->setDateNaissance($request->get('datenaissance'));
        $contact->setCreeLe(new \DateTime());
        $adresse = new Adresse();
        $adresse->setCodePostal($request->get('codepostal'));
        $adresse->setVille($request->get('ville'));
        $adresse->setRue($request->get('rue'));
        $adresse->setCreeLe(new \DateTime());

        $adresse->setContact($contact);

        $em = $this->getDoctrine()->getManager();
        $em->persist($adresse);
        $em->persist($contact);
        $em->flush();

        return $this->redirect("http://localhost/API/web/app_dev.php/contacts/" . $contact->getId());
    }

    /**
     * @Rest\View()
     * @Rest\Delete("/contacts/{id}")
     */
    public function removeContactAction(Request $request) {
        $em = $this->get('doctrine.orm.entity_manager');
        $contact = $em->getRepository('TestApiBundle:Contact')
                ->find($request->get('id'));

        if ($contact) {
            $em->remove($contact);
            $em->flush();
        }
    }

    /**
     * @Rest\View()
     * @Rest\Patch("/contacts/{id}")
     */
    public function updateContactAction(Request $request) {
        $em = $this->get('doctrine.orm.entity_manager');
        $contact = $em->getRepository('TestApiBundle:Contact')
                ->find($request->get('id'));

        $adresse = $em->getRepository('TestApiBundle:Adresse')
                ->find($request->get('idadresse'));

        if (empty($contact)) {
            return new JsonResponse(['message' => 'Contact not found'], Response::HTTP_NOT_FOUND);
        }

        $contact->setCivilite($request->get('civilite'));
        $contact->setNom($request->get('nom'));
        $contact->setPrenom($request->get('prenom'));
        $contact->setDateNaissance($request->get('datenaissance'));
        $contact->setMisAjour(new \DateTime());
        
        $adresse->setCodePostal($request->get('codepostal'));
        $adresse->setVille($request->get('ville'));
        $adresse->setRue($request->get('rue'));
        $adresse->setMisAjour(new \DateTime());

        $adresse->setContact($contact);

        $em->merge($contact);
        $em->merge($adresse);
        $em->flush();
        
        return $this->redirect("http://localhost/API/web/app_dev.php/contacts/" . $contact->getId());
    }

}
