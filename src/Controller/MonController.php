<?php

namespace App\Controller;


use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MonController extends AbstractController
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
     * @Route("/home", name="app_home")
     */
    public function home(): Response
    {

        setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
        return $this->render("main/index.html.twig",
            [
                "titre" => $this->titre,
                "date_now" => strftime("%A %e %B %Y"),
                "menu" => $this ->menu,
            ]
        );
    }

    /**
     * @Route("/contact", name="app_contact")
     */
    public function contact(): Response
    {

        setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
        return $this->render("contact/index.html.twig",
            [
                "titre" => $this->titre,
                "menu" => $this->menu,
            ]
        );
    }

    /**
     * @Route("/about", name="app_about")
     */
    public function aboutUs(): Response
    {

        return $this->render("about/aboutUs.html.twig",
            [
                "titre" => $this->titre,
                "menu" => $this->menu,
            ]
        );


    }

    /**
     * @Route("/legal-stuff", name="app_legal")
     */
    public function legal(): Response
    {
        $titre="Bucket List - Mentions Légales";
     /*   $tab=compact($titre);*/
        return $this->render("main/legal-stuff.html.twig",

            [
                "titre" => $this->titre,
                "menu" => $this->menu,
            ]
        );


    }
}
