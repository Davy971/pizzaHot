<?php
namespace OC\PlatformBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
class PanierController extends Controller
{
    public function menuAction(Request $request)
    {
        $session = $request->getSession();
        if (!$session->has('panier'))
            $articles = 0;
        else
            $articles = count($session->get('panier'));
        
        return $this->render('OCPlatformBundle:Panier:menu.html.twig', array('articles' => $articles));
    }
    
    public function supprimerAction($id, Request $request)
    {
        $session = $request->getSession();
        $panier = $session->get('panier');
        
        if (array_key_exists($id, $panier))
        {
            unset($panier[$id]);
            $session->set('panier',$panier);
            $this->addFlash('success','Article supprimé avec succès');
        }
        
        return $this->redirect($this->generateUrl('oc_pizzeria_panier_index')); 
    }
    
    public function ajouterAction($id,Request $request)
    {
        $session = $request->getSession();
        
        if (!$session->has('panier')) $session->set('panier',array());
        $panier = $session->get('panier');
        
        if (array_key_exists($id, $panier)) {
            if ($request->query->get('qte') != null) $panier[$id] = $request->query->get('qte');
            $this->addFlash('success','Quantité modifié avec succès');
        } else {
            if ($request->query->get('qte') != null)
                $panier[$id] = $request->query->get('qte');
            else
                $panier[$id] = 1;
            
           $this->addFlash('success','Article ajouté avec succès');
        }
            
        $session->set('panier',$panier);
        
        
        return $this->redirect($this->generateUrl('oc_pizzeria_panier_index'));
    }
    
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        if (!$session->has('panier')) $session->set('panier', array());
        
        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('OCPlatformBundle:Produit')->findArray(array_keys($session->get('panier')));
        
        return $this->render('OCPlatformBundle:Panier:index.html.twig', array('produits' => $produits,
                                                                                             'panier' => $session->get('panier')));
    }


     public function validationAction()
    {
        return $this->render('OCPlatformBundle:Panier:validation.html.twig');
    }

}