<?php

namespace App\Controller;

use App\Services\HomeService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private HomeService $homeService;

    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    /**
     * @throws Exception
     */
    #[Route('/', name: 'app_home')]
    public function index(Request $request): Response
    {
        $responseDTO = $this->homeService->sendSale($request, $request->getClientIp());
        return $this->render('home/index.html.twig', $responseDTO->serialize());
    }
}
