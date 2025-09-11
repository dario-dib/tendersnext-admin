<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

class HomeRedirectController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(): RedirectResponse
    {
        return new RedirectResponse('/admin');
    }
}
