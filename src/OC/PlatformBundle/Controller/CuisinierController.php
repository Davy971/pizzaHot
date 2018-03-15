<?php

namespace OC\PlatformBundle\Controller;

use OC\PlatformBundle\Entity\Commande;
use OC\PlatformBundle\Entity\CommandeProduit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Cuisinier controller.
 *
 * @Route("commande")
 */
class CuisinierController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $commandes = $em->getRepository('OCPlatformBundle:Commande')->findBy(array('etat'=>0));

        return $this->render('OCPlatformBundle:Cuisinier:index.html.twig', array(
            'commandes' => $commandes,
        ));
    }
  

    public function selectAction($idCommande)
    {
        $comProd = $this -> getDoctrine()
        -> getRepository('OCPlatformBundle:CommandeProduit')-> findBy(array('commande' =>$idCommande, 'etat' =>0));

        return $this->render('OCPlatformBundle:Cuisinier:listprod.html.twig', array(
            'comProd' => $comProd,
        ));
    }
	
	public function preparAction($id)
	{
		$comprod = $this->getDoctrine()->getRepository('OCPlatformBundle:CommandeProduit')->find($id);
		$comProd->setEtat(1);
		return $this->render('OCPlatformBundle:Cuisinier:prepar.html.twig', array(
            'comProd' => $comProd,
        ));
	}
	
	public function finAction($idComProd)
	{
		$comprod = $this->getDoctrine()->getRepository('OCPlatformBundle:CommandeProduit')->find($idComProd);
		$comProd->setEtat(2);
		$boo = 0;
		$commande = $comprod.commande;
		foreach($commande.produit as prod)
		{
			if(prod.etat != 2)
				$boo = -1;
		}
		if($boo == 0)
			$commande->setEtat(2);
		
		return $this->redirectToRoute('oc_pizzeria_cuisinier_index');
	}
}
