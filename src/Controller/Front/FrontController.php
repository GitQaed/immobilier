<?php

namespace App\Controller\Front;

use App\Repository\AgenceRepository;
use App\Repository\EmployeRepository;
use App\Repository\LogementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    #[Route('/', name: 'front')]
    public function index(LogementRepository $logementRepository, AgenceRepository $agenceRepository, EmployeRepository $employeRepository): Response
    {
            $logements = $logementRepository->findAll();
            $employes = $employeRepository->findAll();
            $agences = $agenceRepository->findAll();

        // je souhaite recuperer tous les logements tous les employés et les agences

        return $this->render('front/index.html.twig',[
            "logements" => $logements,
            "agences" => $agences,
            "employes" => $employes
        ]);
    }
}