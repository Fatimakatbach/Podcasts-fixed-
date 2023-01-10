<?php

namespace App\Form;

use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('EMAIL')
            ->add('roles', ChoiceType::class, [
                'expanded' => true,
                'multiple' => true,
                'choices' => [
                    'Usuario' => 'ROLE_USER',
                    'Admin' => 'ROLE_ADMIN'
                ]
            ])
            ->add('password', PasswordType::class)
            ->add('Nombre')
            ->add('Apellidos')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
        ]);
    }
}
