<?php

namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IngredientController extends Controller
{
    public function Liste_IngredientAction()
    {
        return $this->render('OCPlatformBundle:Ingredient:liste.html.twig');
    }
}
