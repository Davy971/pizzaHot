<?php

namespace OC\PlatformBundle\Controller;

use OC\PlatformBundle\Entity\Commande;
use OC\PlatformBundle\Entity\CommandeProduit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Commande controller.
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
}
