<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\Lbr\CategorieRepository;
use App\Repository\Lbr\ContactRepository;
use App\Repository\Lbr\OrganisationRepository;
use App\Repository\Lbr\EvenementRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class PagesController extends AbstractController
{
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/lbr/dashboard", name="dashboard")
     */

    public function dashboard (
        CategorieRepository $categorieRepository,
        ContactRepository $contactRepository,
        OrganisationRepository $organisationRepository,
        EvenementRepository $evenementRepository): Response {

            $allContacts = $contactRepository->findAll();
            $nbContacts     = count( $allContacts );
            $cinqDerniersContacts = array_slice( $allContacts, 0, 5 );
            
            $nbCategories   = count($categorieRepository->findAll());
            $nbOrganisations= count($organisationRepository->findAll());
            $nbEvenements   = count($evenementRepository->findAll());

            $nbContactsEnAttente = count( $contactRepository->findAwait() );

            $cinqContactsAValider = array_slice( $contactRepository->findAwait(), 0, 5);

            $dixDerniersContactsModif = $contactRepository->findLastTenUpdates();

            $cinqProchainsEvents = $evenementRepository->findNextFive();
            
            return $this->render('pages/index.html.twig', 
                compact(
                    'nbCategories',
                    'nbContacts',
                    'cinqDerniersContacts',
                    'nbOrganisations',
                    'nbEvenements',
                    'nbContactsEnAttente',
                    'cinqProchainsEvents',
                    'dixDerniersContactsModif',
                    'cinqContactsAValider'
            ));
    }
}
