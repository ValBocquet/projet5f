<?php

namespace App\Controller;

use App\Entity\Users;
<<<<<<< HEAD
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
=======
use App\Entity\Datas;
use App\Form\AvatarType;
use App\Form\uploadType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
>>>>>>> fa57747406fc63ff7a38592b9a2eb242ff2a788a

/**
 * Class UserController
 * @package App\Controller
 */
class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
<<<<<<< HEAD
    public function index(EntityManagerInterface $entityManager, Request $request, UsersRepository $repository, UserPasswordEncoderInterface $encoder) : Response {
        $form = $this->createFormBuilder()
            ->add('avatar_img', FileType::class)
            ->getForm();
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {


            $user = $this->getUser();

            $file = $form->get('avatar_img')->getData();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('upload_directory'), $fileName);


            // Move the file to the directory where brochures are stored

            $user->setAvatar($fileName);
            /* on peut ajouter un avatar */

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('home');

        }

        $formPass = $this->createFormBuilder()
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe doivent être identiques.',
                'options' => ['attr' => ['class' => 'form-control']],
                'required' => true,
                'first_options' => ['label' => 'Mot de passe :'],
                'second_options' => ['label' => 'Confirmez le mot de passe :'],
            ])
            ->getForm();

        $formPass->handleRequest($request);

        if($formPass->isSubmitted() && $formPass->isValid()) {
            $user = $this->getUser();
            $pass = $formPass->get('password')->getData();


            $hash = $encoder->encodePassword($user, $pass);

            $user->setPassword($hash);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }


        return $this->render('user/index.html.twig', [
            'form' => $form->createView(),
            'formPass' => $formPass->createView()
        ]);
    }


=======
    public function index() {

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);

    }

    /**
     * @Route("/user/avatar", name="user_avatar")
     */
    public function avatar(Request $request)
    {
        return $this->render('user/index.html.twig');
    }
>>>>>>> fa57747406fc63ff7a38592b9a2eb242ff2a788a
}
