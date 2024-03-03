<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\PasswordStrength;

class ChangePasswordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('currentPassword', PasswordType::class, [
                'constraints' => [
                    new UserPassword([
                        'message' => 'Enter the correct current password',
                    ]),
                ],
                'label' => 'Current Password',
                'mapped' => false,
            ])
            ->add('newPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'constraints' => [
                    new NotBlank(),
                    new Length(
                        min: 8,
                        max: 128,
                    ),
                    new PasswordStrength([
                        'message' => 'Weak password! Example: `Nick#Jordan7%` > 12 characters. Numbers, symbols, upper and lowercase letters',
                    ]),
                ],
                'mapped' => false,
                'first_options' => [
                    'hash_property_path' => 'password',
                    'label' => 'New password',
                ],
                'second_options' => [
                    'label' => 'Confirm password',
                ],
            ])
            ->add('change', SubmitType::class, [
                'label' => 'Change',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
