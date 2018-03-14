<?php

namespace OC\PlatformBundle\Controller;

use OC\PlatformBundle\Entity\Commande;
use OC\PlatformBundle\Entity\CommandeProduit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Livreur controller.
 *
 * @Route("commande")
 */
class CuisinierController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $commandes = $em->getRepository('OCPlatformBundle:Commande')->findBy(array('etat'=>2));

        return $this->render('OCPlatformBundle:Livreur:index.html.twig', array(
            'commandes' => $commandes,
        ));
    }
	
	
}
