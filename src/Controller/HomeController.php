<?php

namespace App\Controller;

use App\Form\GiftPollType;
use App\Service\ApiMistralAi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    public function __construct(
        private readonly ApiMistralAi $apiMistral
    ) {}


    #[Route('/', name: 'app_home')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(GiftPollType::class);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $sexe = $form->get('sexe')->getData();
            $age = $form->get('age')->getData();


            $prompt = <<<PROMPT
Génére un JSON strict contenant une liste de 5 idées cadeaux adaptées à : 
- sexe: $sexe
- âge: $age

Format strict : 
{
    "cadeaux": [
        "Idée 1",
        "Idée 2",
        "Idée 3",
        "Idée 4",
        "Idée 5"
            ]
}
Aucune décoration, aucun ```, aucun texte. Seulement du JSON valide.
PROMPT;

            $answer = $this->apiMistral->submit($prompt);

            // Extraire tout le JSON présent dans la réponse
            if (preg_match('/\{.*\}/s', $answer, $matches)) {
                $json = json_decode($matches[0], true);
            } else {
                $json = null;
            }

            return new JsonResponse($json);
        }

        return $this->render('home/index.html.twig', [
            'form' => $form,
        ]);
    }
}
