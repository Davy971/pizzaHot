<?php



namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use OC\PlatformBundle\Entity\Gamme;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class GammeController extends Controller
{
    public function addAction(Request $request)
	
    {
      $gamme = new Gamme();
    	
    	$form= $this->get('form.factory')->createBuilder(FormType::class,$gamme)//Création du formulaire.
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
			return $this->render('OCPlatformBundle:Gamme:add.html.twig',array('form'=>$form->createView(),));
	}
      public function supprimerAction()
      {

      }
	  
	  
	  
      public function editAction($id, Request $request)
      {
		  

	  
		$em = $this->getDoctrine()->getManager();

		$gamme = $em->getRepository('OCPlatformBundle:Gamme')->find($id);

		if (null === $ingredient) {
			throw new NotFoundHttpException("La gamme d'id ".$id." n'existe pas.");
		}

		$form= $this->get('form.factory')->createBuilder(FormType::class,$gamme)
    		->add('name', TextType::class)
    		->add('save', SubmitType::class)
    		->getForm();

		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
			// Inutile de persister ici, Doctrine connait déjà notre annonce
			$em->flush();

			$request->getSession()->getFlashBag()->add('notice', 'Gamme bien modifiée.');

			return $this->redirectToRoute('oc_pizzeria_gamme_index', array('id' => $gamme->getId()));
		}

		return $this->render('OCPlatformBundle:Gamme:edit.html.twig', array(
		'gamme' => $gamme,
		'form'   => $form->createView(),
		));
    }

      public function indexAction()
	  {
		$repository = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Gamme');

    $gammes = $repository->findAll();

    dump($gammes);

    return $this->render('OCPlatformBundle:Gamme:index.html.twig',array ('gammes' => $gammes));
	  }

   

}