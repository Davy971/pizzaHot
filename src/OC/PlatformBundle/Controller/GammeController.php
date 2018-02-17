<?php



namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use OC\PlatformBundle\Entity\Ingredient;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class GammeController extends Controller
{
    public function ajouterAction()
      {
        $gamme = new Gamme();
    	
    	$form= $this->get('form.factory')->createBuilder(FormType::class,$gamme)
    		->add('name', TextType::class)
    		->add('save', SubmitType::class)
    		->getForm();

    	
    	if ($request->isMethod('POST')) {
    		$form->handleRequest($request);

    		$em = $this->getDoctrine()->getManager();
    		$em->persist($gamme);
    		$em->flush();

    		return $this->redirectToRoute('oc_pizzeria_gamme_index');
      }
      public function supprimerAction()
      {

      }
      public function updateAction()
      {

      }

      public function indexAction()
	  {
		$repository = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Gamme');

    	$gammes = $repository->findAll();

    	dump($gammes);

        return $this->render('OCPlatformBundle:Gamme:index.html.twig',array ('gammes' => $gammes);
	  }

   

}