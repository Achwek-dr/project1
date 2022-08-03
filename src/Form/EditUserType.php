<?php

namespace App\Form;

use App\Entity\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class EditUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class,['constraints' => [new NotBlank(['message'=>'merci de saisir 
            une adresse Email'])
            ],'required'=>true,'attr'=>['class'=>'form-control']
            ])
            ->add('roles',choiceType::class,['choices'=>
                [
                    'utilisateur'=>'ROLE_USER' ,

                    'administrateur'=>'ROLE_ADMIN',

                    'Poste'=>'ROLE_POSTE',

                    'Ministere'=>'ROLE_MINISTERE',

                    'ETAT'=>'ROLE_ETAT',
                    'Condidat'=>'ROLE_CONDIDAT'

            ],'expanded' => true,
                'multiple' => true,
                'label'=>'Roles'
            ])
            ->add('valider',SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
