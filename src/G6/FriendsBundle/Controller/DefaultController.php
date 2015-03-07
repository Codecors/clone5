<?php

namespace G6\FriendsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use G6\FriendsBundle\Helper\CommonMethods;

class DefaultController extends Controller {

    public function indexAction() {
        $sessionUser = CommonMethods::getSession();
        if (isset($sessionUser['username'])) {
            return $this->redirect($this->generateUrl('g6_friends_user', array('name' => $sessionUser['username'])));
        }
        return $this->render('G6FriendsBundle:Default:index.html.twig');
    }

    public function wallAction() {
        $sessionUser = CommonMethods::getSession();
        if (isset($sessionUser['username']) == 0) {
            return $this->redirect($this->generateUrl('g6_friends_login'));
        }

        $postRepository = $this->getDoctrine()->getRepository('G6FriendsBundle:Post');
        $posts = $postRepository->findBy(array(),array('postDate' => 'DESC'));

        $userPosts = CommonMethods::postsToArray($posts);

        return $this->render('G6FriendsBundle:Default:wall.html.twig', array('allposts' => $userPosts,'name'=>$sessionUser['name']));
    }

}
