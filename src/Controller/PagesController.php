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
     * @IsGranted("ROLE_USER")
     * @Route("/lbr/dashboard", name="dashboard")
     * @Route("/", name="dashboard")
     */

    public function dashboard (
        CategorieRepository $categorieRepository,
        ContactRepository $contactRepository,
        OrganisationRepository $organisationRepository,
        EvenementRepository $evenementRepository): Response {

            $nbCategories   = count($categorieRepository->findAll());
            $nbContacts     = count($contactRepository->findAll());
            $nbOrganisations= count($organisationRepository->findAll());
            $nbEvenements   = count($evenementRepository->findAll());

            $nbContactsEnAttente = $contactRepository->findAwait();
            dump($nbContactsEnAttente);

            $dixDerniersContactsModif = $contactRepository->findLastTenUpdates();
            dump($dixDerniersContactsModif);

            $troisProchainsEvents = '$evenementRepository->findNextThree()';
            
            return $this->render('pages/index.html.twig', [
                'controller_name' => 'PagesController',
                compact(
                    'nbCategories',
                    'nbCategories',
                    'nbContacts',
                    'nbOrganisations',
                    'nbEvenements',
                    'nbContactsEnAttente',
                    'troisProchainsEvents',
                    'dixDerniersContactsModif'
                )
            ]);
    }
}
