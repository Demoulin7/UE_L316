<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Actualite;
use App\Entity\Commentaire;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\Admin\UserCrudController;
use App\Controller\Admin\ActualiteCrudController;
use App\Controller\Admin\CommentaireCrudController;

class adminController extends AbstractDashboardController
{
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    )   {    
    }
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        //demande si le compte à le role admin.
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');
        $url = $this->adminUrlGenerator
        ->setController(UserCrudController::class)
        ->setController(ActualiteCrudController::class)
        ->setController(CommentaireCrudController::class)
        ->generateUrl();

        // return $this->redirect($url);

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('UE L316');
    }

    public function configureMenuItems(): iterable
    {
        //yield MenuItem::linktoRoute('retourne sur le site web', 'fas fa-home', 'homepage');
        yield MenuItem::linkToCrud('Actualite', 'fas fa-list', Actualite::class);
        yield MenuItem::linkToCrud('Commentaire', 'fas fa-list', Commentaire::class);
        yield MenuItem::linkToCrud('Utilisateur', 'fas fa-list', User::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
