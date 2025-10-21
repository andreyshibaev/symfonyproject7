<?php

namespace App\Controller;

use App\Form\ChangePasswordFormType;
use App\Form\ProfileFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
class ProfileController extends AbstractController
{
    #[Route('/account-user', name: 'account-user')]
    public function index(): Response
    {
        return $this->render('profile/index.html.twig', [
            'title' => 'Account',
        ]);
    }

    #[Route('/edit-profile', name: 'user_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        EntityManagerInterface $entityManager,
    ): Response {
        $user = $this->getUser();
        $profileform = $this->createForm(ProfileFormType::class, $user);
        $profileform->handleRequest($request);

        if ($profileform->isSubmitted() && $profileform->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Your data has been successfully updated!');

            return $this->redirectToRoute('account-user');
        }

        return $this->render('profile/edit_profile.html.twig', [
            'title' => 'Edit profile',
            'user' => $user,
            'profileform' => $profileform->createView(),
        ]);
    }

    #[Route('/change-password-page', name: 'change_password', methods: ['GET', 'POST'])]
    public function change_password(
        Request $request,
        EntityManagerInterface $entityManager,
    ): Response {
        $user = $this->getUser();
        $passwordform = $this->createForm(ChangePasswordFormType::class, $user);
        $passwordform->handleRequest($request);

        if ($passwordform->isSubmitted() && $passwordform->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Your password has been successfully changed!');

            return $this->redirectToRoute('app_logout');
        }

        return $this->render('profile/change_password.html.twig', [
            'title' => 'Change password for ',
            'passwordform' => $passwordform->createView(),
        ]);
    }
}
