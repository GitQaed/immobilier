<?php

namespace App\Controller\Back;

use App\Entity\Logement;
use App\Form\LogementType;
use App\Repository\LogementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/logement')]
class LogementController extends AbstractController
{
    #[Route('/', name: 'logement_index', methods: ['GET'])]
    public function index(LogementRepository $logementRepository): Response
    {
        return $this->render('back/logement/index.html.twig', [
            'logements' => $logementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'logement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $logement = new Logement();
        $form = $this->createForm(LogementType::class, $logement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($logement);
            $entityManager->flush();

            return $this->redirectToRoute('logement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/logement/new.html.twig', [
            'logement' => $logement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'logement_show', methods: ['GET'])]
    public function show(Logement $logement): Response
    {
        return $this->render('back/logement/show.html.twig', [
            'logement' => $logement,
        ]);
    }

    #[Route('/{id}/edit', name: 'logement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Logement $logement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LogementType::class, $logement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('logement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/logement/edit.html.twig', [
            'logement' => $logement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'logement_delete', methods: ['POST'])]
    public function delete(Request $request, Logement $logement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$logement->getId(), $request->request->get('_token'))) {
            $entityManager->remove($logement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('logement_index', [], Response::HTTP_SEE_OTHER);
    }
}