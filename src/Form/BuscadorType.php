<?php

namespace App\Form;

use App\Entity\Buscador;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BuscadorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Busqueda', TextType::class, [
                'label' => null,
                'attr' => [
                    'placeholder' => 'Buscar',
                    'class' => 'form-control mr-sm-2'
                ]


            ])
            ->add('Buscar', SubmitType::class, [
                'label' => 'Buscar',
                'attr' => [
                    'class' => 'btn-outline-primary my-2 my-sm-0'
                    ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Buscador::class,
        ]);
    }
}
