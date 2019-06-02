<?php

namespace App\Controller;

use App\Entity\Users;
use App\Entity\Datas;
use App\Form\AvatarType;
use App\Form\uploadType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
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
}
