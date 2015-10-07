<?php

namespace UserBundle\Controller;

use UserBundle\Entity\User;
use UserBundle\Form\RegisterType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class RegistrationController extends Controller
{

    public function indexAction()
    {
    	$request = Request::createFromGlobals();
		
	if( $request->request->has("register"))
	{
	$user = new User();
	$user->setUsername($request->request->get("register")['username']);
	$user->setEmail($request->request->get("register")['email']);
	$user->setPassword($request->request->get("register")['password']);
	
	$em = $this->getDoctrine()->getManager();

	$em->persist($user);
	$em->flush();
	}
	
	
	$form = $this->createForm(new RegisterType);
    
        return $this->render('UserBundle::register.html.php',array('form' => $form->createView()));
        
    }
    
}
