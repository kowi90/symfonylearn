<?php

namespace UserBundle\Controller;

use UserBundle\Entity\User;
use UserBundle\Form\RegisterType;
use UserBundle\Manager\UserManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class RegistrationController extends Controller
{

    public function indexAction(Request $request)
    {

		$user = new User();
		$um = new UserManager($this->getDoctrine()->getManager());


		$form = $this->createForm(new RegisterType, $user);

		$form->handleRequest($request);



		if($form->isSubmitted()) {



				if ($form->isValid()) {

					$encoder = $this->container->get('security.password_encoder');
					$encoded = $encoder->encodePassword($user, $user->getPassword());
					$user->setPassword($encoded);

					$um->save($user);

				}
		}


        return $this->render('UserBundle::register.html.php',array('form' => $form->createView()));
        
    }
    
}
