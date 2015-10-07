<?php
namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      
 	$builder
                ->add('email','email')
                ->add('username','text')
                ->add('password','password')
                ->add('password2','password')
                ->add('submit','submit');
    
    }



    public function getName()
    {
        return 'register';
    }
}
