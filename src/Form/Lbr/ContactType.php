<?php

namespace App\Form\Lbr;

use App\Entity\Lbr\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Lbr\Categorie;
use App\Entity\Lbr\Organisation;

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
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => function($cat) {
                    return $cat->getTitre();
                }
            ])
            ->add('organisation', EntityType::class, [
                'class' => Organisation::class,
                'choice_label' => function($cat) {
                     return $cat->getNom();
                }
            ])
            ->add('evenement', EntityType::class, [
                'class' => Evenement::class,
                'choice_label' => function($cat) {
                     return $cat->getNom();
                }
            ]) 


            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}