<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AccueilController extends Controller
{
    public function indexAction(){
      return $this->render('OCPlatformBundle:Accueil:index.html.twig');
    }

}