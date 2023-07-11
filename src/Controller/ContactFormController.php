<?php

namespace App\Controller;

use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManager;
use App\Entity\Message;
use App\Entity\User;
use App\Form\ContactFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactFormController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/', name: 'homepage')]
    #[Route('/messages', name: 'messages_index')]
    public function index(): Response
    {
        $this->redirectToRoute('messages_index');
        $repository = $this->em->getRepository(Message::class);
        $messages = $repository->findAll();
        return $this->render('messages/index.html.twig', [
            'messages' => $messages
        ]);
    }

    #[Route('/messages/create', name: 'messages_create')]
    public function create(Request $request): Response
    {
        $message = new Message();
        $form = $this->createForm(ContactFormType::class, $message);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $newMovie = $form->getData();

            $users = $this->em->getRepository(User::class)->findAll();
            $randomUser = null;

            if (!empty($users)) {
                $randomKey = array_rand($users, 1);
                $randomUser = $users[$randomKey];
            }

            $newMovie->setUser($randomUser);

            $this->em->persist($newMovie);
            $this->em->flush();

            $this->addFlash(
                'success',
                "Köszönjük szépen a kérdésedet. Válaszunkkal hamarosan keresünk a megadott e-mail címen."
            );

            return $this->redirectToRoute('messages_index');
        }

        if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash(
                'error',
                "Hiba! Kérjük töltsd ki az összes mezőt!"
            );
        }

        return $this->render('messages/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/messages/{id}', methods: ['GET'], name: 'messages_show')]
    public function show($id): Response
    {
        $repository = $this->em->getRepository(Message::class);
        $message = $repository->find($id);
        return $this->render('messages/show.html.twig', [
            'message' => $message
        ]);
    }
}
