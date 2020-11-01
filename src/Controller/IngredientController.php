<?php
    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\HttpFoundation\Request;

    use Symfony\Component\HttpFoundation\JsonResponse;
    use Doctrine\ODM\MongoDB\DocumentManager as DocumentManager;

    use App\Document\Ingredient;

    class IngredientController extends AbstractController
    {
         /**
         * @Route("/api/addIngredient")
         */  
        public function newIngredient(Request $request, DocumentManager $dm){
          $data = json_decode($request->getContent());
          
          $ingredient = new Ingredient();
          $ingredient->setName($data->name);
          $ingredient->setPrice($data->price);

          $dm->persist($ingredient);
          $dm->flush();
          return new JsonResponse(array('Status' => 'OK'));
        }

        public function getIngredients(DocumentManager $dm){
            $data = $dm->createQueryBuilder(Ingredient::class)
            ->hydrate(false)
            ->getQuery()
            ->execute()
            ->toArray();

            $response = new JsonResponse();
            $response->setContent(json_encode($data));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
          }

          public function deleteIngredient(Request $request, DocumentManager $dm){
            $id = json_decode($request->getContent())->id;
            $data = $dm->createQueryBuilder(Ingredient::class)
            ->field('id')->equals($id)
            ->remove()
            ->getQuery()
            ->execute();

            $response = new JsonResponse();
            $response->setContent(json_encode($data));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
          }
    }
