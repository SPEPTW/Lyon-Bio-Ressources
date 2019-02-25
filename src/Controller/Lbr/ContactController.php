<?php

namespace App\Controller\Lbr;

use App\Entity\Lbr\Contact;
use App\Form\Lbr\ContactType;
use App\Repository\Lbr\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/lbr/contact")
 */
class ContactController extends AbstractController
{
    /**
     * @Route("/", name="lbr_contact_index", methods={"GET"})
     */
    public function index(ContactRepository $contactRepository): Response
    {
        return $this->render('lbr/contact/index.html.twig', [
            'contacts' => $contactRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="lbr_contact_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('lbr_contact_index');
        }

        return $this->render('lbr/contact/new.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lbr_contact_show", methods={"GET"})
     */
    public function show(Contact $contact): Response
    {
        return $this->render('lbr/contact/show.html.twig', [
            'contact' => $contact,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="lbr_contact_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Contact $contact): Response
    {
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lbr_contact_index', [
                'id' => $contact->getId(),
            ]);
        }

        return $this->render('lbr/contact/edit.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lbr_contact_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Contact $contact): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contact->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($contact);
            $entityManager->flush();
        }

        return $this->redirectToRoute('lbr_contact_index');
    }
}
