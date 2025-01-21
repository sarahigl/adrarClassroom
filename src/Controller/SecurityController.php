<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\ReviewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils, ReviewRepository $reviewRepository): Response
    {
        
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        $reviews = $reviewRepository->findAll();
        // dump($reviews);
        
        
        if ($this->getUser()) {
            if ($this->isGranted('ROLE_ADMIN')) {
                return $this->redirectToRoute('admin'); 
            } elseif ($this->isGranted('ROLE_USER')) {
                return $this->redirectToRoute('user_dashboard');
            }
        }
        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'reviews' => $reviews, 
            'error' => $error,
        ]);
       
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(ReviewRepository $reviewRepository): Response
    {
        
        $reviews = $reviewRepository->findAll();
        // throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
        return $this->render('security/login.html.twig', [
            'reviews' => $reviews, 
        ]);
    }
    
}
