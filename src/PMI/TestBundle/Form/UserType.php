<?php

namespace PMI\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class UserType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('groups')
                ->add('friendsWithMe')
                ->add('myFriends')
        ;
    }

    public function getName()
    {
        return 'pmi_testbundle_usertype';
    }
}
