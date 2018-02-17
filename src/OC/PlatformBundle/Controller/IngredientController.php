<?php

namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use OC\PlatformBundle\Entity\Ingredient;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;



class IngredientController extends Controller
{
    public function indexAction()
    {

    	$repository = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Ingredient');

    	$ingredients = $repository->findAll();

    	dump($ingredients);

        return $this->render('OCPlatformBundle:Ingredient:index.html.twig',array ('ingredients' => $ingredients, "toto" => 5));
    }

    public function addAction(Request $request)
    {
    	$ingredient = new Ingredient();
    	
    	$form= $this->get('form.factory')->createBuilder(FormType::class,$ingredient)
    		->add('name', TextType::class)
    		->add('save', SubmitType::class)
    		->getForm();

    	
    	if ($request->isMethod('POST')) {
    		$form->handleRequest($request);

    		$em = $this->getDoctrine()->getManager();
    		$em->persist($ingredient);
    		$em->flush();

    		return $this->redirectToRoute('oc_pizzeria_ingredient_index');

    	}


        return $this->render('OCPlatformBundle:Ingredient:add.html.twig',array('form'=>$form->createView(),));
    }

  public function editAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    $ingredient = $em->getRepository('OCPlatformBundle:Ingredient')->find($id);

    if (null === $ingredient) {
      throw new NotFoundHttpException("L'ingredient d'id ".$id." n'existe pas.");
    }

    $form= $this->get('form.factory')->createBuilder(FormType::class,$ingredient)
    		->add('name', TextType::class)
    		->add('save', SubmitType::class)
    		->getForm();

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre annonce
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Ingredient bien modifiée.');

      return $this->redirectToRoute('oc_pizzeria_ingredient_index', array('id' => $ingredient->getId()));
    }

    return $this->render('OCPlatformBundle:Ingredient:edit.html.twig', array(
      'ingredient' => $ingredient,
      'form'   => $form->createView(),
    ));
  }





}
