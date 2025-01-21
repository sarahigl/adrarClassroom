<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class UserController extends AbstractController
{
    #[Route('/user', name: 'user_dashboard')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    // public function configureMenuItems(): Response
    // {
    //     return $this->render('user/userDashboard.html.twig', [
    //         'controller_name' => 'HomeController',
    //     ]);
       
    // }

    #[Route('/courses', name: 'courses_list')]
    public function coursesList(): Response
    {
        return $this->render('course/index.html.twig');
    }
    #[Route('/chapters', name: 'chapters_list')]
    public function chaptersList(): Response
    {
        return $this->render('chapter/index.html.twig');
    }

}
