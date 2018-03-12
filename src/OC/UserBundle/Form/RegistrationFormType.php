<?php
 
namespace OC\UserBundle\Form;
 
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseRegistrationFormType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
 
         
        $builder
        ->add('name')
        ->add('firstname')
        ->add('tel')
        ->add('adress')
        ->add('roles', ChoiceType::class, array(
                'attr'  =>  array('class' => 'form-control',
                    'style' => 'margin:5px 0;'),
                'choices' =>
                    array
                    (
                            'ROLE_ADMIN' => 'ROLE_ADMIN',
                            'ROLE_USER' => 'ROLE_USER',
                            'ROLE_CUISINIER'=>'ROLE_CUISINIER',
                            'ROLE_LIVREUR'=>'ROLE_LIVREUR'
                    ) ,
                'multiple' => true,
                'required' => true,
            )
        );
        // $builder->remove('plainPassword');
    }
 

     public function getParent()
    {
        return BaseRegistrationFormType::class;
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    public function getName()
    {
        return $this->getBlockPrefix();
    }

}