<?php

namespace OC\PlatformBundle\Controller;

use OC\PlatformBundle\Entity\Panier;
use OC\PlatformBundle\Entity\PanierProduit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Panier controller.
 *
 * @Route("panier")
 */
class PanierController extends Controller
{
    /**
     * Lists all panier entities.
     *
     * @Route("/", name="panier_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $paniers = $em->getRepository('OCPlatformBundle:Panier')->findAll();

        return $this->render('OCPlatformBundle:Panier:index.html.twig', array(
            'paniers' => $paniers,
        ));
    }

    /**
     * Creates a new panier entity.
     *
     * @Route("/new", name="panier_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $panier = new Panier();
        $form = $this->createForm('OC\PlatformBundle\Form\PanierType', $panier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($panier);
            $em->flush();

            return $this->redirectToRoute('panier_show', array('id' => $panier->getId()));
        }

        return $this->render('OCPlatformBundle:Panier:new.html.twig', array(
            'panier' => $panier,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a panier entity.
     *
     * @Route("/{id}", name="panier_show")
     * @Method("GET")
     */
    public function showAction(Panier $panier)
    {
        $deleteForm = $this->createDeleteForm($panier);

        return $this->render('OCPlatformBundle:Panier:show.html.twig', array(
            'panier' => $panier,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing panier entity.
     *
     * @Route("/{id}/edit", name="panier_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Panier $panier)
    {
        $deleteForm = $this->createDeleteForm($panier);
        $editForm = $this->createForm('OC\PlatformBundle\Form\PanierType', $panier);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('panier_edit', array('id' => $panier->getId()));
        }

        return $this->render('OCPlatformBundle:Panier:edit.html.twig', array(
            'panier' => $panier,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a panier entity.
     *
     * @Route("/{id}", name="panier_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Panier $panier)
    {
        $form = $this->createDeleteForm($panier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($panier);
            $em->flush();
        }

        return $this->redirectToRoute('panier_index');
    }

    /**
     * Creates a form to delete a panier entity.
     *
     * @param Panier $panier The panier entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Panier $panier)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('panier_delete', array('id' => $panier->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
  
   public function addToPanierAction($idproduit)
   {
     $em = $this->getDoctrine()->getManager();
     $monPanier=$this->getDoctrine()->getRepository('OCPlatformBundle:Panier')->findOneByEtat(0);
     if ($monPanier == null)
     {
       $monPanier = new Panier();
     }
     //Creation d'une nouvelle entite produit du panier
     $panierProduit = new PanierProduit();
     //Récupération du produit
     $monProduit=$this->getDoctrine()->getRepository('OCPlatformBundle:Produit')->find($idproduit);
     //association du produit au produit du panier
     $panierProduit->setProduit($monProduit);
     //association du panier au produit du panier
     $panierProduit->setPanier($monPanier);
     $panierProduit->setEtat(0);
     
     //association du produit du panier au panier
     $monPanier->addPanierProduit($panierProduit);
     
     //Envoie du panier créé a la bdd
     $em->persist($monPanier);
     $em->flush();
     return $this->redirectToRoute('oc_pizzeria_produit_view', array('id' => $idproduit));
   }
   
  
}
