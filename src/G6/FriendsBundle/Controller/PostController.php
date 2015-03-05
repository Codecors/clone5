<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 * @author Mirage
 */

namespace G6\FriendsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use G6\FriendsBundle\Helper\CommonMethods;

class PostController extends Controller {

    public function newAction(Request $request) {
        $sessionUser = CommonMethods::getSession('username');
        $post = null;
        $error = 0;
        $errorMsg = '';
        $success = 0;
        if (isset($sessionUser) == 0) {
            return $this->redirect('../login');
        }
        if ($request->getMethod() == 'POST') {
            $newPostContent = $request->request->all();

            $post = new \G6\FriendsBundle\Entity\Post();
            $post->setLikes(0);
            $post->setPostContent($newPostContent['post_content']);
            $post->setPostDate(date_create(date('Y-m-d H:i:s')));
            $post->setUser(CommonMethods::getUserByUsername($sessionUser, $this));


            $em = $this->getDoctrine()->getManager();

            $em->persist($post);
            $em->flush();
        }
        return $this->render('G6FriendsBundle:Post:newpost.html.twig', array('data' => $post, 'error' => $error, 'errorMsg' => $errorMsg, 'success' => $success));
    }

}
