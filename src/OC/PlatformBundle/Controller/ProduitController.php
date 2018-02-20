<?php


namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use OC\PlatformBundle\Entity\Produit;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class ProduitController extends Controller
{
    public function indexAction()
    {

    	$repository = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Produit');

    	$produits = $repository->findAll();

    	dump($produits);

        return $this->render('OCPlatformBundle:Produit:index.html.twig',array ('produits' => $produits));
    }

    public function addAction(Request $request)
    {
    	$produit = new Produit();
    	
    	$form= $this->get('form.factory')->createBuilder(FormType::class,$produit)
    		->add('name', TextType::class)
        ->add('prix', MoneyType::class)
        ->add('gamme', EntityType::class, array(
           'class'        => 'OCPlatformBundle:Gamme',
           'choice_label' => 'name'))
        ->add('ingredients', EntityType::class, array(
           'class'        => 'OCPlatformBundle:Ingredient',
           'choice_label' => 'name',
           'multiple'     => true,
           'expanded'     => true))
        ->add('save', SubmitType::class)
    		->getForm();

    	
    	if ($request->isMethod('POST')) {
    		$form->handleRequest($request);

    		$em = $this->getDoctrine()->getManager();
    		$em->persist($produit);
    		$em->flush();

    		return $this->redirectToRoute('oc_pizzeria_produit_index');

    	}


        return $this->render('OCPlatformBundle:Produit:add.html.twig',array('form'=>$form->createView(),));
    }

  public function editAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    $produit = $em->getRepository('OCPlatformBundle:Produit')->find($id);

    if (null === $produit) {
      throw new NotFoundHttpException("Le produit d'id ".$id." n'existe pas.");
    }

    $form= $this->get('form.factory')->createBuilder(FormType::class,$produit)
    		->add('name', TextType::class)
        ->add('prix', MoneyType::class)
        ->add('gamme', EntityType::class, array(
           'class'        => 'OCPlatformBundle:Gamme',
           'choice_label' => 'name'))
        ->add('ingredients', EntityType::class, array(
           'class'        => 'OCPlatformBundle:Ingredient',
           'choice_label' => 'name',
           'multiple'     => true,
           'expanded'     => true))
    		->add('save', SubmitType::class)
    		->getForm();

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre annonce
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Produit bien modifiée.');

      return $this->redirectToRoute('oc_pizzeria_produit_index', array('id' => $produit->getId()));
    }

    return $this->render('OCPlatformBundle:Produit:edit.html.twig', array(
      'produit' => $produit,
      'form'   => $form->createView(),
    ));
  }

}
