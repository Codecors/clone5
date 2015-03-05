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
use Symfony\Component\HttpFoundation\Session\Session;
use G6\FriendsBundle\Helper\CommonMethods;

class UserController extends Controller {

    public function loginAction(Request $request) {

        $user = null;
        $error = 0;
        $errorMsg = '';

        if ($request->getMethod() == 'POST') {
            $requestData = $request->request->all();
            if (CommonMethods::validateLogin($requestData) == 0) {
                $error = 1;
                $errorMsg = 'Something went wrong.Please refresh the page and login.';
                return $this->render('G6FriendsBundle:User:login.html.twig', array('data' => $user, 'error' => $error, 'errorMsg' => $errorMsg));
            }

            $userRepository = $this->getDoctrine()->getRepository('G6FriendsBundle:User');
            $user = $userRepository->findOneByUsername($requestData['username']);

            if (isset($user) && $user->getPassword() == $requestData['password']) {
                CommonMethods::setSession('username', $user->getUsername());
                return $this->redirect('user/' . $user->getUsername());
            } else {
                $error = 1;
                $errorMsg = 'Username or Password is not found';
            }
        }
        return $this->render('G6FriendsBundle:User:login.html.twig', array('data' => $user, 'error' => $error, 'errorMsg' => $errorMsg));
    }

    public function registerAction(Request $request) {

        $data = null;
        $error = 0;
        $errorMsg = '';
        $success = 0;
        if ($request->getMethod() == 'POST') {
            $requestData = $request->request->all();

            if (CommonMethods::validateRegister($requestData) == 0) {
                $error = 1;
                $errorMsg = 'Something went wrong.Please refresh the page and register.';
                return $this->render('G6FriendsBundle:User:register.html.twig', array('data' => $data, 'error' => $error, 'errorMsg' => $errorMsg, 'success' => $success));
            }

            $userRepository = $this->getDoctrine()->getRepository('G6FriendsBundle:User');
            $existingUser = $userRepository->findOneByUsername($requestData['username']);

            if (isset($existingUser)) {
                $error = 1;
                $errorMsg = 'Username "' . $existingUser->getUsername() . '" is alrady exist.';
                return $this->render('G6FriendsBundle:User:register.html.twig', array('data' => $data, 'error' => $error, 'errorMsg' => $errorMsg, 'success' => $success));
            }
            $user = new \G6\FriendsBundle\Entity\User();
            $user->setUsername($requestData['username']);
            $user->setFirstName($requestData['firstname']);
            $user->setLastName($requestData['lastname']);
            $user->setPassword($requestData['password']);
            $user->setGender($requestData['gender']);
            $user->setBirthdate(date_create($requestData['birthdate']));

            $em = $this->getDoctrine()->getManager();

            $em->persist($user);
            $em->flush();
            $success = 1;
            return $this->render('G6FriendsBundle:User:register.html.twig', array('data' => $data, 'error' => $error, 'errorMsg' => $errorMsg, 'success' => $success));
        }
        return $this->render('G6FriendsBundle:User:register.html.twig', array('data' => $data, 'error' => $error, 'errorMsg' => $errorMsg, 'success' => $success));
    }

    public function userAction($name) {

        $sessionUser = CommonMethods::getSession('username');
        if (isset($sessionUser) == 0) {
            return $this->redirect('../login');
        } else if ($sessionUser != $name) {
            return $this->redirect('../user/' . $sessionUser);
        }

        $userRepository = $this->getDoctrine()->getRepository('G6FriendsBundle:User');
        $user = $userRepository->findOneByUsername($sessionUser);
        return $this->render('G6FriendsBundle:User:user.html.twig', array('posts' => CommonMethods::postsToArray($user->getPost()->toArray())));
    }

    public function logoutAction() {
        $session = new Session();
        $session->clear();
        $session->invalidate();
        return $this->redirect('login');
    }

}