<?php

namespace App\Controller\Lbr;

use App\Entity\Lbr\Contact;
use App\Form\Lbr\ContactType;
use App\Repository\Lbr\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DrewM\MailChimp\MailChimp;

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

        $contacts = $contactRepository->findAll();

        return $this->render('lbr/contact/index.html.twig', [
            'contacts' => $contacts,
        ]);
    }

    /**
     * @Route("/valider", name="lbr_contact_valider", methods={"GET"})
     */
    public function indexContactsNonValides(ContactRepository $contactRepository): Response
    {

        $contacts = $contactRepository->findAwait();

        return $this->render('lbr/contact/index.html.twig', [
            'contacts' => $contacts,
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

            /**
             * Ajout à la liste de diffusion
             */

            $mailchimp = new MailChimp( getenv('MAILCHIMP_API_KEY') );

            $mcLists = $mailchimp->get('lists'); // Listes Mailchimp
            $search = $contact->getCategorie()->getTitre(); // Recherche par titre de catégorie

            foreach( $mcLists['lists'] as $list) {
                if (stripos(strtolower($search), strtolower($list['name'])) !== false) {
                    $listId = $list['id'];
                    $result = $mailchimp->post("lists/$listId/members", [
                        'email_address' => $contact->getEmail(),
                        'status'        => 'subscribed',
                ]);
                    break; // On break pour n'avoir que le premier match si plusieurs résultats correspondaient
                }
            }

            /**
             * Ajout aux listes presse et newsletter
             */

            if ($request->get('newsletter_send')){

                foreach( $mcLists['lists']  as $list) {
                     if (stripos(strtolower('newsletter'), strtolower($list['name'])) !== false) {
                        $listId = $list['id'];
                        $result = $mailchimp->post("lists/$listId/members", [
                            'email_address' => $contact->getEmail(),
                            'status'        => 'subscribed',
                        ]);

                        $contact->setNewsletterSend(true);
                        break; // On break pour n'avoir que le premier match si plusieurs résultats correspondaient
                    }
                }
            }

            if ($request->get('presse_send')){

                 foreach( $mcLists['lists'] as $list) {
                    if (stripos(strtolower('presse'), strtolower($list['name'])) !== false) {
                        $listId = $list['id'];
                        $result = $mailchimp->post("lists/$listId/members", [
                            'email_address' =>  $contact->getEmail(),
                            'status'        => 'subscribed',
                        ]);

                        $contact->setPresseSend(true);

                        break; // On break pour n'avoir que le premier match si plusieurs résultats correspondaient
                    }
                }
            }

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
