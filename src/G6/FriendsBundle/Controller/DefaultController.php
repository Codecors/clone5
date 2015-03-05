<?php

namespace G6\FriendsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('G6FriendsBundle:Default:index.html.twig');
    }
}
