<?php
    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\HttpFoundation\Request;

    use Symfony\Component\HttpFoundation\JsonResponse;
    use Doctrine\ODM\MongoDB\DocumentManager as DocumentManager;

    use App\Document\Pizza;
    use App\Document\Ingredient;

    class HomeController extends AbstractController
    {
         /**
         * @Route("/")
         */
        public function index(DocumentManager $dm)
        {
          // $this->newIngredient($dm);
          return $this->render('index.html.twig');
        }

        public function newPizza(DocumentManager $dm){
          $pizza = new Pizza();
          $pizza->setName("pizza test");
          $pizza->setPrice(15.5);

          $dm->persist($pizza);
          $dm->flush();
          return new JsonResponse(array('Status' => 'OK'));
        }
        
    }
