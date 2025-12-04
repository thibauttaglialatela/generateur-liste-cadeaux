<?php

namespace App\Controller;

use App\Form\GiftPollType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(GiftPollType::class);
        $form->handleRequest($request);

        $poll = null;

        if ($form->isSubmitted() && $form->isValid()) {
            $poll = $form->getData();
            $this->addFlash('poll', $poll);

            return $this->redirectToRoute('app_home');
        }

        return $this->render('home/index.html.twig', [
            'form' => $form,
            'poll' => $poll
        ]);
    }
}
