<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('status')
            ->add('date')
            ->add('priorite')
            ->add('user', EntityType::class, [
                'label' => 'User',
                'class' => User::class,
                'choice_label' => 'nom',
                'placeholder' => 'Selectionnez un employee',
                'attr' => [
                    
                    'class' => 'form-control animate__animated animate__fadeInDown',
                ], 'constraints'=>[
                    new Assert\Valid(),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
