<?php
    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\HttpFoundation\Request;

    use Symfony\Component\HttpFoundation\JsonResponse;
    use Doctrine\ODM\MongoDB\DocumentManager as DocumentManager;

    use App\Document\Pizza;
    use App\Document\Ingredient;

    class PizzaController extends AbstractController
    {
         
        public function newPizza(Request $request, DocumentManager $dm){
          $data = json_decode($request->getContent());
          
          $pizza = new Pizza();
          $pizza->setName($data->name);
          $pizza->setPrice($data->price);

          //TODO: ADD THE INGREDIENTS TO THE PIZZA
          
          $dm->persist($pizza);
          $dm->flush();
          return new JsonResponse(array('Status' => 'OK'));
        }

    }
