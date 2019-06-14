<?php

namespace App\Controller;

use App\Entity\Datas;
use App\Entity\Users;
use App\Form\UploadsFileType;
use App\Repository\UsersRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class HomeController extends AbstractController
{


    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, TokenStorageInterface $storage, UsersRepository $repository, ObjectManager $manager)
    {
        $user = $storage->getToken()->getUser();


        // GESTION DE L'UPLOAD

        // création de me formulaire

        $datas = new Datas();

        // je récupère l'id de l'user connecté

        $message = "";
        $etat = "";

        $userId = $storage->getToken()->getUser();
        $form = $this->createFormBuilder($datas)
            ->add('NameFile', FileType::class)
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() &&$form->isValid()) {
            $myFile = $form->get('NameFile')->getData();


            // récupération en db de la taille pour l'user actuel
            // ensuite on vérifie si la taille actuelle + taille du fichier <=100 mo

            $repositoryUser = $this->getDoctrine()->getRepository(Users::class);
            $totalSizeUser = $repositoryUser->findOneBy(
                ['sizeUpload' => $user->getSizeUpload()]
            );

            // $totalSizeUser->getSizeUpload() --> taille total actuelle

            // $myFile->getSize()); taille du fichier en cours d'upload

            if(($totalSizeUser->getSizeUpload() + $myFile->getSize()) > 1000000) {
                // impossible d'uploader et redirection
                $message = "Vous dépassez les 100 mo autorisés. ";
                $etat = 'alert-danger';

            } else {
                // je peux uploader car ça ne dépasse pas les 100 mo
                // $fileName = md5(uniqid()).'.'.$myFile->guessExtension();

                if(!preg_match('/^[a-zA-Z]+[a-zA-Z0-9._-]+$/', $myFile->getClientOriginalName())) {
                    $message = "Le nom du fichier ne doit pas contenir de caractères spéciaux.";
                    $etat = "alert-warning";
                } else {
                    $fileName = time() . '_' . $myFile->getClientOriginalName();

                    // $fileName = $myFile->getClientOriginalName().'_'. time(). $myFile->guessExtension();

                    $myFile->move($this->getParameter('upload_directory'), $fileName);

                    $datas->setNameFile($fileName);
                    $datas->setIdUser($userId);
                    $datas->setSizeFile(filesize('upload/'.$fileName));
                    $datas->setCreateAt(new \DateTime());

                    if($userId->getSizeUpload() != null) {
                        $userId->setSizeUpload($userId->getSizeUpload() + filesize('upload/'.$fileName));
                    }
                    else {
                        $userId->setSizeUpload(filesize('upload/'.$fileName));
                    }

                    // $message = "Fichier bien uploadé ! ";
                    $etat = 'alert-success';

                    $manager->persist($userId);
                    $manager->persist($datas);
                    $manager->flush();
                }

            }

        }



        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
            'message' => $message,
            'etat' => $etat
        ]);

    }

    /**
     * @Route("user_files", name="userFiles")
     */
    public function displayFilesByUser(TokenStorageInterface $storage) {
        $i = 0;
        $countSize = 0;
        $userId = $storage->getToken()->getUser();
        $myUploads = $this->getDoctrine()
            ->getRepository(Datas::class)
            ->findBy(
                ['idUser' => $userId],
                ['create_at' => 'DESC']
            );

        /*for($i=0; $i<count($myUploads); $i++) {
            $countSize = $countSize + $myUploads[$i]->getSizeFile();
        }

        $maxUploadSize = 100000;
        $SizeAllUpload = $countSize / $maxUploadSize;
        $SizeAllUpload = round($SizeAllUpload, 2);

*/
        $sizeUpload = $userId->getSizeUpload() / 1000000;
        $sizeUpload = substr($sizeUpload, 0, 3);

        return $this->render('user/uploads.html.twig', [
            'myUploads' => $myUploads,
            'sizeUpload' => $sizeUpload
        ]);



    }

    /**
     * @Route("user_delete/{id}", name="user_delete")
     */
    public function deleteFile($id, EntityManagerInterface $manager) {
        $user = $this->getUser();

        // je récupère les informations du fichier à supprimer
        $repository = $this->getDoctrine()->getRepository(Datas::class);
        $fileToDelete = $repository->find($id);

        // je soustrais le poids du fichier à supprimer dans la table user


        $repositoryUser = $this->getDoctrine()->getRepository(Users::class);
        $totalSizeUser = $repositoryUser->findOneBy(
            ['sizeUpload' => $user->getSizeUpload()]
        );

        $newSizeUser = $totalSizeUser->getSizeUpload() - $fileToDelete->getSizeFile();

        if ($newSizeUser < 0) {
            $newSizeUser = 0;
        }

        $sizeFinal = $user->setSizeUpload($newSizeUser);

        $manager->persist($sizeFinal);
        $manager->flush();


        // je supprime le fichier du server

        $fileSystem = new Filesystem();
        $fileSystem->remove('upload/'.$fileToDelete->getNameFile());

        // je supprime le fichier en db

        $manager->remove($fileToDelete);
        $manager->flush();

        return $this->redirectToRoute('home');

    }
}
