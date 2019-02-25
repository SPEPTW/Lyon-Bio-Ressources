<?php

namespace App\Form\Lbr;

use App\Entity\Lbr\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('rue')
            ->add('ville')
            ->add('code_postale')
            ->add('statut')
            ->add('tel_1')
            ->add('tel_2')
            ->add('tel_3')
            ->add('id_categorie')
            ->add('organisation')
            ->add('id_evenement')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
