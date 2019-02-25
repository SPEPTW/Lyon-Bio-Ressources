<?php

namespace App\Controller\Lbr;

use App\Entity\Lbr\Evenement;
use App\Form\Lbr\EvenementType;
use App\Repository\Lbr\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/lbr/evenement")
 */
class EvenementController extends AbstractController
{
    /**
     * @Route("/", name="lbr_evenement_index", methods={"GET"})
     */
    public function index(EvenementRepository $evenementRepository): Response
    {
        return $this->render('lbr/evenement/index.html.twig', [
            'evenements' => $evenementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="lbr_evenement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($evenement);
            $entityManager->flush();

            return $this->redirectToRoute('lbr_evenement_index');
        }

        return $this->render('lbr/evenement/new.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lbr_evenement_show", methods={"GET"})
     */
    public function show(Evenement $evenement): Response
    {
        return $this->render('lbr/evenement/show.html.twig', [
            'evenement' => $evenement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="lbr_evenement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Evenement $evenement): Response
    {
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lbr_evenement_index', [
                'id' => $evenement->getId(),
            ]);
        }

        return $this->render('lbr/evenement/edit.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lbr_evenement_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Evenement $evenement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evenement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($evenement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('lbr_evenement_index');
    }
}
