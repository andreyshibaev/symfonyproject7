<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NoSuspiciousCharacters;

class ContactsPageFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'Your name',
                'attr' => [
                    'placeholder' => 'Add name',
                ],
                'constraints' => [
                    new Length(
                        min: 3,
                    ),
                ],
            ])
            ->add('emailuser', EmailType::class, [
                'label' => 'Your email',
                'attr' => [
                    'placeholder' => 'Add email',
                ],
                'constraints' => [
                    new Email(
                        message: 'In Latin letters, example `user@gmail.com`',
                        mode: 'html5',
                    ),
                    new NoSuspiciousCharacters(),
                ],
            ])
            ->add('content_message', TextareaType::class, [
                'label' => 'Your message',
                'required' => true,
                'constraints' => [
                    new Length(
                        min: 15,
                    ),
                    new NoSuspiciousCharacters(),
                ],
                'attr' => [
                    'placeholder' => 'Write your question',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Submit',
                'attr' => ['class' => 'btn btn-success'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
