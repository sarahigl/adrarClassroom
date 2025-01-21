<?php

namespace App\Controller\Admin;

use App\Controller\CourseController;
use App\Controller\HomeController;
use App\Entity\Chapter;
use App\Entity\Course;
use App\Entity\Review;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Menu\MenuItemInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());
        
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Adrar Classroom');
    }

    public function configureMenuItems(): iterable
    {
        
        yield MenuItem::linkToDashboard('Utilisateurs', 'fa-solid fa-user')->setPermission('ROLE_ADMIN');
        
        yield MenuItem::linkToCrud('Cours', 'fa-solid fa-cube', Course::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Avis', 'fa-solid fa-comment-nodes',Review::class)->setPermission('ROLE_ADMIN');
        //ajouter regroupement chap 1, chap 2 
        yield MenuItem::linkToCrud('Chapitres', 'fa-solid fa-cubes',Chapter::class)->setPermission('ROLE_ADMIN');
        
        // yield MenuItem::linkToLogout('Logout','fas fa-sign-out-alt');
        // yield MenuItem::linkToRoute('Accueil', 'fa-solid fa-cube','home')->setPermission('ROLE_USER');
        
    }
   
}
