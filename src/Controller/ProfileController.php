<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfileController extends AbstractController
{
    /**
     * @Route("/", name="app_profile")
     * @Security("is_granted('ROLE_USER')", message="Vous n'avez pas accès à cette ressource")
     * 
     */
    public function index(UserRepository $userRepo): Response
    {
        
        return $this->render('profile/index.html.twig', [
            'user' => $userRepo->findOneBy(array('id' => $this->getUser())),
        ]);
    }
}
