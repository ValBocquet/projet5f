<?php

namespace App\Controller;

use App\Entity\Datas;
use App\Entity\Users;
use App\Form\UploadsFileType;
use App\Repository\UsersRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Security\Core\User\UserInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, UserInterface $user, UsersRepository $repository, ObjectManager $manager)
    {
        // GESTION DE L'UPLOAD

        // création de me formulaire

        $datas = new Datas();

        // je récupère l'id de l'user connecté
        $userId = $this->getUser();
        $form = $this->createFormBuilder($datas)
            ->add('NameFile', FileType::class)
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() &&$form->isValid()) {
            $myFile = $form->get('NameFile')->getData();

            $fileName = md5(uniqid()).'.'.$myFile->guessExtension();
            $myFile->move($this->getParameter('upload_directory'), $fileName);

            $datas->setNameFile($fileName);
            $datas->setIdUser($userId);
            $datas->setSizeFile(filesize('upload/'.$fileName));
            $datas->setCreateAt(new \DateTime());

            $manager->persist($datas);
            $manager->flush();
        }



        return $this->render('home/index.html.twig', [
            'form' => $form->createView()
        ]);

    }
}
