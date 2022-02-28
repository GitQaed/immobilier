<?php

namespace App\Controller\Back;

use App\Entity\Agence;
use App\Form\AgenceType;
use App\Repository\AgenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/agence')]
class AgenceController extends AbstractController
{
    #[Route('/', name: 'agence_index', methods: ['GET'])]
    public function index(AgenceRepository $agenceRepository): Response
    {
        return $this->render('back/agence/index.html.twig', [
            'agences' => $agenceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'agence_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $agence = new Agence();
        $form = $this->createForm(AgenceType::class, $agence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($agence);
            $entityManager->flush();

            return $this->redirectToRoute('agence_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/agence/new.html.twig', [
            'agence' => $agence,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'agence_show', methods: ['GET'])]
    public function show(Agence $agence): Response
    {
        return $this->render('back/agence/show.html.twig', [
            'agence' => $agence,
        ]);
    }

    #[Route('/{id}/edit', name: 'agence_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Agence $agence, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AgenceType::class, $agence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('agence_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/agence/edit.html.twig', [
            'agence' => $agence,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'agence_delete', methods: ['POST'])]
    public function delete(Request $request, Agence $agence, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$agence->getId(), $request->request->get('_token'))) {
            $entityManager->remove($agence);
            $entityManager->flush();
        }

        return $this->redirectToRoute('agence_index', [], Response::HTTP_SEE_OTHER);
    }
}