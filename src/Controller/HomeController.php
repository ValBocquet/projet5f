<?php

namespace App\Controller;

use App\Entity\Users;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig');
    }

    /**
     * @Route("register", name="register")
     */
    public function register(Request $request, ObjectManager $manager) {
        $user = new Users();

        $form = $this->createFormBuilder($user)
            ->add('pseudo')
            ->add('password')
            ->add('email')
            ->getForm();

        return $this->render('register.html.twig', [
           'formUser' => $form->createView()
        ]);
    }
}
