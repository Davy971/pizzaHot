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
class CommandeController extends Controller
{
    /**
     * Lists all Commande entities.
     *
     * @Route("/", name="commande_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $commandes = $em->getRepository('OCPlatformBundle:Commande')->findAll();

        return $this->render('OCPlatformBundle:Commande:index.html.twig', array(
            'commandes' => $commandes,
        ));
    }

    /**
     * Creates a new commande entity.
     *
     * @Route("/new", name="commande_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $session = $request->getSession();
        $panier = $session->get('panier');
        $session->set('panier', array());
        $commande = new Commande();
        $commande->setUser($this->getUser());

        

        
        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('OCPlatformBundle:Produit')->findArray(array_keys($session->get('panier')));

        foreach($panier as $idproduit => $quantity)
        {
            
            $produit = $em->getRepository('OCPlatformBundle:Produit')->find($idproduit);
            
            
            for($i=0;$i<$quantity;$i++)
            {
                $comProd = new CommandeProduit();
                $comProd->setProduit($produit);
                $comProd->setCommande($commande);
                $comProd->setEtat(0);
                $commande->addCommandeProduit($comProd);
                $em->persist($comProd);
            }
            
        }

        $em->persist($commande);
        $em->flush();
        $em->refresh($commande);
        return $this->redirectToRoute('oc_pizzeria_commande_show', array('id' => $commande->getId()));
    }

  
    public function showAction(Commande $commande,$id)
    {
        $commande = $this->getDoctrine()->getRepository('OCPlatformBundle:Commande')->find($id);

        return $this->render('OCPlatformBundle:Commande:show.html.twig', array(
            'commande' => $commande,
        ));
    }

    /**
     * Displays a form to edit an existing Commande entity.
     *
     * @Route("/{id}/edit", name="commande_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Commande $commande)
    {
        $deleteForm = $this->createDeleteForm($commande);
        $editForm = $this->createForm('OC\PlatformBundle\Form\CommandeType', $commande);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commande_edit', array('id' => $commande->getId()));
        }

        return $this->render('OCPlatformBundle:Commande:edit.html.twig', array(
            'commande' => $commande,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a commande entity.
     *
     * @Route("/{id}", name="commande_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Commande $commande)
    {
        $form = $this->createDeleteForm($commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($commande);
            $em->flush();
        }

        return $this->redirectToRoute('commande_index');
    }

    /**
     * Creates a form to delete a commande entity.
     *
     * @param Commande $commande The commande entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Commande $commande)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('commande_delete', array('id' => $commande->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
  
   public function addToCommandeAction($idproduit)
   {
     $em = $this->getDoctrine()->getManager();
     $monCommande=$this->getDoctrine()->getRepository('OCPlatformBundle:Commande')->findOneByEtat(0);
     if ($monCommande == null)
     {
       $monCommande = new Commande();
     }
     //Creation d'une nouvelle entite produit du Commande
     $CommandeProduit = new CommandeProduit();
     //Récupération du produit
     $monProduit=$this->getDoctrine()->getRepository('OCPlatformBundle:Produit')->find($idproduit);
     //association du produit au produit du Commande
     $commandeProduit->setProduit($monProduit);
     //association du commande au produit du Commande
     $commandeProduit->setCommande($monCommande);
     $commandeProduit->setEtat(0);
     
     //association du produit du commande au commande
     $monCommande->addCommandeProduit($commandeProduit);
     
     //Envoie du commande créé a la bdd
     $em->persist($monCommande);
     $em->flush();
     return $this->redirectToRoute('oc_pizzeria_produit_view', array('id' => $idproduit));
   }
   
  
}
