<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Form\RegisterType;
Use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
class UserController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function index( AuthenticationUtils $authenticationUtils )
    {
        return $this->render('user/login.html.twig', [
            'lastUsername' => $authenticationUtils->getLastUsername()
        ]);
    }
    /**
     * @Route("/logout", name="logout")
     */
     public function logout(){}
     
}