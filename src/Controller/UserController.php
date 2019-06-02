<?php

namespace App\Controller;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserController
 * @package App\Controller
 */
class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index(EntityManagerInterface $entityManager, Request $request, UsersRepository $repository) : Response {
        $form = $this->createFormBuilder()
            ->add('avatar_img', FileType::class)
            ->getForm();
        $form->handleRequest($request);

        $user = $this->getUser();

        if ($form->isSubmitted() && $form->isValid()) {
            if($user->getAvatar() !== null) {
                /* on peut ajouter un avatar */
                $file = $user->getAvatar();
                $user->setAvatar($file);
            }

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('home');

        }
        return $this->render('user/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }


}
