<?php

namespace PMI\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class GroupType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('users')
        ;
    }

    public function getName()
    {
        return 'pmi_testbundle_grouptype';
    }
}
