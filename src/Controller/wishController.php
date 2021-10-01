<?php
namespace App\Controller;
use App\Entity\Wish;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class wishController extends AbstractController
{
    private $titre = "Ma Bucket List";

    private $menu = [
        ["Home", 'app_home'],
        ["About Us", "app_about"],
        ["Blog", ""],
        ["Wish List", "app_list"],
        ["Contact", "app_contact"],
        ["Login", ""],
        ["Register", ""]
    ];

    /**
     * @Route("/wish/list", name="app_list")
     */
    public function list(WishRepository $wrepo, $id=0): Response
    {

        $wishes = $wrepo->findBy(["isPublished"=>true],["dateCreated"=>"asc"]);

      /*dd($wishes);*/


        return $this->render("wish/wish.html.twig",
            [   "menu" => $this->menu,
                "wishes" => $wishes,
                "titre" => $this->titre,
            ]);
    }

    /**
     * @Route("/wish/detail/{id}", name="app_detail")
     */
    public function detail(Wish $w): Response
    {
        setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
       /*dd($w);*/
        return $this->render("wish/detail.html.twig",
            ["menu" => $this->menu,
                "dateCreated" => strftime("%A %e %B %Y"),
                "titre" => $this->titre,
                'wish'=>$w
            ]);

    }

    /**
     * @Route("/wish/addwish", name="app_addwish")
     */
    public function addWish(EntityManagerInterface $em): Response
    {
       /* $w1 = new Wish();
        $w1->setTitle("Creuser un trou")
            ->setAuthor("DeliciousGnome");
        $w2 = new Wish();
        $w2->setTitle("Manger de la terre")
            ->setAuthor("DisgustingGnome");
        $w3 = new Wish();
        $w3->setTitle("Coudre des champignons")
            ->setAuthor("PeculiarGnome");

        $em->persist($w1);
        $em->persist($w2);
        $em->persist($w3);

        $em->flush();*/

        return $this->redirectToRoute("app_list");

    }
}