<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\PasswordStrength;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Your email',
                'attr' => [
                    'placeholder' => 'Add email',
                ],
                'constraints' => [
                    new Email([
                        'mode' => 'html5',
                        'message' => 'In Latin letters, example `user@gmail.com`',
                    ]),
                ],
            ])
            ->add('username', TextType::class, [
                'label' => 'Your name',
                'attr' => [
                    'placeholder' => 'Add name',
                ],
                'constraints' => [
                    new Length([
                        'min' => 3,
                    ]),
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label' => 'Agree',
            ])
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'label' => 'Your password',
                'attr' => [
                    'autocomplete' => 'new-password',
                    'placeholder' => 'Add password',
                ],
                'constraints' => [
                    new PasswordStrength([
                        'message' => 'Weak password! Example: `Nick#Jordan7%` > 12 characters. Numbers, symbols, upper and lowercase letters',
                    ]),
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Register',
                'attr' => ['class' => 'btn_register_submit'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
