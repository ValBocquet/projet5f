<?php

namespace App\Controller;

use App\Entity\Datas;
use App\Entity\Users;
use App\Form\FileType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("register", name="register")
     */
    public function register(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        $user = new Users();

        $form = $this->createFormBuilder($user)
            ->add('pseudo')
            ->add('password', PasswordType::class)
            ->add('email')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setCreatedAt(new \DateTime());

            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('login.html.twig');
        }

        return $this->render('register.html.twig', [
            'formUser' => $form->createView()
        ]);
    }

    /**
     * @Route("login", name = "login")
     */

    public function login()
    {
        return $this->render('login.html.twig');

    }

    /**
     * @Route("deconnexion", name="logout")
     */

    public function logout()
    {

    }

    /**
     * @Route("upload", name="upload")
     */
    public function upload(Request $request) {
        $file = new Datas();
        $form = $this->createForm(FileType::class, $file);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $file->getNameFile();

            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

            // Move the file to the directory where brochures are stored
            try {
                $file->move(
                    $this->getParameter('upload_directory'),
                    $fileName
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }

            // updates the 'brochure' property to store the PDF file name
            // instead of its contents
            $file->setNameFile($fileName);

            // ... persist the $product variable or any other work

            return $this->redirect($this->generateUrl('upload'));
        }

        return $this->render('product/file.html.twig', [
            'form' => $form->createView(),
        ]);
    }


}
