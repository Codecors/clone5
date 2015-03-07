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
        $sessionUser = CommonMethods::getSession();
        $post = null;
        $error = 0;
        $errorMsg = '';
        $success = 0;
        if (isset($sessionUser['username']) == 0) {
            return $this->redirect($this->generateUrl('g6_friends_login'));
        }
        if ($request->getMethod() == 'POST') {
            $newPostContent = $request->request->all();

            $post = new \G6\FriendsBundle\Entity\Post();
            $post->setLikes(0);
            $post->setPostContent($newPostContent['post_content']);
            $post->setPostDate(date_create(date('Y-m-d H:i:s')));
            $post->setUser(CommonMethods::getUserByUsername($sessionUser['username'], $this));


            $em = $this->getDoctrine()->getManager();

            $em->persist($post);
            $em->flush();
            $success = 1;
        }
        return $this->render('G6FriendsBundle:Post:newpost.html.twig', array('data' => $post, 'error' => $error, 'errorMsg' => $errorMsg, 'success' => $success, 'name' => $sessionUser['name']));
    }

    public function viewAction($postId, Request $request) {
        $sessionUser = CommonMethods::getSession();

        if (isset($sessionUser['username']) == 0) {
            return $this->redirect($this->generateUrl('g6_friends_login'));
        }

        $error = 0;
        $errorMsg = '';
        $success = 0;

        if ($request->getMethod() == 'POST') {
            $postParameters = $request->request->all();

            if (isset($postParameters['comment'])) {
                $comment = new \G6\FriendsBundle\Entity\Comment();
                $comment->setLikes(0);
                $comment->setContent($postParameters['comment']);
                $comment->setCommentDate(date_create(date('Y-m-d H:i:s')));
                $comment->setUser(CommonMethods::getUserByUsername($sessionUser['username'], $this));
                $comment->setPost(CommonMethods::getPostByID($postId, $this));

                $em = $this->getDoctrine()->getManager();

                $em->persist($comment);
                $em->flush();
                $success = 1;
            }
            
            if (isset($postParameters['like'])) {
                $post = CommonMethods::getPostByID($postId, $this);
                $post->setLikes($post->getLikes() + 1 );
                
                $em = $this->getDoctrine()->getManager();

                $em->persist($post);
                $em->flush();
                $success = 1;
            }
        }

        $postRepository = $this->getDoctrine()->getRepository('G6FriendsBundle:Post');
        $postObject = $postRepository->findOneByPostId($postId);
        $post = CommonMethods::postObjectToArray($postObject);
        return $this->render('G6FriendsBundle:Post:viewpost.html.twig', array('req' => $request->request->all(), 'post' => $post, 'error' => $error, 'errorMsg' => $errorMsg, 'success' => $success, 'name' => $sessionUser['name']));
    }

}
