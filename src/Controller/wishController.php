<?php
namespace App\Controller;
use App\Entity\Wish;
use App\Form\WishFormType;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class wishController extends AbstractController
{
    private $titre = "Ma Bucket List";

    private $menu = [
        ["Home", 'app_home'],
        ["About Us", "app_about"],
        ["Add Wish", "app_add-wish"],
        ["Wish List", "app_list"],
        ["Contact", "app_contact"],
        ["Login", "app_login"],
        ["Register", "app_register"]
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
     * @param $id
     * @param WishRepository $repository
     * @return Response
     */
    public function detail($id,WishRepository $repository): Response
    {
        $wish=$repository->find($id);
        setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
       /*dd($w);*/
        return $this->render("wish/detail.html.twig",
            ["menu" => $this->menu,
                "dateCreated" => strftime("%A %e %B %Y"),
                "titre" => $this->titre,
                'wish'=>$wish,
            ]);

    }

    /**
     * @Route("/wish/add-wish", name="app_add-wish")
     */
    public function addWish(EntityManagerInterface $em, Request $request): Response
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
$wish=new Wish();
$wish->setAuthor($this->getUser()->getUserIdentifier());
$wishForm=$this->createForm(WishFormType::class, $wish);
$wishForm->handleRequest($request);

if($wishForm->isSubmitted()&&$wishForm->isValid()){
    //traitement
$em->persist($wish);
$em->flush();
//flashMessage :
    $this->addFlash('success', 'Votre wish a été créé avec succès !');
    return $this->redirectToRoute("app_detail", ['id'=>$wish->getId()]);
}
        return $this->render("wish/add.html.twig", ['wishForm'=>$wishForm->createView(),
            "menu" => $this->menu,
            "dateCreated" => strftime("%A %e %B %Y"),
            "titre" => $this->titre,
        ]);

    }
}