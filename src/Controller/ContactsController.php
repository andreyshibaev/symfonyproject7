<?php

namespace App\Controller;

use App\Form\ContactsPageFormType;
use App\Service\SendEmailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ContactsController extends AbstractController
{
    #[Route('/contactspage', name: 'contactspage')]
    public function index(
        Request $request,
        $admin_email,
        SendEmailService $emailService,
    ): Response {
        $contactsform = $this->createForm(ContactsPageFormType::class);
        $contactsform->handleRequest($request);
        if ($contactsform->isSubmitted() && $contactsform->isValid()) {
            $contactsform_Data = $contactsform->getData();
            $emailsender = 'Message from '.$contactsform_Data['emailuser'];
            $contentletter = $contactsform_Data['content_message'];
            $emailService->sendEmail($admin_email, $emailsender, $contentletter);

            $this->addFlash('success', 'Your letter has been sent successfully!');

            return $this->redirectToRoute('contactspage');
        }

        return $this->render('contacts/index.html.twig', [
            'title' => 'Contacts page',
            'contactsform' => $contactsform->createView(),
        ]);
    }
}
