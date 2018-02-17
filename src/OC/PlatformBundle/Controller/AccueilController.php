<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AccueilController extends Controller
{
    public function menuAction()
      {
         $content = $this->get('templating')->render('OCPlatformBundle:Accueil:menu.html.twig');
         return new Response($content);

      }

      
    public function ingredientAction()
    {
      
    }  
   

}