<?php

namespace App\Form;

use App\Entity\Commentaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CommentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('email')
            ->add('Page_d_acceuil')
            ->add('commentaire')
            ->add('text_format', ChoiceType::class, [
                'required'=>false,
                'choices' => Commentaire::FORMAT,
                'placeholder'=>"Choisissez le type format"
            ])
            ->add("Enregistrer", SubmitType::class, [
                "attr"=>[
                    "class"=>"btn btn-primary ml-2 float-right"
                ]

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commentaire::class,
        ]);
    }
}
