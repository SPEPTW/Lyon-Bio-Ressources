<?php

namespace App\Controller\Lbr;

use App\Entity\Lbr\Organisation;
use App\Form\Lbr\OrganisationType;
use App\Repository\Lbr\OrganisationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/lbr/organisation")
 */
class OrganisationController extends AbstractController
{
    /**
     * @Route("/", name="lbr_organisation_index", methods={"GET"})
     */
    public function index(OrganisationRepository $organisationRepository): Response
    {
        return $this->render('lbr/organisation/index.html.twig', [
            'organisations' => $organisationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="lbr_organisation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $organisation = new Organisation();
        $form = $this->createForm(OrganisationType::class, $organisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($organisation);
            $entityManager->flush();

            return $this->redirectToRoute('lbr_organisation_index');
        }

        return $this->render('lbr/organisation/new.html.twig', [
            'organisation' => $organisation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lbr_organisation_show", methods={"GET"})
     */
    public function show(Organisation $organisation): Response
    {
        return $this->render('lbr/organisation/show.html.twig', [
            'organisation' => $organisation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="lbr_organisation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Organisation $organisation): Response
    {
        $form = $this->createForm(OrganisationType::class, $organisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lbr_organisation_index', [
                'id' => $organisation->getId(),
            ]);
        }

        return $this->render('lbr/organisation/edit.html.twig', [
            'organisation' => $organisation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lbr_organisation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Organisation $organisation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$organisation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($organisation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('lbr_organisation_index');
    }
}
