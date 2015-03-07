<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CommonMethods
 *
 * @author Mirage
 */

namespace G6\FriendsBundle\Helper;

use Symfony\Component\HttpFoundation\Session\Session;

class CommonMethods {

    static function validateLogin($requestData) {
        return (isset($requestData['username']) && isset($requestData['password']));
    }

    static function validateRegister($requestData) {
        return (isset($requestData['username']) &&
                isset($requestData['password']) &&
                isset($requestData['repassword']) &&
                isset($requestData['birthdate']) &&
                isset($requestData['firstname']) &&
                isset($requestData['lastname']) &&
                isset($requestData['gender']));
    }

    static function validateUpdate($requestData) {
        return (isset($requestData['birthdate']) &&
                isset($requestData['firstname']) &&
                isset($requestData['lastname']) &&
                isset($requestData['gender']));
    }

    static function setSession($attrUser, $valueUser, $attrName, $valueName) {
        $session = new Session();
        $session->start();
        $session->set($attrUser, $valueUser);
        $session->set($attrName, $valueName);
    }

    static function getSession() {
        $session = new Session();
        $session->start();
        return array('username' => $session->get('username'), 'name' => $session->get('name'), 'session' => $session);
    }

    static function postsToArray($postCollection) {
        $finalPostArray = array();
        foreach ($postCollection as $post) {

            $comments = array();
            foreach ($post->getComment() as $comment) {
                $commentdata = array('comment_id' => $comment->getCommentId(),
                    'comment_content' => $comment->getContent(),
                    'comment_likes' => $comment->getLikes(),
                    'comment_date' => $comment->getCommentDate(),
                    'user' => $comment->getUser()
                );
                array_push($comments, $commentdata);
            }

            $postdata = array('post_id' => $post->getPostid(),
                'post_content' => $post->getPostContent(),
                'post_date' => $post->getPostDate(),
                'post_likes' => $post->getLikes(),
                'user' => $post->getUser(),
                'comments' => $comments);

            array_push($finalPostArray, $postdata);
        }
        return $finalPostArray;
    }

    static function postObjectToArray($postObject) {

        $comments = array();
        foreach ($postObject->getComment() as $comment) {
            $commentdata = array('comment_id' => $comment->getCommentId(),
                'comment_content' => $comment->getContent(),
                'comment_likes' => $comment->getLikes(),
                'comment_date' => $comment->getCommentDate(),
                'user' => $comment->getUser()
            );
            array_push($comments, $commentdata);
        }

        $postdata = array('post_id' => $postObject->getPostid(),
            'post_content' => $postObject->getPostContent(),
            'post_date' => $postObject->getPostDate(),
            'post_likes' => $postObject->getLikes(),
            'user' => $postObject->getUser(),
            'comments' => $comments);

        return $postdata;
    }

    static function getUserByUsername($username, $controller) {
        $userRepository = $controller->getDoctrine()->getRepository('G6FriendsBundle:User');
        $existingUser = $userRepository->findOneByUsername($username);
        return $existingUser;
    }
    
    static function getPostByID($postID, $controller) {
        $postRepository = $controller->getDoctrine()->getRepository('G6FriendsBundle:Post');
        $existingPost = $postRepository->findOneByPostId($postID);
        return $existingPost;
    }

}
