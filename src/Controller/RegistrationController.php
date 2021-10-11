<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{

    private $menu = [
        ["Home", 'app_home'],
        ["About Us", "app_about"],
        ["Add Wish", "app_add-wish"],
        ["Wish List", "app_list"],
        ["Contact", "app_contact"],
        ["Login", "app_login"],
        ["Register", "app_register"]
    ];
    private$titre="Ma Bucket List";
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasherInterface): Response
    {

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
            $userPasswordHasherInterface->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_home',[

                "menu" => $this->menu,
                "titre" => $this->titre,]);
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            "menu" => $this->menu,
            "titre" => $this->titre,
        ]);
    }
}
