<?php

namespace App\Form;

use App\Entity\Agence;
use App\Entity\Logement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LogementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('superficie')
            ->add('ville')
            ->add('prix')
            ->add('agences', EntityType::class, ["class" => Agence::class,
            "choice_label" => "nom",
            "multiple" => true,
             "expanded" => true])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Logement::class,
        ]);
    }
}