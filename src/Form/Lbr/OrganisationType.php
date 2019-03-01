<?php

namespace App\Form\Lbr;

use App\Entity\Lbr\Organisation;
use App\Entity\Lbr\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class OrganisationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('Description')
            ->add('categorie', EntityType::class, [
                'required' => false,
                'class' => Categorie::class,
                'choice_label' => function($cat) {
                    return $cat->getTitre();
                }
            ])

            /* ->add('contacts') */
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Organisation::class,
        ]);
    }
}
